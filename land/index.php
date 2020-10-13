<?php

if (!isset($use_base)) {
    $use_base = false;
}

$site = file_get_contents('template.html', true);
if ($use_base) {
    $site = str_replace('<head>', '<head><base href="landing/">', $site);
}

echo $site;
