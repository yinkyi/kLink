<?php

namespace App\Traits;

use DB;
use Config;
trait ModelTraits
{
    /**
     * Retrieves the acceptable enum fields for a column
     *
     * @param string $column Column name
     *
     * @return array
     */
    public static function getPossibleEnumValues ($column) {
        // Create an instance of the model to be able to get the table name
        $instance = new static;
        $connection_name = $instance->getConnectionName();
        $config = Config::get('database.connections');
        if($connection_name)
            $databaseName = $config[$connection_name]['database'];
        else
            $databaseName = "";

        // Pulls column string from DB
        $enumStr = DB::select(DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$column.'"'))[0]->Type;

        // Parse string
        preg_match_all("/'([^']+)'/", $enumStr, $matches);

        // Return matches
        return isset($matches[1]) ? $matches[1] : [];
    }
}
