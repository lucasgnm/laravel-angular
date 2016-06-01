<?php

namespace NettworkProject\Repositories;

use NettworkProject\Entities\Clients;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use NettworkProject\Repositories\ClientRepository;
use NettworkProject\Entities\Client;
use NettworkProject\Validators\ClientValidator;

/**
 * Class ClientRepositoryEloquent
 * @package namespace NettworkProject\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    public function model()
    {
        return Clients::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
