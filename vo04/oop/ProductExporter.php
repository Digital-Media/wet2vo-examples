<?php

require "ExportFormat.php";

/**
 * Product exporter class that uses an enum to define the export format.
 */
class ProductExporter
{
    public function export(ExportFormat $format): void
    {
        switch ($format) {
            case ExportFormat::XML:
                // Export to XML
                break;
            case ExportFormat::JSON:
                // Export to JSON
                break;
            case ExportFormat::PDF:
                // Export to PDF
                break;
        }
    }
}

// Calling export
$exporter = new ProductExporter();
$exporter->export(ExportFormat::XML);
$exporter->export(ExportFormat::JSON);
$exporter->export(ExportFormat::PDF);

echo ExportFormat::XML->name; // XML
echo ExportFormat::JSON->name; // JSON
echo ExportFormat::PDF->name; // PDF