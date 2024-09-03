@extends('templates.master')

@section('conteudo-view')
<header>
    <h1>Nome do grupo: {{$group->name}}</h1>
    <h2>
        Instituição: 
        {{$group->instituition->name}}
    </h2>
    <h2>
        Responsavel: 
        {{$group->owner->name}}
    </h2>

</header>


<form method="post" class="form-padrao" action="{{ route('group.user.store', $group->id) }}">
    @csrf
    @include('templates.formulario.select', [
        'label' => 'Usuario',
        'select' => 'user_id',
        'data' => $user_list, // Certifique-se de passar os dados corretos para o select
        'attributes' => ['placeholder' => 'Usuario']
    ])
    @include('templates.formulario.submit', [
        'input' => 'Relacionar ao Grupo: ' . $group->name
    ])
</form>
@include('user.list',['user_list'=> $group->users])


@endsection