<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Course\CourseRepository;
use App\Repositories\Semester\SemesterRepository;
use App\Repositories\Semester\SemesterRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\TimeTable\TimeTableRepository;
use App\Repositories\TimeTable\TimeTableRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Notify\NotifyRepository;
use App\Repositories\Notify\NotifyRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(SemesterRepositoryInterface::class, SemesterRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TimeTableRepositoryInterface::class, TimeTableRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(NotifyRepositoryInterface::class, NotifyRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
