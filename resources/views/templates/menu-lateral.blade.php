<nav id="principal">
    <ul>
        <li>
            <a href="{{ route('user.index')}}">
                <i class=""><span class="material-symbols-outlined">account_circle</span></span></i>
                <h3>Usuario</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('instituition.index')}}">
                <i class=""><span class="material-symbols-outlined">account_balance</span></i>
                <h3>Instituição</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('group.index')}}">
                <i class=""><span class="material-symbols-outlined">groups</span></i>
                <h3>Grupo</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('moviment.application')}}">
                <i class=""><span class="material-symbols-outlined">universal_currency_alt</span></i>
                <h3>Investir</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('moviment.index')}}">
                <i class=""><span class="material-symbols-outlined">money</span></i>
                <h3>Aplicações</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('moviment.all')}}">
                <i class=""><span class="material-symbols-outlined">currency_exchange</span></i>
                <h3>Extrato</h3>
            </a>
        </li>
    </ul>
</nav>