<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Citizen;

/**
 * Class CitizenTransformer
 * @package namespace App\Transformers;
 */
class CitizenTransformer extends TransformerAbstract
{

    /**
     * Transform the \Citizen entity
     * @param \Citizen $model
     *
     * @return array
     */
    public function transform(Citizen $model)
    {

        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
