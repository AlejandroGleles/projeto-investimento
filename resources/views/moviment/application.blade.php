@extends('templates.master')

@section('conteudo-view')

@if (session('success'))
    <h3>{{ session('success')['messages'] }}</h3>

@endif

<form method="post" class="form-padrao" action="{{ route('moviment.application.store') }}">
    @csrf


    @include('templates.formulario.select', [
    'label' => 'Grupo',
    'select' => 'group_id',
    'data' => $group_list ?? [], 
    'attributes' => ['placeholder' => 'Grupo']
])

@include('templates.formulario.select', [
    'label' => 'Produto',
    'select' => 'product_id',
    'data' => $product_list ?? [], 
    'attributes' => ['placeholder' => 'Produto']
])

    @include('templates.formulario.input', [
        'label' => 'Valor',
        'input' => 'value',
        'attributes' => ['placeholder' => 'Valor']
    ])

    @include('templates.formulario.submit', [
        'input' => 'Cadastrar'
    ])
</form>

@endsection