<div {{ $attributes }}>
    @switch($slot)
    @case($slot == 'error_email')
    {{ __('Ошибка. Такого Email не существует в базе данных !') }}
    @break
    @case($slot == 'error_pass')
    {{ __('Ошибка. Пароль не верный !') }}
    @break
    @case($slot == 'error_active')
    {{ __('Ошибка. Вы были заблокированы модератором !') }}
    @break
    @case($slot == 'error_user')
    {{ __('Ошибка. Такой Email уже существует в базе !') }}
    @break
    @case($slot == 'error_user_name_or_password')
    {{ __('Ошибка. Неверный логин или пароль !') }}
    @break
    @case($slot == 'error_update_category')
    {{ __('Упс. Ошибка при обновлении категории !') }}
    @break
    @case($slot == 'error_create_category')
    {{ __('Упс. Ошибка при создании категории !') }}
    @break
    @case($slot == 'error_update_article')
    {{ __('Упс. Ошибка при обновлении статьи !') }}
    @break
    @case($slot == 'error_create_testing')
    {{ __('Упс. Ошибка при создании теста !') }}
    @break
    @case($slot == 'error_update_testing')
    {{ __('Упс. Ошибка при обновлении теста !') }}
    @break
    @case($slot == 'error_create_article')
    {{ __('Упс. Ошибка при создании статьи !') }}
    @break
    @case($slot == 'error_create_page')
    {{ __('Упс. Ошибка при создании страницы !') }}
    @break
    @case($slot == 'error_update_page')
    {{ __('Упс. Ошибка при обновлении страницы !') }}
    @break
    @case($slot == 'error_user_status')
    {{ __('Упс. Ошибка неверный статус !') }}
    @break
    @endswitch
</div>
