<?php
/**
 * Created by PhpStorm.
 * User: lucasgabrielnascimentomiranda
 * Date: 31/05/16
 * Time: 23:14
 */

namespace NettworkProject\Services;


use NettworkProject\Repositories\ClientRepository;
use NettworkProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{

    protected $repository;
    /**
     * @var ClientValidator
     */
    private $validator;

    /**
     * ClientService constructor.
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository, ClientValidator $validator)
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