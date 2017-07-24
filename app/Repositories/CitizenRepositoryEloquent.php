<?php

namespace App\Repositories;

use App\Repositories\Traits\DatatableRender;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CitizenRepository;
use App\Models\Users\Citizen;
use App\Validators\CitizenValidator;

/**
 * Class CitizenRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CitizenRepositoryEloquent extends BaseRepository implements CitizenRepository
{
    use DatatableRender;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Citizen::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
