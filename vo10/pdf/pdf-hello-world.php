<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/vendor/autoload.php";

// Configure options
$options = new Options();
$options->setDefaultFont("Helvetica");

// Create a new Dompdf instance
$dompdf = new Dompdf($options);

// Load HTML content
$dompdf->loadHtml("<h1>Hello PDF World!</h1><p>My first PDF with Dompdf!</p>");

// Define paper size and orientation (portrait or landscape)
$dompdf->setPaper("A4", "portrait");

// Render the PDF
$dompdf->render();

// Set PDF metadata
$dompdf->addInfo("Title", "Dompdf Example");
$dompdf->addInfo("Author", "Wolfgang Hochleitner");
$dompdf->addInfo("Subject", "Dompdf Demo");
$dompdf->addInfo("Keywords", "PHP, PDF, Dompdf, Web Technologies");
$dompdf->addInfo("Creator", "Dompdf v3.1.5");

// Display the PDF in the browser (inline)
$dompdf->stream("hello-world.pdf", ["Attachment" => false]);

// Save the PDF to the current directory
file_put_contents(__DIR__ . "/hello-world.pdf", $dompdf->output());