<?php

namespace App\Ship\Providers;

use Illuminate\Http\Request;
use App\Ship\Services\Helpers;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Ship\Services\Transliteration\{Transliteration, LatinToCyrillic, CyrillicToLatin};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'helpers_service',
            function () {
                $request = app(Request::class);
                return new Helpers($request);
            }
        );
        $this->app->bind(
            'transliteration',
            static function() {
                return new Transliteration(new LatinToCyrillic(), new CyrillicToLatin());
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.secure_connection') === true) {
            $this->app->get('request')->server->set('HTTPS', true);
        }
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        Carbon::setLocale('ru');
    }
}
