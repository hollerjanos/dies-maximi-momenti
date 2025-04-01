<?php

namespace Database;

class Datatype
{
    public static function int(int $size = 0): string
    {
        return $size > 0 ? "INT($size)" : "INT";
    }

    public static function bigInt(): string
    {
        return self::int(11);
    }

    public static function mediumInt(): string
    {
        return self::int(7);
    }

    public static function smallInt(): string
    {
        return self::int(3);
    }

    public static function boolean(): string
    {
        return self::int(1);
    }

    public static function varchar(int $size = 0): string
    {
        return $size > 0 ? "VARCHAR($size)" : "VARCHAR";
    }

    public static function bigVarchar(): string
    {
        return self::varchar(255);
    }

    public static function mediumVarchar(): string
    {
        return self::varchar(100);
    }

    public static function smallVarchar(): string
    {
        return self::varchar(50);
    }

    public static function text(): string
    {
        return "TEXT";
    }

    public static function json(): string
    {
        return "JSON";
    }

    public static function timestamp(): string
    {
        return "TIMESTAMP";
    }

    public static function autoIncrement(): string
    {
        return "AUTO_INCREMENT";
    }

    public static function currentTimestampDefault(): string
    {
        return "DEFAULT CURRENT_TIMESTAMP";
    }

    public static function currentTimestampOnUpdate(): string
    {
        return "ON UPDATE CURRENT_TIMESTAMP";
    }

    public static function notNull(): string
    {
        return "NOT NULL";
    }

    public static function unique(): string
    {
        return "UNIQUE";
    }

    public static function primaryKey(string $column): string
    {
        return "PRIMARY KEY (`$column`)";
    }

    public static function foreignKey(
        string $fromColumn, string $table, string $toColumn
    ): string
    {
        return "FOREIGN KEY (`$fromColumn`) REFERENCES `$table` (`$toColumn`)";
    }
}
