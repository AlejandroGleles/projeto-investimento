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
<table class="default_table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome do Gupo</th>
            <th>Instituição</th>
            <th>Nome do Responsavel</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groups as $group)
            <tr>
                <th>{{ $group->id}}</th>
                <th>{{ $group->name}}</th>
                <th>{{ $group->instituition->name}}</th>
                <th>{{ $group->owner->name}}</th>
                <th><form action="{{ route('group.destroy', $group->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Remover</button>
</form></th>


    </tr>


        @endforeach
 
    </tbody>

</table>

@endsection
