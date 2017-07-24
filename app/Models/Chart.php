<?php

namespace App\Models;

use App\Models\Users\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    protected $fillable = [
        'theme_lib',
        'theme_chart',
        'element_label',
        'chart_title',
        'labels',
        'values',
        'datasets',
        'multi',
        'attr_list',
        'user_id',
        'model'
    ];
    protected $casts = [
        'labels' => 'array',
        'values' => 'array',
        'datasets' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chartable()
    {
        return $this->morphTo();
    }

    public function question()
    {
        return $this->morphTo(Question::class,'chartable');
    }


}
