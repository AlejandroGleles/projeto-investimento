@extends('templates.master')

@section('conteudo-view')

@if (session('success'))
    <h3>{{ session('success')['messages'] }}</h3>

@endif

<form method="post" class="form-padrao" action="{{ route('instituition.store') }}">
@csrf
@include('templates.formulario.input', [
            'input' => 'name',
            'attributes' => ['placeholder' => 'Nome']
        ])
        @include('templates.formulario.submit', [
            'input' => 'Cadastrar'
        ])
</form>

<table class="default_table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome da Instituição</th>
            <th>Opção</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($instituitions as $inst)
            <tr>
                <th>{{ $inst->id}}</th>
                <th>{{ $inst->name}}</th>
                <th>
                <form action="{{ route('instituition.destroy', $inst->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Remover</button>
</form>
<a href="{{ route('instituition.show',$inst->id)}}">Detalhes</a>
<a href="{{ route('instituition.edit',$inst->id)}}">Editar</a>

                </th>
                
            </tr>


        @endforeach
 
    </tbody>

</table>

@endsection