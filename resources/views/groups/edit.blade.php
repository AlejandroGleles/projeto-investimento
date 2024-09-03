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

<form method="POST" class="form-padrao" action="{{ route('group.update', $group->id) }}">
    @csrf
    @method('PUT')

    @include('templates.formulario.input', [
        'label' => 'Nome do Grupo',
        'input' => 'name',
        'value' => $group->name,  // Certifique-se de passar o valor atual do grupo
        'attributes' => ['placeholder' => 'Nome do grupo']
    ])

    @include('templates.formulario.select', [
        'label' => 'User',
        'select' => 'user_id',
        'data' => $user_list, // Dados para o select
        'selected' => $group->user_id, // Valor atual do grupo
        'attributes' => ['placeholder' => 'User']
    ])

    @include('templates.formulario.select', [
        'label' => 'Instituição',
        'select' => 'instituition_id',
        'data' =>$instituition, // Dados para o select
        'selected' => $group->instituition_id, // Valor atual do grupo
        'attributes' => ['placeholder' => 'Instituição']
    ])

    @include('templates.formulario.submit', [
        'input' => 'Atualizar'
    ])
</form>

@endsection
