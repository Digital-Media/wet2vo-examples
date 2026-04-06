<?php

require "XMLExample/MyStreamWriter.php";

use XMLExample\MyStreamWriter;

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

$xmlWriter = new MyStreamWriter($shows);
$xmlWriter->generateXML("xmlwriter_shows.xml");