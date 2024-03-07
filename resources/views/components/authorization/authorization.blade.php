@if((session()->has('session_user')) && (session('session_status') === 'session_user') && (Auth::user()->email_verified_at !== null))
    <li class="nav-item">
        <b><a href="{{route('auth.room.balance')}}" title="{{__('Пополнить')}}" class="me-1 mb-1">Баланс: {{ session('balance')}}</a></b>
        <a class="me-1 {{ active_link('login') }}" href="{{ route('auth.room') }}" aria-current="page">{{__("Личный кабинет")}}</a>
    </li>
@else
    <li class="nav-item">
        <a class="btn btn-warning me-1 mb-1 {{ active_link('login') }}" href="{{ route('login') }}" aria-current="page">{{__("Вход")}}</a>
        <a class="btn btn-warning me-1 mb-1 {{ active_link('register') }}"  href="{{ route('register') }}" aria-current="page">{{__("Регистрация")}}</a>
    </li>
@endif
