<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Password;

class DashboardController extends Controller
{
    private $userRepository;
    private $validator;
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        return view("user.dashboard");
    }
    public function auth(Request $request)
    {
        // Assegure que o valor de 'email' corresponde ao campo no banco de dados
        $credentials = [
            'email'    => $request->get('username'), // Altere para 'username' se necessário
            'password' => $request->get('password'), // 'password' deve ser com 'p' minúsculo
        ];
        
        if (\Auth::attempt($credentials)) {
            // Se as credenciais forem válidas, redirecione para o dashboard
            return redirect()->route('user.dashboard');
        } else {
            // Se as credenciais não coincidirem, redirecione de volta com uma mensagem de erro
            return redirect()->route('login.form')
                ->withErrors(['error' => 'Credenciais inválidas. Por favor, tente novamente.']);
        }
    }
    
}
