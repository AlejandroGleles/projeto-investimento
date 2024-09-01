<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;
    protected $service;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserServices $service)
    {
        $this->repository = $repository;
        $this->service = $service;
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|JsonResponse
     */
    public function index()
    {
        return view("user.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     * @return JsonResponse|RedirectResponse
     * @throws ValidatorException
     */
    public function store(UserCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        $usuario = $request['success'] ? $request['data'] : null;

   

        session()->flash("success",[
            'success'=> $request['success'],
            'massages' => $request['messagens'],
        ]);

        
        return redirect()->route('user.index')->with('usuario', $usuario);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Factory|View|JsonResponse
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     * @return JsonResponse|RedirectResponse
     * @throws ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
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
     * @return JsonResponse|RedirectResponse
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
}
