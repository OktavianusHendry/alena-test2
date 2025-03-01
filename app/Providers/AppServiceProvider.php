<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->view('auth.verify-custom', [
                    'user' => $notifiable, // Removed quotes
                    'url'  => $url,       // Removed quotes
                ]);
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->view('auth.reset-password-custom', [
                    'user' => $notifiable,
                    'url'  => $url,
                ]);
        });

        // Menambahkan unread notifications ke semua view
        View::composer('*', function ($view) {
            $unreadCount = auth()->check() ? auth()->user()->unreadNotifications->count() : 0;
            $view->with('unreadCount', $unreadCount);
        });
    }
}
