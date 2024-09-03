<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Repositories\InstituitionRepository;
use App\Repositories\UserRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;
use App\Entities\Group;

/**
 * Class GroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GroupsController extends Controller
{
    /**
     * @var GroupRepository
     */
    protected $repository;

    /**
     * @var GroupValidator
     */
    protected $validator;

    protected $service;

    protected $instituitionRepository;
    protected $userRepository;

    /**
     * GroupsController constructor.
     *
     * @param GroupRepository $repository
     * @param GroupValidator $validator
     * @param GroupService $service
     * @param InstituitionRepository $instituitionRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        GroupRepository $repository,
        GroupValidator $validator,
        GroupService $service,
        InstituitionRepository $instituitionRepository,
        UserRepository $userRepository
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->instituitionRepository = $instituitionRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $groups = $this->repository->all();
    $user_list = $this->userRepository->selectBoxList(); // Obtém a lista de usuários
    $instituition_list = $this->instituitionRepository->selectBoxList(); // Obtém a lista de instituições

    return view('groups.index', [
        'groups' => $groups,
        'users' => $user_list, // Passa a lista de usuários para a view
        'institutions' => $instituition_list, // Passa a lista de instituições para a view
    ]);
}


    // Outras funções (store, show, edit, update, destroy) permanecem inalteradas


    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GroupCreateRequest $request)
    {
        $result = $this->service->store($request->all());
        $group = $result['success'] ? $result['data'] : null;

        session()->flash("success", [
            'success' => $result['success'],
            'messages' => $result['messages'],
        ]);

        return redirect()->route('group.index');
    }
    public function userStore(Request $request,$group_id)
    {
        $result = $this->service->userStore($group_id,$request->all());
        

        session()->flash("success", [
            'success' => $result['success'],
            'messages' => $result['messages'],
        ]);

        return redirect()->route('group.show',[$group_id]);
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
        $group = $this->repository->find($id);
        $user_list = $this->userRepository->selectBoxList();

        return view('groups.show', [
            'group'=> $group,   
            'user_list'=> $user_list
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $user_list = $this->userRepository->selectBoxList();
        $instituition = $this->instituitionRepository->selectBoxList();

        return view('groups.edit', [
            'group'=> $group,
            'user_list'=>$user_list,
            'instituition'=>$instituition,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request,$group_id)
    {
        $result = $this->service->update($group_id, $request->all());
        

        session()->flash("success", [
            'success' => $result['success'],
            'messages' => $result['messages'],
        ]);

        return redirect()->route('group.index');
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
        $deleted = $this->repository->delete($id);

        return redirect()->route('group.index');
     }
}
