<?php

namespace Frontend;

class Html
{
    private string $tabCharacter = "    ";

    private int $numberOfTabs;

    private int $version;

    public function __construct(int $numberOfTabs = 0)
    {
        $this->numberOfTabs = $numberOfTabs;

        $this->version = rand(0, 99999);
    }

    private function tabIncrease(int $amount = 1): void
    {
        $this->numberOfTabs += $amount;
    }

    private function tabDecrease(int $amount = 1): void
    {
        $this->numberOfTabs -= $amount;
    }

    private function printTabulators(): void
    {
        for ($tabIndex = 0; $tabIndex < $this->numberOfTabs; $tabIndex++)
        {
            echo $this->tabCharacter;
        }
    }

    private function printEndOfLine(): void
    {
        echo "\n";
    }

    private function manageAttributes(
        array $attributes, bool $addVersion = false
    ): void
    {
        $result = [];

        foreach ($attributes as $name => $value)
        {
            if (str_starts_with($name, "data-"))
            {
                $result[] = "$name=\"$value\"";
                continue;
            }

            switch ($name)
            {
                case "id":
                case "lang":
                case "rel":
                case "type":
                case "charset":
                case "name":
                case "content":
                case "http-equiv":
                case "type":
                case "alt":
                case "method":
                case "action":
                case "for":
                case "draggable":
                case "size":
                case "autocomplete":
                case "value":
                case "tabindex":
                    $result[] = "$name=\"$value\"";
                    break;

                case "defer":
                case "async":
                    $result[] = "$name";
                    break;

                case "class":
                    if (!is_array($value)) break;
                    $value = array_filter($value, function ($class) {
                        return !empty($class);
                    });
                    $result[] = "$name=\"" . implode(" ", $value) . "\"";
                    break;

                case "href":
                case "src":
                    $result[] = $addVersion
                        ? "$name=\"$value?version={$this->version}\""
                        : "$name=\"$value\"";
            }
        }

        if (!empty($result))
        {
            echo " " . implode(" ", $result);
        }
    }

    public function comment(string $content): void
    {
        $this->printTabulators();

        echo "<!-- $content -->";

        $this->printEndOfLine();
    }

    public function doctype(): void
    {
        $this->printTabulators();

        echo "<!DOCTYPE html>";

        $this->printEndOfLine();
    }

    public function htmlStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<html";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function htmlEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</html>";
    }

    public function headStart(): void
    {
        $this->printTabulators();

        echo "<head>";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function headEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</head>";

        $this->printEndOfLine();
    }

    public function title(string $content): void
    {
        $this->printTabulators();

        echo "<title>$content</title>";

        $this->printEndOfLine();
    }

    public function meta(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<meta";
        $this->manageAttributes($attributes);
        echo "/>";

        $this->printEndOfLine();
    }

    public function link(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<link";
        $this->manageAttributes($attributes, true);
        echo "/>";

        $this->printEndOfLine();
    }

    public function script(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<script";
        $this->manageAttributes($attributes, true);
        echo "></script>";

        $this->printEndOfLine();
    }

    public function bodyStart(): void
    {
        $this->printTabulators();

        echo "<body>";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function bodyEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</body>";

        $this->printEndOfLine();
    }

    public function p(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<p";
        $this->manageAttributes($attributes);
        echo ">$content</p>";

        $this->printEndOfLine();
    }

    public function a(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<a";
        $this->manageAttributes($attributes);
        echo ">$content</a>";

        $this->printEndOfLine();
    }

    public function tableStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<table";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function tableEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</table>";

        $this->printEndOfLine();
    }

    public function trStart(): void
    {
        $this->printTabulators();

        echo "<tr>";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function trEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</tr>";

        $this->printEndOfLine();
    }

    public function th(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<th";
        $this->manageAttributes($attributes);
        echo ">$content</th>";

        $this->printEndOfLine();
    }

    public function td(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<td";
        $this->manageAttributes($attributes);
        echo ">$content</td>";

        $this->printEndOfLine();
    }

    public function button(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<button";
        $this->manageAttributes($attributes);
        echo ">$content</button>";

        $this->printEndOfLine();
    }

    public function divStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<div";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function divEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</div>";

        $this->printEndOfLine();
    }

    public function ulStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<ul";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function ulEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</ul>";

        $this->printEndOfLine();
    }

    public function liStart(): void
    {
        $this->printTabulators();

        echo "<li>";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function liEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</li>";

        $this->printEndOfLine();
    }

    public function img(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<img";
        $this->manageAttributes($attributes, true);
        echo "/>";

        $this->printEndOfLine();
    }

    public function aStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<a";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function aEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</a>";

        $this->printEndOfLine();
    }

    public function h1(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<h1";
        $this->manageAttributes($attributes);
        echo ">$content</h1>";

        $this->printEndOfLine();
    }

    public function h2(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<h2";
        $this->manageAttributes($attributes);
        echo ">$content</h2>";

        $this->printEndOfLine();
    }

   public function h3(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<h3";
        $this->manageAttributes($attributes);
        echo ">$content</h3>";

        $this->printEndOfLine();
    }

    public function h4(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<h4";
        $this->manageAttributes($attributes);
        echo ">$content</h4>";

        $this->printEndOfLine();
    }


    public function h5(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<h5";
        $this->manageAttributes($attributes);
        echo ">$content</h5>";

        $this->printEndOfLine();
    }

    public function h6(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<h6";
        $this->manageAttributes($attributes);
        echo ">$content</h6>";

        $this->printEndOfLine();
    }

    public function formStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<form";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function formEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</form>";

        $this->printEndOfLine();
    }

    public function input(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<input";
        $this->manageAttributes($attributes);
        echo "/>";

        $this->printEndOfLine();
    }

    public function label(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<label";
        $this->manageAttributes($attributes);
        echo ">$content</label>";

        $this->printEndOfLine();
    }

    public function fieldsetStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<fieldset";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function fieldsetEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</fieldset>";

        $this->printEndOfLine();
    }

    public function legend(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<legend";
        $this->manageAttributes($attributes);
        echo ">$content</legend>";

        $this->printEndOfLine();
    }

    public function tdStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<td";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function tdEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</td>";

        $this->printEndOfLine();
    }

    public function span(string $content, array $attributes = []): void
    {
        $this->printTabulators();

        echo "<span";
        $this->manageAttributes($attributes);
        echo ">$content</span>";

        $this->printEndOfLine();
    }

    public function headerStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<header";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function headerEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</header>";

        $this->printEndOfLine();
    }

    public function navStart(array $attributes = []): void
    {
        $this->printTabulators();

        echo "<nav";
        $this->manageAttributes($attributes);
        echo ">";

        $this->printEndOfLine();

        $this->tabIncrease();
    }

    public function navEnd(): void
    {
        $this->tabDecrease();

        $this->printTabulators();

        echo "</nav>";

        $this->printEndOfLine();
    }
}
