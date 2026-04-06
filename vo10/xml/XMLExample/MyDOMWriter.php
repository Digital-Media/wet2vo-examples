<?php

namespace XMLExample;

use Dom\XMLDocument;

/**
 * Creates a new XML file based on the data passed to the constructor using DOM.
 * @package Hypermedia2\Vl09
 */
class MyDOMWriter
{
    // Writer-related properties

    /**
     * The DOM instance.
     * @var XMLDocument
     */
    private XMLDocument $dom;

    // Document data properties

    /**
     * The data used for creating the XML file.
     * @var array
     */
    private array $shows;

    /**
     * Initializes the DOM document with the data used for XML creation.
     * @param array $shows The data used for creating the XML file.
     */
    public function __construct(array $shows)
    {
        $this->dom = XMLDocument::createEmpty("1.0", "UTF-8");
        $this->dom->formatOutput = true;
        $this->shows = $shows;
    }

    /**
     * Creates a new XML file based on the $shows property and writes it to a file.
     * @param string $file The XML file name.
     */
    public function generateXML(string $file): void
    {
        $shows = $this->dom->appendChild($this->dom->createElement("shows"));

        foreach ($this->shows as $show) {
            $showElem = $shows->appendChild($this->dom->createElement("show"));
            foreach ($show as $tag => $data) {
                $showData = $this->dom->createElement($tag);
                $showData->textContent = $data;
                $showElem->appendChild($showData);
            }
        }

        $this->dom->saveXmlFile($file);
    }
}