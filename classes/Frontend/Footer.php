<?php

namespace Frontend;

require_once(__DIR__ . "/Html.php");

class Footer
{
    private Html $html;

    public function __construct()
    {
        $this->html = new Html(3);
    }

    public function print()
    {
        $this->html->divEnd();

        $this->html->bodyEnd();

        $this->html->htmlEnd();
    }
}
