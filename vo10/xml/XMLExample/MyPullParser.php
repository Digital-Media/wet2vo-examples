<?php

namespace XMLExample;

use XMLReader;

/**
 * Creates a new pull parser based on XMLReader and parses the XML Tirolerknödel recipe.
 * @package XMLExample
 */
class MyPullParser
{
    // Parser-related properties

    /**
     * The XML event parser instance.
     * @var XMLReader
     */
    private XMLReader $parser;

    // Document-related properties

    /**
     * The URL source of the recipe. This uses asymmetric access that is public for reading and private for writing.
     * @var string
     */
    private(set) string $source = "";

    /**
     * The name of the current dish. This uses asymmetric access that is public for reading and private for writing.
     * @var string
     */
    private(set) string $dish = "";

    /**
     * The list of ingredients. This uses asymmetric access that is public for reading and private for writing.
     * @var array
     */
    private(set) array $ingredients = [];

    /**
     * The list of preparation steps. This uses asymmetric access that is public for reading and private for writing.
     * @var array
     */
    private(set) array $steps = [];

    /**
     * Creates a new parser instance and initializes properties.
     */
    public function __construct()
    {
        $this->parser = new XMLReader();
    }

    /**
     * Destroys the parser instance by closing it.
     */
    public function __destruct()
    {
        $this->parser->close();
    }

    /**
     * Parses the XML file and writes its values into the respective properties.
     * @param string $file The file to be parsed.
     */
    public function parse(string $file): void
    {
        $this->parser->open($file);

        while ($this->parser->read()) {
            if ($this->parser->nodeType === XMLReader::ELEMENT) {
                switch ($this->parser->name) {
                    case "rezept":
                        $this->source = $this->parser->getAttribute("quelle");
                        break;
                    case "gericht":
                        $this->dish = trim($this->parser->readString());
                        break;
                    case "zutat":
                        $this->ingredients[] = [];
                        break;
                    case "ingredienz":
                    case "menge":
                    case "einheit":
                        $this->ingredients[array_key_last($this->ingredients)][$this->parser->name] = trim(
                            $this->parser->readString(),
                        );
                        break;
                    case "schritt":
                        $this->steps[] = trim($this->parser->readString());
                        break;
                }
            }
        }
    }
}