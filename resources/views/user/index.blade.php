@extends('templates.master')

@section('css-view')
    <!-- Adicione seu CSS aqui -->
@endsection

@section('js-view')
    <!-- Adicione seu JavaScript aqui -->
@endsection

@section('conteudo-view')
    <!-- Início do Formulário -->
    <form method="post" class="form-padrao">
        @csrf

        @include('templates.formulario.input', [
            'label' => 'CPF',
            'input' => 'cpf',
            'attributes' => ['placeholder' => 'CPF']
        ])
        
        @include('templates.formulario.input', [
            'input' => 'name',
            'attributes' => ['placeholder' => 'Nome']
        ])
        
        @include('templates.formulario.input', [
            'input' => 'phone',
            'attributes' => ['placeholder' => 'Telefone']
        ])
        
        @include('templates.formulario.input', [
            'input' => 'email',
            'attributes' => ['placeholder' => 'E-mail']
        ])
        
        @include('templates.formulario.input', [
            'input' => 'password',
            'attributes' => ['placeholder' => 'Senha']
        ])
        
        @include('templates.formulario.submit', [
            'input' => 'Cadastrar'
        ])
    </form>
    <!-- Fim do Formulário -->
@endsection
