<?php

namespace XMLExample;

use Dom\XMLDocument;

/**
 * Creates a new object-oriented parser based on DOM and parses the XML Tirolerknödel recipe.
 * @package Hypermedia2\Ue09
 */
class MyDOMParser
{
    // Document-related properties

    /**
     * The URL source of the recipe.
     * @var string
     */
    private(set) string $source = "";

    /**
     * The name of the current dish.
     * @var string
     */
    private(set) string $dish = "";

    /**
     * The list of ingredients.
     * @var array
     */
    private(set) array $ingredients = [];

    /**
     * The list of preparation steps.
     * @var array
     */
    private(set) array $steps = [];

    /**
     * Parses the XML file and writes its values into the respective properties.
     * @param string $file
     */
    public function parse(string $file): void
    {
        $dom = XMLDocument::createFromFile($file);

        $this->source = $dom->documentElement->getAttribute("quelle");

        $this->dish = $dom->querySelector("gericht")->textContent;

        foreach ($dom->querySelectorAll("zutat") as $ingredient) {
            $this->ingredients[] = [];
            foreach ($ingredient->childNodes as $child) {
                if ($child->nodeType === XML_ELEMENT_NODE) {
                    $this->ingredients[array_key_last($this->ingredients)][$child->tagName] = $child->textContent;
                }
            }
        }

        foreach ($dom->querySelectorAll("schritt") as $step) {
            $this->steps[] = $step->textContent;
        }
    }
}
