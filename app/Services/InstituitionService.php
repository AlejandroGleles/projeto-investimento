<?php

namespace App\Services;
use App\Repositories\InstituitionRepository;
use App\Validators\InstituitionValidator;
use Prettus\Validator\Contracts\ValidatorInterface;


class InstituitionService
{
    private $repository ;
    private $validator ;

    public function __construct(InstituitionRepository $repository, InstituitionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    public function store($data)
    {
        try 
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $instituition = $this->repository->create($data);
    
            return [
                'success' => true,
                'messages' => "Instituição cadastrado",
                'data'    => $instituition,
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

    public function update(array $data, $id)
{
    try
    {
        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $instituition = $this->repository->update($data, $id);

        return [
            'success' => true,
            'messages' => "Instituição atualizada",
            'data'    => $instituition,
        ];
    }
    catch (\Exception $e)
    {
        return [
            'success' => false,
            'messages' => "Erro de execução: " . $e->getMessage(),
        ];
    }
}



}