
    <table class="default_table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome do Gupo</th>
            <th>Valor investido no grupo</th>
            <th>Instituição</th>
            <th>Nome do Responsavel</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($group_list as $group)
            <tr>
                <th>{{ $group->id}}</th>
                <th>{{ $group->name}}</th>
                <th>R$ {{ number_format($group->total_value, 2, ',', '.') }}</th>
                <th>{{ $group->instituition->name}}</th>
                <th>{{ $group->owner->name}}</th>
                <th><form action="{{ route('group.destroy', $group->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Remover</button>
</form>
<a href="{{ route('group.show',$group->id)}}">Detalhes</a>
<a href="{{ route('group.edit',$group->id)}}">Editar</a>


</th>


    </tr>


        @endforeach
 
    </tbody>

</table>
