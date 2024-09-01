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


    <form method="post" class="form-padrao" action="{{ route('user.store') }}">
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

    <table class="default_table">
        <thead>
            <tr>
                <td>#</td>
                <td>CPF</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Nascimento</td>
                <td>E-mail</td>
                <td>Status</td>
                <td>Permisão</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            
            
            <tr>
             <td>{{$user->id}}</td>
             <td>{{$user->cpf}}</td>
             <td>{{$user->name}}</td>
             <td>{{$user->phone}}</td>
             <td>{{$user->birth}}</td>
             <td>{{$user->email}}</td>
             <td>{{$user->status}}</td>
             <td>{{$user->permission}}</td>


            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Fim do Formulário -->
@endsection
