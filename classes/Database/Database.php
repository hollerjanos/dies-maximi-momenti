<?php

namespace Database;

require_once(__DIR__ . "/../Http/RequestException.php");
require_once(__DIR__ . "/../Http/StatusCode.php");

use Http\RequestException;
use Http\StatusCode;
use Exception;
use PDO;

class Database
{
    private string $hostname;
    private string $username;
    private string $password;

    private PDO $connection;

    private bool $debug = false;

    private array $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    public function __construct(
        string $hostname,
        string $username,
        string $password,
    )
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;

        $dataSourceName = $this->getDataSourceName();

        $this->connection = new PDO(
            $dataSourceName,
            $this->username,
            $this->password
        );

        $this->setAttributes();
    }

    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    private function getDataSourceName(): string
    {
        return "mysql:host={$this->hostname}";
    }

    private function setAttributes(): void
    {
        foreach ($this->attributes as $attribute => $value)
        {
            $this->connection->setAttribute($attribute, $value);
        }
    }

    public function dropDatabase(string $database): void
    {
        $query = "DROP DATABASE IF EXISTS `$database`;";

        $this->displayQuery($query);

        $this->connection->exec($query);
    }

    public function createDatabase(string $database): void
    {
        $query = "CREATE DATABASE IF NOT EXISTS `$database`;";

        $this->displayQuery($query);

        $this->connection->exec($query);
    }

    public function useDatabase(string $database): void
    {
        $query = "USE `$database`;";

        $this->displayQuery($query);

        $this->connection->exec($query);
    }

    public function createTable(
        string $table, array $columns, array $keys = []
    ): void
    {
        $structure = [];
        foreach ($columns as $column => $datatypes)
        {
            $structure[] = "`$column` " . implode(" ", $datatypes);
        }
        $structure = implode(", ", array_merge($structure, $keys));

        $query = "CREATE TABLE IF NOT EXISTS `$table` ($structure);";

        $this->displayQuery($query);

        $this->connection->exec($query);
    }

    // TODO: InsertInto should be able to give back a boolean value so we can check if the result was successful or not.

    public function insertInto(string $table, array $values): void
    {
        try
        {
            $columns = array_keys($values[0]);
            $columns = "`" . implode("`, `", $columns) . "`";

            $params = [];
            $valueIndex = 0;
            $valueRows = [];

            foreach ($values as $key => $item)
            {
                $valueContainer = [];

                foreach ($item as $column => $value)
                {
                    $paramKey = $column . $valueIndex;

                    $params[$paramKey] = $value;
                    $valueContainer[] = ":$paramKey";
                }

                $valueRows[] = "(" . implode(", ", $valueContainer) . ")";
                $valueIndex++;
            }

            $values = implode(", ", $valueRows);

            $query = "INSERT INTO `$table` ($columns) VALUES $values;";

            $this->displayQuery($query);
            $this->displayParams($params);

            $statement = $this->connection->prepare($query);
            $statement->execute($params);
        }
        catch (Exception $exception)
        {
            switch ($exception->getCode())
            {
                case 23000: throw new RequestException(
                    "Duplicated value!",
                    StatusCode::conflict()
                );
            }
        }
    }

    public function displayQuery(string $query): void
    {
        if (!$this->debug) return;

        echo "<pre>$query</pre>";
    }

    public function displayParams(array $params): void
    {
        if (!$this->debug) return;

        echo "<pre>";
        var_dump($params);
        echo "</pre>";
    }
}
