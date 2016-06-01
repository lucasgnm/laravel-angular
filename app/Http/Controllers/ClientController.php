<?php

namespace NettworkProject\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use NettworkProject\Http\Requests;
use NettworkProject\Repositories\ClientRepository;

class ClientController extends Controller
{


    /**
     * @var ClientRepository
     */

    private $repository;

    /**
     * ClientController constructor.
     * @param ClientRepository $repository
     */

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
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
        return $this->repository->create($request->all());
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
            $this->repository->find($id)->update($request->all());
            return response()->json(['success'=>'Usuario atualizado com sucesso!']);
        }
        catch(ModelNotFoundException $e){
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
        catch(ModelNotFoundException $e){
            return ['error'=>'Cliente não encontrado.'];
        }
    }
}
