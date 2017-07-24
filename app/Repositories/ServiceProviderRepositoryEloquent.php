<?php

namespace App\Repositories;

use App\Repositories\Traits\DatatableRender;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ServiceProviderRepository;
use App\Models\Users\ServiceProvider;
use App\Validators\ServiceProviderValidator;

/**
 * Class ServiceProviderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ServiceProviderRepositoryEloquent extends BaseRepository implements ServiceProviderRepository
{
    use DatatableRender;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ServiceProvider::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
