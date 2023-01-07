<?php

$_configs = [];

foreach (glob(__DIR__ . '/tables/*.php') as $file) {
    $_config = require $file;
    $_config = !empty($_config) ? $_config : [];
    $_configs[] = $_config;
}

return $_configs;
