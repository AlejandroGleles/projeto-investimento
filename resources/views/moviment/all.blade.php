@extends('templates.master')

@section('conteudo-view')

@if (session('success'))
    <h3>{{ session('success')['messages'] }}</h3>

@endif



<table class="default_table">
    <thead>
        <tr>
            <th>Data</th>
            <th>Tipo</th>
            <th>Produto</th>
            <th>Grupo</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($moviment_list as $moviment)
            <tr>
                <th>{{ $moviment->created_at->format("d/m/y")}}</th>
                <th>{{ $moviment->type == 1 ? "Aplicação" : "Resgate"}}</th>
                <th>{{ $moviment->product->name}}</th>
                <th>{{ $moviment->group->name}}</th>
                <th>{{ $moviment->value}}</th>

                <th>
        
        @endforeach
 
    </tbody>

</table>

@endsection