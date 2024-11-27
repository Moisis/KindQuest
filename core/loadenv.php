<?php

function loadEnv()
{

    $filePath = __DIR__ . '/../project.env';
    if (!file_exists($filePath)) {
        throw new Exception(".env file not found at {$filePath}");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) {
            continue; // Skip comments
        }

        list($key, $value) = explode('=', $line, 2);

        $key = trim($key);
        $value = trim($value);

        // Strip quotes if present
        $value = trim($value, '"\'');

        // Set the environment variable
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
    }
}
