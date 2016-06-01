<?php

namespace NettworkProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use NettworkProject\Repositories\ProjectsRepository;
use NettworkProject\Entities\Projects;
use NettworkProject\Validators\ProjectsValidator;

/**
 * Class ProjectsRepositoryEloquent
 * @package namespace NettworkProject\Repositories;
 */
class ProjectsRepositoryEloquent extends BaseRepository implements ProjectsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Projects::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProjectsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
