<?php

namespace App\Models;

use App\Models\Users\Citizen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Sector",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      )
 * )
 */
class Sector extends Model
{
    use SoftDeletes;

    public $table = 'sectors';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'deleted_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function serviceTypes()
    {
        return $this->hasMany(ServiceType::class);
    }

    public function serviceProviders()
    {
        return $this->belongsToMany(ServiceProvider::class);
    }

    public function citizens()
    {
        return $this->belongsToMany(Citizen::class);
    }
}
