<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\EloquentBookRepository;

class RepositoriesServiceProvider extends ServiceProvider
{

    /**
     * Все синглтоны контейнера, которые должны быть зарегистрированы.
     *
     * @var array
     */
    public $singletons = [
        BookRepository::class => EloquentBookRepository::class,
        CategoryRepository::class => EloquentCategoryRepository::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
