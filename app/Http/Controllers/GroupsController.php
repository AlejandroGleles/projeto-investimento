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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $group = $this->repository->find($id);

        return view('groups.edit', compact('group'));
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
    public function update(GroupUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $group = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Group updated.',
                'data'    => $group->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $deleted = $this->repository->delete($id);

        return redirect()->route('group.index');
     }
}
