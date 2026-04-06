<?php

use Spipu\Html2Pdf\Html2Pdf;

require "vendor/autoload.php";

# HTML2PDF-Objekt erstellen
$html2pdf = new Html2Pdf("P", "A4", "de");

# Metadaten über pdf-Eigenschaft setzen
$html2pdf->pdf->setCreator(PDF_CREATOR);
// PDF-Autor*in
$html2pdf->pdf->setAuthor("Wolfgang Hochleitner");
// Titel des PDFs
$html2pdf->pdf->setTitle("HTML2PDF-Beispieldokument");
// Beschreibung des Dokuments
$html2pdf->pdf->setSubject("PDF erstellen mit HTML2PDF");
// Schlüsselwörter setzen
$html2pdf->pdf->setKeywords("HTML2PDF, Beispiel, PDF, Hypermedia 2");

# Inhalt der HTML-Datei einlesen
$html = file_get_contents(__DIR__ . "/htmlcontent/hypermedia.php");

# Inhalt schreiben
// Standardschriftart auswählen
$html2pdf->setDefaultFont("Arial");
// Inhalt ausgeben
$html2pdf->writeHTML($html);

# Output erzeugen (im Browser und als Datei)
$html2pdf->output("html2pdf-hypermedia.pdf", "I");
$html2pdf->output(__DIR__ . "/html2pdf-hypermedia.pdf", "F");