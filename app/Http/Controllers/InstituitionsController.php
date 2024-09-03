<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Http\Requests\InstituitionCreateRequest;
use App\Http\Requests\InstituitionUpdateRequest;
use App\Repositories\InstituitionRepository;
use App\Validators\InstituitionValidator;
use App\Services\InstituitionService;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class InstituitionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstituitionsController extends Controller
{
    /**
     * @var InstituitionRepository
     */
    protected $repository;

    /**
     * @var InstituitionValidator
     */
    protected $validator;

    protected $service;

    /**
     * InstituitionsController constructor.
     *
     * @param InstituitionRepository $repository
     * @param InstituitionValidator $validator
     * @param InstituitionService $service
     */
    public function __construct(InstituitionRepository $repository, InstituitionService $service)
    {
        $this->repository = $repository;
      
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|JsonResponse
     */
    public function index(): View
    {
        $instituitions = $this->repository->all();
        return view("instituitions.index", [
            "instituitions" => $instituitions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstituitionCreateRequest $request
     *
     * @return JsonResponse|RedirectResponse
     *
     * @throws ValidatorException
     */
    public function store(InstituitionCreateRequest $request)
    {
        $result = $this->service->store($request->all());
        $instituition = $result['success'] ? $result['data'] : null;

        session()->flash("success", [
            'success' => $result['success'],
            'messages' => $result['messages'],
        ]);

        return redirect()->route('instituition.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Factory|View|JsonResponse
     */
    public function show($id)
    {
        $instituition = $this->repository->find($id);


        return view('instituitions.show',[
            'instituition'=> $instituition
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $instituition = $this->repository->find($id);
        return view('instituitions.edit', compact('instituition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstituitionUpdateRequest $request
     * @param  string $id
     *
     * @return JsonResponse|RedirectResponse
     *
     * @throws ValidatorException
     */
    public function update(InstituitionUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $instituition = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Instituition updated.',
                'data'    => $instituition->toArray(),
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
     * @return JsonResponse|RedirectResponse
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return redirect()->route('instituition.index');
    }
}
