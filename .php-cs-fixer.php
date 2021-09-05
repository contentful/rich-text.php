<?php

$config = require __DIR__.'/vendor/contentful/core/scripts/php-cs-fixer.php';

return $config(
    'rich-text',
    true,
    ['src', 'tests']
);
