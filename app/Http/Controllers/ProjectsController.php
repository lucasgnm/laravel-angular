<?php

namespace NettworkProject\Http\Controllers;

use Illuminate\Http\Request;

use NettworkProject\Http\Requests;
use NettworkProject\Services\ProjectService;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use NettworkProject\Http\Requests\ProjectsCreateRequest;
use NettworkProject\Http\Requests\ProjectsUpdateRequest;
use NettworkProject\Repositories\ProjectsRepository;
use NettworkProject\Validators\ProjectsValidator;


class ProjectsController extends Controller
{

    /**
     * @var ProjectsRepository
     */
    protected $repository;

    /**
     * @var ProjectService
     */
    protected $service;


    /**
     * ProjectsController constructor.
     * @param ProjectsRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectsRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->with(['owner','client'])->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param $Request
     */
    public function store(Request $request)
    {

        return $this->service->create($request->all());

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return $this->repository->with(['owner','client'])->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao localizar o projeto.'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  string $id
     * @return Response
     * @internal param $Request
     */
    public function update(Request $request, $id)
    {
        try {
            $this->service->update($request->all(), $id);
            return response()->json(['success'=> true,'Projeto atualizado com sucesso!']);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao atualizar o projeto.'];
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->repository->find($id)->delete();
            return response()->json(['success'=>'Projeto excluido com sucesso!']);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
    }
}
