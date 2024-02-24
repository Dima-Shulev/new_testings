<x-card class="card mb-3">
             <x-card-header>
                 <x-card-title>
                 {{ __('Регистрация') }}
                 </x-card-title>

              <x-slot name="right">
                  <a href="{{ route('login') }}">{{__('Вход')}}</a>
              </x-slot>

             </x-card-header>

             <x-card-body>
                 <x-form action="{{ route('register.store')}}" method="post" enctype="multipart/form-data">
                     <x-form-item>
                         <x-label required>
                             {{ __('Имя или логин') }}
                         </x-label>
                         <x-input type="text" name="name" value="{{ old('name') }}" autofocus />
                     </x-form-item>

                     <x-form-item>
                         <x-label required>
                             {{ __('Email') }}
                         </x-label>
                         <x-input type="email" name="email" value="{{ old('email') }}"/>
                     </x-form-item>

                     <x-form-item>
                         <x-label required>
                             {{ __('Пароль') }}
                         </x-label>
                         <x-input type="password" name="password" />
                     </x-form-item>

                     <x-form-item>
                         <x-label required>
                             {{ __('Пароль еще раз') }}
                         </x-label>
                         <x-input type="password" name="password_confirmation"  />
                     </x-form-item>

                     <x-form-item>
                         <x-label>
                             {{ __('Ваш аватар:') }}
                         </x-label>
                         <x-input type="file" name="avatar" accept="image/png, image/jpeg, image/giv, image/png, image/webp" />
                     </x-form-item>



                     <x-form-item>
                         <x-login.checkbox-reg name="politic" value="1" id="politic">
                             {{ __('Я согласен на обработку моих персональных данных') }}
                         </x-login.checkbox-reg>
                     </x-form-item>
                     <x-button type="submit" {{--color="success" size="sm"--}}>{{ __('Зарегистрироваться') }}</x-button>
                 </x-form>

             </x-card-body>

</x-card>
