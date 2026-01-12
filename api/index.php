<?php

// Laravel on Vercel needs to use /tmp for storage
$viewPath = '/tmp/views';
if (!is_dir($viewPath)) {
    mkdir($viewPath, 0777, true);
}

// Override the environment variables for Vercel if not set
putenv("VIEW_COMPILED_PATH=$viewPath");

// Forward Vercel requests to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
