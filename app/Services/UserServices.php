<?php

namespace App\Services;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
class UserServices
{
    private $repository;
    private $validator;
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        try 
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $usuario = $this->repository->create($data);
    
            return [
                'success' => true,
                'messages' => "Usuário cadastrado",
                'data'    => $usuario,
            ];
        
        }
        catch (\Exception $e)
        {
            return [
                'success' => false,
                'messages' => "Erro de execução",
            ];
        }
    }
    
    public function update(){}
    public function delete(){}
}