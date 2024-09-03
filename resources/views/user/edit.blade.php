@extends('templates.master')

@section('css-view')
    <!-- Adicione seu CSS aqui -->
@endsection

@section('js-view')
    <!-- Adicione seu JavaScript aqui -->
@endsection

@section('conteudo-view')
@if (session('success'))
    <h3>{{ session('success')['messages'] }}</h3>

@endif

<form method="POST" class="form-padrao" action="{{ route('user.update', $user->id) }}">
    @csrf
    @method('PUT')

    @include('templates.formulario.input', [
        'label' => 'CPF',
        'input' => 'cpf',
        'value' => $user->cpf, 
        'attributes' => ['placeholder' => 'CPF']
    ])
    
    @include('templates.formulario.input', [
        'input' => 'name',
        'value' => $user->name, 
        'attributes' => ['placeholder' => 'Nome']
    ])
    
    @include('templates.formulario.input', [
        'input' => 'phone',
        'value' => $user->phone, 
        'attributes' => ['placeholder' => 'Telefone']
    ])
    
    @include('templates.formulario.input', [
        'input' => 'email',
        'value' => $user->email,  
        'attributes' => ['placeholder' => 'E-mail']
    ])
    
    @include('templates.formulario.input', [
        'input' => 'password',
        'attributes' => ['placeholder' => 'Senha']
    ])
    
    @include('templates.formulario.submit', [
        'input' => 'Atualizar'
    ])
</form>




 @endsection
