<?php

namespace NettworkProject\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use NettworkProject\Http\Requests;
use NettworkProject\Repositories\ClientRepository;
use NettworkProject\Services\ClientService;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class ClientController extends Controller
{


    /**
     * @var ClientRepository
     */

    private $repository;

    /**
     * @var ClientService
     */
    private $service;

    /**
     * ClientController constructor.
     * @param ClientRepository $repository
     * @param ClientService $service
     */

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @return Collection|static[]
     * @internal param ClientRepository $repository
     */

    public function index()
    {
        return $this->repository->all();
    }

    /**
     * @param Request $request
     * @return static
     */

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     * @internal param ClientRepository $repository
     */

    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|JsonResponse
     * @internal param ClientRepository $repository
     */

    public function update(Request $request,$id)
    {
        try{
            $this->service->update($request->all(), $id);
            return response()->json(['success'=>'Usuario atualizado com sucesso!']);
        }
        catch(InvalidParameterException $e){
            return ['error'=>'Cliente não encontrado.'];
        }
    }

    /**
     * @param $id
     * @return array|JsonResponse
     * @internal param ClientRepository $repository
     */

    public function destroy($id)
    {
        try{
            $this->repository->find($id)->delete();
            return response()->json(['success'=>'Usuario excluido com sucesso!']);
        }
        catch(InvalidParameterException $e){
            return ['error'=>'Cliente não encontrado.'];
        }
    }
}
