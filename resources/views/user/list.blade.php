<table class="default_table">
        <thead>
            <tr>
                <td>#</td>
                <td>CPF</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Nascimento</td>
                <td>E-mail</td>
                <td>Status</td>
                <td>Permisão</td>
                <td>Menu</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($user_list as $user)
            
            
            <tr>
             <td>{{$user->id}}</td>
             <td>{{$user->Formatted_cpf}}</td>
             <td>{{$user->name}}</td>
             <td>{{$user->Formatted_phone}}</td>
             <td>{{$user->Formatted_birth}}</td>
             <td>{{$user->email}}</td>
             <td>{{$user->status}}</td>
             <td>{{$user->permission}}</td>
             <td>
             
    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Remover</button>
    </form>
    <a href="{{ route('user.edit',$user->id)}}">Edite</a>
</td>



            </tr>
            @endforeach
        </tbody>
    </table>