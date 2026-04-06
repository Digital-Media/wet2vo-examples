<?php

/**
 * Loads a class automatically based on the given namespace, if the directory structure maps the namespace.
 * @param $className string The name of the class to load (including namespace).
 * @return void Returns nothing.
 */
function autoload(string $className): void
{
    $className = ltrim($className, "\\");
    $fileName = "";
    $namespace = "";
    if ($lastNsPos = strrpos($className, "\\")) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace("\\", DIRECTORY_SEPARATOR, $namespace)
            . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace("_", DIRECTORY_SEPARATOR, $className) . ".php";

    require $fileName;
}

spl_autoload_register("autoload");
