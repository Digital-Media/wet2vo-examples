<?php

namespace XMLExample;

use Dom\XMLDocument;

/**
 * Creates a new XML file based on the data passed to the constructor using DOM.
 * @package XMLExample
 */
class MyDOMWriter
{
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
        $this->shows = $shows;
    }

    /**
     * Creates a new XML file based on the $shows property and writes it to a file.
     * @param string $file The XML file name.
     */
    public function generateXML(string $file): void
    {
        $dom = XMLDocument::createEmpty("1.0", "UTF-8");
        $dom->formatOutput = true;

        $shows = $dom->appendChild($dom->createElement("shows"));

        foreach ($this->shows as $show) {
            $showElem = $shows->appendChild($dom->createElement("show"));
            foreach ($show as $tag => $data) {
                $showData = $dom->createElement($tag);
                $showData->textContent = $data;
                $showElem->appendChild($showData);
            }
        }

        $dom->saveXmlFile($file);
    }
}