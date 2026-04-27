<?php

/**
 * Loads a class automatically based on the given namespace if the directory structure maps the namespace.
 * @param string $fullyQualifiedClassName The name of the class to load (including namespace).
 * @return void Returns nothing.
 */
function autoload(string $fullyQualifiedClassName): void
{
    $fullyQualifiedClassName = ltrim($fullyQualifiedClassName, "\\");
    $filePath = "";

    if ($lastBackslashPosition = strrpos($fullyQualifiedClassName, "\\")) {
        $namespace = substr($fullyQualifiedClassName, 0, $lastBackslashPosition);
        $shortClassName = substr($fullyQualifiedClassName, $lastBackslashPosition + 1);
        $filePath = str_replace("\\", DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    } else {
        $shortClassName = $fullyQualifiedClassName;
    }
    $filePath .= "$shortClassName.php";

    if (file_exists($filePath)) {
        require $filePath;
    }
}

spl_autoload_register(autoload(...));