
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
        @foreach ($group_list as $group)
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
