<header data-bs-theme="dark">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
   <div class="container-fluid">
        {{--<a class="navbar-brand" href="#">Carousel</a>--}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        @if(isset($links))
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            @foreach($links as $page)
                <li class="nav-item">
                    <a class="nav-link {{ active_link($page->url) }}" aria-current="page" href="{{route("show",[$page->url])}}">{{$page->name}}</a>
                </li>
            @endforeach
        </ul>
          <x-authorization.authorization />
        @endif
       <form class="d-flex" role="search">
          <input class="form-control me-1 mb-1" type="search" placeholder="{{__('Что ищем ...')}}" aria-label="Search" name="query">
          <button class="btn btn-outline-success me-1 mb-1" type="submit">{{__('Поиск')}}</button>
       </form>
    </div>
   </div>
  </nav>
</header>
