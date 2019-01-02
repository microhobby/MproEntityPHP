<?php

/*
 * Copyright (C) 2015 Matheus Castello
 * 
 *  There is no peace only passion
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
header('Access-Control-Allow-Origin: *'); 

require_once 'laudb/LauDBSQLite.php';
require_once 'utils/SQLBuilderSQLite.php';

if(filter_input(INPUT_POST, 'createTable'))
{
    $createTable = json_decode(filter_input(INPUT_POST, 'createTable'));
    $lauDB = new LauDBSQLite("dataBase.lau");
    $sqlBuilder = new SQLBuilderSQLite();
    $sqlBuilder->setJSONObject($createTable);
    
    $lauDB->execute($sqlBuilder->createTable());
    
    $res = $lauDB->query($sqlBuilder->describeTable());
    $sqls = $sqlBuilder->alterTable($res);
    
    foreach ($sqls as $value) 
    {
        $lauDB->execute($value);
    }
}
