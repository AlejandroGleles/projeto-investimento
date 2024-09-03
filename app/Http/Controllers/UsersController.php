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
        $users = $this->repository->all();
        return view("user.index",[
            "users"=> $users
        ]);
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
        $result = $this->service->store($request->all());
        $usuario = $result['success'] ? $result['data'] : null;
    
        session()->flash("success", [
            'success' => $result['success'],
            'messages' => $result['messages'],
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

        return view('user.edit',[
            'user'=> $user,
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     * @return JsonResponse|RedirectResponse
     * @throws ValidatorException
     */
    public function update(Request $request, $id)
    {
        $result = $this->service->update($request->all(),$id);
        $usuario = $result['success'] ? $result['data'] : null;
    
        session()->flash("success", [
            'success' => $result['success'],
            'messages' => $result['messages'],
        ]);
    
        return redirect()->route('user.index')->with('usuario', $usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse|RedirectResponse
     */
    
    public function destroy($id)
    {
        $result = $this->service->delete($id);
    
        session()->flash("success", [
            'success' => $result['success'],
            'messages' => $result['messages'],
        ]);
    
        return redirect()->route('user.index');
    
    }
}
