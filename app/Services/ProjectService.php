<?php
/**
 * Created by PhpStorm.
 * User: lucasgabrielnascimentomiranda
 * Date: 01/06/16
 * Time: 00:17
 */

namespace NettworkProject\Services;


use NettworkProject\Repositories\ProjectsRepository;
use NettworkProject\Validators\ProjectsValidator;

class ProjectService
{
    protected $repository;
    /**
     * @var ProjectsValidator
     */
    private $validator;

    /**
     * ClientService constructor.
     * @param ProjectsRepository $repository
     * @param ProjectsValidator $validator
     * @internal param $ProjectsRepository
     */
    public function __construct(ProjectsRepository $repository, ProjectsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        try {

            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessage()
            ];

        }

    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        try {

            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessage()
            ];

        }

    }
}