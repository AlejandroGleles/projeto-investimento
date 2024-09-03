@extends('templates.master')

@section('conteudo-view')

<form method="POST" class="form-padrao" action="{{ route('instituition.product.store', $instituitions->id) }}">
    @csrf
  
    @include('templates.formulario.input', [
        'label' => 'Nome do Produto',
        'input' => 'name',
        'attributes' => ['placeholder' => 'Nome do Produto']
    ])
    @include('templates.formulario.input', [
        'label' => 'Descrição',
        'input' => 'description',
        'attributes' => ['placeholder' => 'Descrição']
    ])
    @include('templates.formulario.input', [
        'label' => 'Indexador',
        'input' => 'index',
        'attributes' => ['placeholder' => 'Indexador']
    ])
    @include('templates.formulario.input', [
        'label' => 'Taxa de Juros',
        'input' => 'interest_rate',
        'attributes' => ['placeholder' => 'Taxa de Juros']
    ])

    @include('templates.formulario.submit', [
        'input' => 'Cadastrar'
    ])
</form>

<table class="default_table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Indexador</th>
            <th>Taxa</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @forelse($instituitions->products as $product)
            <tr>
                <th>{{ $product->id }}</th>
                <th>{{ $product->name }}</th>
                <th>{{ $product->description }}</th>
                <th>{{ $product->index }}</th>
                <th>{{ $product->interest_rate }}</th>
                <th>
                <form action="{{ route('instituition.product.destroy', [$instituitions->id, $product->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Remover</button>
</form>

    <a href="">Editar</a>
    </th>
            </tr>
        @empty
            <tr>
                <th>Nada cadastrado</th>

            </tr>
        @endforelse
    </tbody>
</table>


@endsection

