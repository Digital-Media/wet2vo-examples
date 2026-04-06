<?php

require "vendor/autoload.php";

// Neues PDF-Dokument erstellen
$pdf = new TCPDF(
    "P",
    "mm",
    "A4",
    true,
    "UTF-8",
    false,
);

# Dokumenteninformationen (Meta-Daten)
// Softwarelösung, die das PDF erzeugt hat
$pdf->setCreator(PDF_CREATOR);
// PDF-Autor*in
$pdf->setAuthor("Wolfgang Hochleitner");
// Titel des PDFs
$pdf->setTitle("PDF-Beispieldokument");
// Beschreibung des Dokuments
$pdf->setSubject("PDF erstellen mit TCPDF");
// Schlüsselwörter setzen
$pdf->setKeywords("TCPDF, Beispiel, PDF, Hypermedia 2");

# Kopf- und Fußzeilen setzen (hier weglassen)
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

# Seitenabstände und Umbruchverhalten steuern
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->setMargins(0.0, 0.0, 0.0);
$pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);
//$pdf->setAutoPageBreak(true, 0.0);

# Schriftinformationen definieren

// Font-Subsetting aktivieren (nur die verwendeten Zeichen werden gespeichert)
$pdf->setFontSubsetting(true);
// Schriftart setzen
$pdf->setFont("dejavusans", "", 24.0);

# Erste Seite mit Inhalt hinzufügen
$pdf->AddPage();

// Text schreiben
$pdf->Write(0, "Hallo PDF-Welt!", "", 0, "C");
// Zeilenumbruch
$pdf->Ln();
// Schriftart verkleinern
$pdf->setFont("dejavusans", "", 12.0);
// Neue Zeile schreiben
$pdf->Write(0, "Mein erstes PDF mit TCPDF!", "", 0, "L");
$pdf->Ln(24.0);

$html = <<<TEXT
    <h2>Ein kleines HTML-Fragment</h2>
    <p>Hier steht ein weiterer Satz.</p>
    <p>Auch <a href="https://www.fh-ooe.at/">Links</a> funktionieren.</p>
    TEXT;
// HTML-Fragment ausgeben
$pdf->writeHTML($html);

# Neue Seite einfügen in Querformat (Landscape) und Inhalt einfügen

$pdf->AddPage("L");
// HTML nochmals ausgeben
$pdf->writeHTML($html);

# Output generieren
// Dateiname, "I" zeigt es im PDF-Viewer des Browsers an
$pdf->Output("hello-world.pdf", "I");
// "F" speichert die Datei noch zusätzlich auf den Server
$pdf->Output(__DIR__ . "/hello-world.pdf", "F");