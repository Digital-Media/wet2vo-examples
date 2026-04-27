<?php

require "ExportFormat.php";

/**
 * Product exporter class that uses an enum to define the export format.
 */
class ProductExporter
{
    public function export(ExportFormat $format): void
    {
        match ($format) {
            ExportFormat::XML => $this->exportToXML(),
            ExportFormat::JSON => $this->exportToJSON(),
            ExportFormat::PDF => $this->exportToPDF(),
        };
    }

    private function exportToXML(): void
    {
        // Export to XML
    }

    private function exportToJSON(): void
    {
        // Export to JSON
    }

    private function exportToPDF(): void
    {
        // Export to PDF
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