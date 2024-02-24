<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Подтверждение Email')
                ->line('Нажмите для подтверждения')
                ->action('Подтвердить', $url);
        });
        View::share('dates', date("Y-m-d",strtotime("2023-11-08")));
        View::share('links', Page::select(['id','name','url'])->where('active',1)->get());
    }
}
