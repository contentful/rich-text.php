<?php

$config = require __DIR__.'/scripts/php-cs-fixer.php';

return $config(
    'rich-text',
    true,
    ['src', 'tests', 'scripts']
);
