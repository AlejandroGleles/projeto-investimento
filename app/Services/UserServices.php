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
                'messages' => "Erro de execução: " . $e->getMessage(), // Incluindo mensagem de erro para debug
            ];
        }
    }
    
    
    public function update($data,$id)
    {
        try 
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $usuario = $this->repository->update($data, $id);
    
            return [
                'success' => true,
                'messages' => "Usuário Atualizado",
                'data'    => $usuario,
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
    public function delete($user_id) {
        try {
            // Verifica se o usuário existe
            $user = $this->repository->find($user_id);
            if (!$user) {
                return [
                    'success' => false,
                    'messages' => "Usuário não encontrado",
                ];
            }
    
            // Remove o usuário
            $this->repository->delete($user_id);
    
            return [
                'success' => true,
                'messages' => "Usuário removido",
                'data'    => null,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'messages' => "Erro de execução: " . $e->getMessage(),
            ];
        }
    }
    

}