@extends('templates.master')

@section('conteudo-view')

@if (session('success'))
    <h3>{{ session('success')['messages'] }}</h3>

@endif

<form method="POST" class="form-padrao" action="{{ route('instituition.update', $instituition->id) }}">
    @csrf
    @method('PUT')

    @include('templates.formulario.input', [
        'input' => 'name',
        'value' => $instituition->name, 
        'attributes' => ['placeholder' => 'Nome']
    ])

    @include('templates.formulario.submit', [
        'input' => 'Atualizar'
    ])
</form>

@endsection