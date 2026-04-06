<?php

namespace XMLExample;

use XMLWriter;

/**
 * Creates a new XML file based on the data passed to the constructor using XMLWriter.
 * @package Hypermedia2\Vl09
 */
class MyStreamWriter
{
    // Writer-related properties

    /**
     * The XMLWriter instance.
     * @var XMLWriter
     */
    private XMLWriter $writer;

    // Document data properties

    /**
     * The data used for creating the XML file.
     * @var array
     */
    private array $shows;

    /**
     * Initializes the writer with the data used for XML creation.
     * @param array $shows The data used for creating the XML file.
     */
    public function __construct(array $shows)
    {
        $this->writer = new XMLWriter();
        $this->shows = $shows;
    }

    /**
     * Creates a new XML file based on the $shows property and writes it to a file.
     * @param string $file The XML file name.
     */
    public function generateXML(string $file): void
    {
        $this->writer->openUri($file);
        $this->writer->setIndent(true);

        $this->writer->startDocument("1.0", "UTF-8");
        $this->writer->startElement("shows");

        foreach ($this->shows as $show) {
            $this->writer->startElement("show");
            foreach ($show as $tag => $data) {
                $this->writer->writeElement($tag, $data);
            }
            $this->writer->endElement();
        }
        $this->writer->endElement();

        $this->writer->endDocument();

        $this->writer->flush();
    }
}