<?php

/**
 * The ExportFormat enum defines, which formats something could be exported to.
 * Valid formats are XML, JSON, and PDF.
 */
enum ExportFormat
{
    case XML;
    case JSON;
    case PDF;
}
