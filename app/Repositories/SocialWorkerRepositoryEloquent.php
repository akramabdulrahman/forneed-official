<?php

namespace App\Repositories;

use App\Models\Users\SocialWorker;
use App\Repositories\Traits\DatatableRender;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class SocialWorkerRepositoryEloquent
 * @package namespace App\Repositories\Models\Users;
 */
class SocialWorkerRepositoryEloquent extends BaseRepository implements SocialWorkerRepository
{
    use DatatableRender;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SocialWorker::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
