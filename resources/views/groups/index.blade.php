@extends('templates.master')

@section('conteudo-view')

<form method="post" class="form-padrao" action="{{ route('group.store') }}">
    @csrf

    @include('templates.formulario.input', [
        'label' => 'Nome do Grupo',
        'input' => 'name',
        'attributes' => ['placeholder' => 'Nome do grupo']
    ])

    @include('templates.formulario.select', [
        'label' => 'User',
        'select' => 'user_id',
        'data' => $users, // Certifique-se de passar os dados corretos para o select
        'attributes' => ['placeholder' => 'User']
    ])

    @include('templates.formulario.select', [
        'label' => 'Instituição',
        'select' => 'instituition_id',
        'data' => $institutions, // Certifique-se de passar os dados corretos para o select
        'attributes' => ['placeholder' => 'Instituição']
    ])

    @include('templates.formulario.submit', [
        'input' => 'Cadastrar'
    ])
</form>
@include('groups.list',['group_list'=> $groups])


@endsection
