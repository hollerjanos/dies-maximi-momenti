<?php

namespace Frontend;

require_once(__DIR__ . "/Html.php");
require_once(__DIR__ . "/Header.php");
require_once(__DIR__ . "/Footer.php");

class Content extends Html
{
    private Header $header;
    private Footer $footer;

    public function __construct()
    {
        $this->header = new Header();
        $this->footer = new Footer();

        parent::__construct(3);
    }

    public function buildHeader(): Header
    {
        return $this->header;
    }

    public function printHeader(): void
    {
        $this->header->print();
    }

    public function printFooter(): void
    {
        $this->footer->print();
    }

    public function displayErrorMessage(string $errorMessage): void
    {
        $this->divStart([
            "id" => "errorMessage",
            "class" => [
                "error-message"
            ]
        ]);

        $this->span(
            "&times;",
            [
                "class" => [
                    "close-button",
                    "disable-selection"
                ],
                "data-reference" => "#errorMessage"
            ]
        );

        $this->p($errorMessage);

        $this->divEnd();
    }

    public function displaySuccessMessage(string $successMessage): void
    {
        $this->divStart([
            "id" => "successMessage",
            "class" => [
                "success-message"
            ]
        ]);

        $this->span(
            "&times;",
            [
                "class" => [
                    "close-button",
                    "disable-selection"
                ],
                "data-reference" => "#successMessage"
            ]
        );

        $this->p($successMessage);

        $this->divEnd();
    }
}
