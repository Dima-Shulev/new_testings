<footer class="bg-dark text-white w-100 p-1 mb-0">
    <div class="hrLine"></div>
    <div class="d-flex justify-content-around align-items-start">
        @if(!$footerLinks->isEmpty())
            <div class="mt-2">
                <h4 class="footerLink"><u>{{__('Полезные ссылки:')}}</u></h4>
                <ul>
                    @foreach($footerLinks as $link)
                        @if($link->position === "right")
                            <li>
                                <a href="{{route('footer.show',$link->url)}}" class="footerLk">{{$link->link}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="mt-2">
                <h4 class="footerLink"><u>{{__('Информация:')}}</u></h4>
                <ul>
                    @foreach($footerLinks as $link)
                        @if($link->position === "left")
                            <li>
                                <a href="{{route('footer.show',$link->url)}}" class="footerLk">{{$link->link}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between m-1">
         <p></p>
         <p>{{__('Онлайн тестирование. ')}}© {{__('2023–2024 год.')}}</p>
         <p><a href="#">{{__('Вверх страницы')}}</a></p>
     </div>
</footer>
