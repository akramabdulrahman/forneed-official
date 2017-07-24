<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraType extends Model
{
    protected $with = ['extras'];

    public function extras()
    {
        return $this->hasMany(Extra::class);
    }

    public static function getExtraTypes($types)
    {
        return self::whereIn('name', $types)
            ->get()->mapWithKeys(function ($item) {
                return [$item->name => $item->extras->pluck('extra', 'id')->toArray()];
            });
    }

    public static function getExtraTypesWithTypes($types)
    {
        return self::whereIn('name', $types)
            ->get()->mapWithKeys(function ($item) {
                return [$item->name => $item->extras->mapWithKeys(function ($row) {
                    return [$row->extra . ':' . $row->id . ':' . $row->name => $row->extra];
                })->toArray()];
            });
    }
}
