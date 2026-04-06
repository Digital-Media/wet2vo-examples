<?php

require "XMLExample/MyDOMWriter.php";

use XMLExample\MyDOMWriter;

$shows = [
    [
        "name" => "The Mandalorian",
        "service" => "Disney+",
        "resolution" => "2160p",
        "duration" => "40",
    ],
    [
        "name" => "Rick and Morty",
        "service" => "Netflix",
        "resolution" => "1080p",
        "duration" => "20",
    ],
];

$xmlWriter = new MyDOMWriter($shows);
$xmlWriter->generateXML("dom_shows.xml");