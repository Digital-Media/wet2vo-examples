<?php

try {
    throw new Exception("General error!");
    echo "This output isn't shown anymore.";
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}

echo "Continue after exception handling.";
