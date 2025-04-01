<?php

namespace Frontend;

require_once(__DIR__ . "/Html.php");
require_once(__DIR__ . "/../../includes/constants.php");

class Header
{
    private Html $html;

    private string $language = LANGUAGE;

    private string $title = TITLE;

    private string $charset = CHARSET;
    private string $description = DESCRIPTION;
    private string $keywords = KEYWORDS;
    private string $author = AUTHOR;
    private string $viewport = VIEWPORT;

    private array $links = [
        [
            "rel" => "icon",
            "type" => "image/x-icon",
            "href" => "/assets/img/calendar.ico"
        ],
        [
            "rel" => "stylesheet",
            "href" => "/assets/css/style.css"
        ]
    ];

    private array $scripts = [
        [
            "src" => "/assets/js/script.js",
            "defer" => true
        ]
    ];

    private array $navigations = [
        [
            "id" => 1,
            "type" => "image",
            "href" => "/index.php",
            "src" => "/assets/img/calendar.ico",
            "alt" => TITLE
        ],
        [
            "id" => 2,
            "type" => "normal",
            "href" => "/calendar.php",
            "content" => "Calendar"
        ]
    ];

    public function __construct()
    {
        $this->html = new Html();
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function setTitle(string $title): Header
    {
        $this->title = $title;

        return $this;
    }

    public function setCharset(string $charset): Header
    {
        $this->charset = $charset;

        return $this;
    }

    public function setDescription(string $description): Header
    {
        $this->description = $description;

        return $this;
    }

    public function setKeywords(string $keywords): Header
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function setAuthor(string $author): Header
    {
        $this->author = $author;

        return $this;
    }

    public function setViewport(string $viewport): Header
    {
        $this->viewport = $viewport;

        return $this;
    }

    public function addLink(array $attributes): Header
    {
        $this->links[] = $attributes;

        return $this;
    }

    public function addScript(array $attributes): Header
    {
        $this->scripts[] = $attributes;

        return $this;
    }

    public function setNavigations(array $navigations): void
    {
        $this->navigations = $navigations;
    }

    public function addNavigation(array $navigation): void
    {
        $this->navigations[] = $navigation;
    }

    public function removeNavigation(int $id): void
    {
        unset($this->navigations[$id]);
    }

    public function print(): void
    {
        $this->html->doctype();

        $this->html->htmlStart([
            "lang" => $this->language
        ]);

        $this->html->headStart();

        $this->html->comment("Title");
        $this->html->title($this->title);

        $this->html->comment("Meta(s)");
        $this->html->meta([
            "charset" => $this->charset
        ]);
        $this->html->meta([
            "name" => "description",
            "content" => $this->description
        ]);
        $this->html->meta([
            "name" => "keywords",
            "content" => $this->keywords
        ]);
        $this->html->meta([
            "name" => "author",
            "content" => $this->author
        ]);
        $this->html->meta([
            "name" => "viewport",
            "content" => $this->viewport
        ]);

        $this->html->comment("Link(s)");
        foreach ($this->links as $attributes)
        {
            $this->html->link($attributes);
        }

        $this->html->comment("Script(s)");
        foreach ($this->scripts as $attributes)
        {
            $this->html->script($attributes);
        }

        $this->html->headEnd();

        $this->html->bodyStart();

        $this->html->comment("Spinning loader");

        $this->html->divStart([
            "id" => "spinningLoader"
        ]);

        $this->html->img([
            "src" => "/assets/img/spinning-loader.gif",
            "alt" => "Loading..."
        ]);

        $this->html->divEnd();

        $this->html->comment("Navigation bar");

        $this->html->divStart([
            "id" => "navigationBar"
        ]);

        $this->html->navStart();

        $this->html->ulStart();

        foreach ($this->navigations as $navigation)
        {
            $this->html->liStart();

            switch ($navigation["type"])
            {
                case "image":
                    $this->html->aStart([
                        "href" => $navigation["href"]
                    ]);
                    $this->html->img([
                        "src" => $navigation["src"],
                        "alt" => $navigation["alt"]
                    ]);
                    $this->html->aEnd([
                        "href" => $navigation["href"]
                    ]);
                    break;
                default:
                    $this->html->a(
                        $navigation["content"],
                        [
                            "href" => $navigation["href"],
                            "class" => [
                                $_SERVER["PHP_SELF"] === $navigation["href"] ? "active" : ""
                            ]
                        ]
                    );
                    break;
            }

            $this->html->liEnd();
        }

        $this->html->ulEnd();

        $this->html->navEnd();

        $this->html->divEnd();

        $this->html->comment("Content");

        $this->html->divStart([
            "id" => "content"
        ]);
    }
}
