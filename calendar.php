<?php

ini_set("display_startup_errors", true);
ini_set("display_errors", true);

require_once(__DIR__ . "/classes/Frontend/Content.php");

use Frontend\Content;

$content = new Content();

$content->printHeader();

$content->h4("Calendar!");

$content->printFooter();
