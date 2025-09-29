<?php
spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $path = str_replace("\\", "/", $class) . ".php";

    // Look for the file in the current directory and subdirectories
    if (file_exists($path)) {
        require $path;
    } else {
        // Try with the app/ prefix removed since we're already in the app directory
        $relativePath = str_replace("App/", "", $path);
        if (file_exists($relativePath)) {
            require $relativePath;
        }
    }
});