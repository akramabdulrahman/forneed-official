<?php

namespace App\Http\Controllers\Dashboard\Organizations;

use App\Models\Users\ServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\StatsController as stat;

class StatsController extends stat
{
    protected function model()
    {
        return ServiceProvider::class; // TODO: Change the autogenerated stub
    }


   
}
