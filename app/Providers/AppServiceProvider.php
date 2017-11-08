<?php

namespace App\Providers;

use App\Anime;
use App\Article;
use App\Movie;
use App\Picture;
use App\Tv;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Relation::morphMap([
            'anime' => Anime::class,
            'movie' => Movie::class,
            'tv' => Tv::class,
            'picture' => Picture::class,
            'article' => Article::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
