<div {{ $attributes }}>
    @switch($slot)
        @case($slot == 'register')
        {{ __('Поздравляю. Вы зарегистрировались!') }}
        @break
        @case($slot == 'entrance')
        {{ __('Поздравляю. Вы авторезировались !') }}
        @break
        @case($slot == 'success_update_pass')
        {{ __('Поздравляю. Вы изменили пароль !') }}
        @break
        @case($slot == 'update_user')
        {{ __('Поздравляю. Вы обновили данные !') }}
        @break
        @case($slot == 'update_category')
        {{ __('Поздравляю. Вы обновили категорию !') }}
        @break
        @case($slot == 'create_category')
        {{ __('Поздравляю. Вы создали категорию !') }}
        @break
        @case($slot == 'update_article')
        {{ __('Поздравляю. Вы обновили статью !') }}
        @break
        @case($slot == 'create_article')
        {{ __('Поздравляю. Вы создали статью !') }}
        @break

        @case($slot == 'create_review')
        {{ __('Большое спасибо за Ваш отзыв !') }}
        @break
        @case($slot == 'success_verify_email')
        {{ __('Поздравляю. Проверка почты завершена !') }}
        @break
        @case($slot == 'exit_room')
        {{ __('Поздравляю. Вы вышли из кабинета !') }}
        @break
        @case($slot == 'update_page')
        {{ __('Поздравляю. Вы обновили страницу !') }}
        @break
    @endswitch
</div>
