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
        try{
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Cliente não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao localizar o cliente.'];
        }

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
            return response()->json(['success'=> true, 'Usuario atualizado com sucesso!']);
        } catch (QueryException $e) {
            return ['error'=>true, 'Cliente não pode ser atualizado.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Cliente não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao atualizar o cliente.'];
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
            return response()->json(['success'=>true, 'Usuario excluido com sucesso!']);
        } catch (QueryException $e) {
            return ['error'=>true, 'Cliente não pode ser excluido devido ter relações com um ou mais projetos.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Cliente não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o cliente.'];
        }
    }
}
