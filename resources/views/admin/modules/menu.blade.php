<header class="d-flex flex-nowrap">
    <h1 class="visually-hidden">{{__('Админка')}}</h1>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
        <a href="{{route('admin.room')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="{{route('admin.room')}}"></use></svg>
            <span class="fs-4">{{__('Админка')}}</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
           {{-- <li>
                <a href="{{route('admin.modules')}}" class="nav-link text-white">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="{{route('admin.modules')}}"></use></svg>
                    {{__('Модули')}}
                </a>
            </li>--}}
            <li>
                <a href="{{route('admin.pages')}}" class="nav-link text-white">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="{{route('admin.pages')}}"></use></svg>
                    {{__('Страницы')}}
                </a>
            </li>
            <li>
                <a href="{{route('admin.categories')}}" class="nav-link {{active_link('admin.categories')}} text-white">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="{{route('admin.categories')}}"></use></svg>
                    {{__('Категории')}}
                </a>
            </li>
           {{-- <li>
                <a href="{{route('admin.articles')}}" class="nav-link {{active_link('admin.articles')}} text-white">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="{{route('admin.articles')}}"></use></svg>
                    {{__('Статьи')}}
                </a>
            </li>
            <li>
                <a href="{{route('admin.reviews')}}" class="nav-link text-white">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="{{route('admin.reviews')}}"></use></svg>
                    {{__('Отзывы')}}
                </a>
            </li>--}}

            <li class="nav-item">
                <a href="{{route('admin.testing')}}" class="nav-link {{active_link('admin.testing')}} text-white" aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="{{route('admin.testing')}}"></use></svg>
                    {{__('Тесты')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link {{active_link('admin.users')}} text-white" aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="{{route('admin.users')}}"></use></svg>
                    {{__('Пользователи')}}
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown align-right">
            <a href="{{route('admin.room.close')}}" class="btn btn-primary">
                {{__("Выйти")}}
            </a>
            {{-- <x-form active="{{ route('admin.room.close') }}" method="post">
                <x-button type='submit' name="closeSession" >{{__("Выйти")}}</x-button>
            </x-form>--}}
            {{-- <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>--}}
        </div>
    </div>
</header>

