<?php
namespace App\Services;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;


class GroupService
{
    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator$validator){
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        try 
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $group = $this->repository->create($data);
    
            return [
                'success' => true,
                'messages' => "Grupo cadastrado",
                'data'    => $group,
            ];
        }
        catch (\Exception $e)
        {
            return [
                'success' => false,
                'messages' => "Erro de execução: " . $e->getMessage(), // Incluindo mensagem de erro para debug
            ];
        }
    }
}