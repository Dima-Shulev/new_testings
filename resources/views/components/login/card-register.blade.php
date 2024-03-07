<x-card.card class="card mb-3">
             <x-card.card-header>
                 <x-card.card-title>
                 {{ __('Регистрация') }}
                 </x-card.card-title>
              <x-slot name="right">
                  <a href="{{ route('login') }}">{{__('Вход')}}</a>
              </x-slot>
             </x-card.card-header>
             <x-card.card-body>
                 <x-form.form action="{{ route('register.store')}}" method="post" enctype="multipart/form-data">
                     <x-form.form-item>
                         <x-form.label required>
                             {{ __('Имя или логин') }}
                         </x-form.label>
                         <x-form.input type="text" name="name" value="{{ old('name') }}" autofocus />
                     </x-form.form-item>
                     <x-form.form-item>
                         <x-form.label required>
                             {{ __('Email') }}
                         </x-form.label>
                         <x-form.input type="email" name="email" value="{{ old('email') }}"/>
                     </x-form.form-item>
                     <x-form.form-item>
                         <x-form.label required>
                             {{ __('Пароль') }}
                         </x-form.label>
                         <x-form.input type="password" name="password" />
                     </x-form.form-item>
                     <x-form.form-item>
                         <x-form.label required>
                             {{ __('Пароль еще раз') }}
                         </x-form.label>
                         <x-form.input type="password" name="password_confirmation"  />
                     </x-form.form-item>
                     <x-form.form-item>
                         <x-form.label>
                             {{ __('Ваш аватар:') }}
                         </x-form.label>
                         <x-form.input type="file" name="avatar" />
                     </x-form.form-item>
                     <x-form.form-item>
                         <x-login.checkbox-reg name="politic" value="1" id="politic">
                             {{ __('Я согласен на обработку моих персональных данных') }}
                         </x-login.checkbox-reg>
                     </x-form.form-item>
                     <x-form.button type="submit" {{--color="success" size="sm"--}}>{{ __('Зарегистрироваться') }}</x-form.button>
                 </x-form.form>
             </x-card.card-body>
</x-card.card>
