<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use Latte\Engine;
use Latte\Loaders\FileLoader;

include __DIR__ . "/vendor/autoload.php";

// Set up Latte
$latte = new Engine();
$latte->setLoader(new FileLoader(__DIR__ . "/templates"));
$latte->setCacheDirectory(__DIR__ . "/cache");

// Prepare data
$data = [
    "title" => "Willkommen zu Web Technologies",
    "lectures" => [
        "Vorlesung 1" => "Grundlagen der Kommunikation im Web",
        "Vorlesung 2" => "PHP-Grundlagen Teil 1",
        "Vorlesung 3" => "PHP-Grundlagen Teil 2 und Regular Expressions",
        "Vorlesung 4" => "Objektorientiertes PHP",
        "Vorlesung 5" => "Komponenten und Standards",
        "Vorlesung 6" => "Templates und Routing",
        "Vorlesung 7" => "Formularverarbeitung",
        "Vorlesung 8" => "Sessions und Authentifizierung",
        "Vorlesung 9" => "Datum, Zeit und Internationalisierung",
        "Vorlesung 10" => "Medienverarbeitung",
        "Vorlesung 11" => "REST APIs & AJAX",
        "Vorlesung 12" => "Microframeworks und Testing",
    ],
];

// Render the Latte template into a string
$html = $latte->renderToString("webtechnologies.latte", $data);

// Create a new Dompdf instance with options
$options = new Options();
$options->setChroot([__DIR__]);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();

// Set PDF metadata
$dompdf->addInfo("Title", "Dompdf & Latte Example");
$dompdf->addInfo("Author", "Wolfgang Hochleitner");
$dompdf->addInfo("Subject", "Dompdf & Latte Demo");
$dompdf->addInfo("Keywords", "PHP, PDF, Dompdf, Latte, Web Technologies");
$dompdf->addInfo("Creator", "Dompdf v3.1.5");

// Display the PDF in the browser (inline)
$dompdf->stream("pdf-latte-webtechnologies.pdf", ["Attachment" => false]);

// Save the PDF to the current directory
file_put_contents(__DIR__ . "/pdf-latte-webtechnologies.pdf", $dompdf->output());