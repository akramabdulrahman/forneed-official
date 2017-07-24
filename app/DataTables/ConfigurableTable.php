<?php
/**
 * Created by PhpStorm.
 * User: akramabdulrahman
 * Date: 5/3/2017
 * Time: 5:43 AM
 */

namespace App\DataTables;


interface ConfigurableTable
{
    public function ajaxConfig();

    public function repoConfig($model);

    public function setColumns($columns);

}