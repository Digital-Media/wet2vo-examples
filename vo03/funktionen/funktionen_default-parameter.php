<?php

function defaultParams($a, $b = "b", $c = "c")
{
    echo "<p>$a$b$c</p>";
}

defaultParams("a"); // abc
defaultParams("a", "x"); // axc
defaultParams("a", "x", "o"); // axo