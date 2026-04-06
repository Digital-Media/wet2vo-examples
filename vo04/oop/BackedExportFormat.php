<?php

/**
 * The ExportFormat enum defines, which formats something could be exported to.
 * Valid formats are XML, JSON, and PDF.
 * This enum is backed which means every case has an integer value assigned to it.
 */
enum BackedExportFormat: int
{
    case XML = 1;
    case JSON = 2;
    case PDF = 3;
}

echo BackedExportFormat::XML->name; // XML
echo BackedExportFormat::XML->value; // 1
