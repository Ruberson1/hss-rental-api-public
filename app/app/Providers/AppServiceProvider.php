<?php

namespace App\Providers;

use App\Http\Interfaces\Repositories\Auth\IDeletedUserRepository;
use App\Http\Interfaces\Repositories\Auth\IRegisterUserRepository;
use App\Http\Interfaces\Repositories\Car\ICarRepository;
use App\Http\Interfaces\Repositories\Category\ICategoryRepository;
use App\Http\Interfaces\Repositories\Reservation\IReservationRepository;
use App\Http\Interfaces\Services\Auth\IAuthenticatedSessionService;
use App\Http\Interfaces\Services\Auth\IAuthService;
use App\Http\Interfaces\Services\Auth\IDeletedUserService;
use App\Http\Interfaces\Services\Auth\INewPasswordService;
use App\Http\Interfaces\Services\Auth\IPasswordResetLinkService;
use App\Http\Interfaces\Services\Auth\IRegisterUserService;
use App\Http\Interfaces\Services\Car\ICarService;
use App\Http\Interfaces\Services\Category\ICategoryService;
use App\Http\Interfaces\Services\Email\ISendEmailService;
use App\Http\Interfaces\Services\Notification\IPushNotificationService;
use App\Http\Interfaces\Services\Reservation\IReservationService;
use App\Http\Repositories\Auth\DeletedUserRepository;
use App\Http\Repositories\Auth\RegisterUserRepository;
use App\Http\Repositories\Car\CarRepository;
use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\Reservation\ReservationRepository;
use App\Http\Services\Auth\AuthenticatedSessionService;
use App\Http\Services\Auth\AuthService;
use App\Http\Services\Auth\DeletedUserService;
use App\Http\Services\Auth\NewPasswordService;
use App\Http\Services\Auth\PasswordResetLinkService;
use App\Http\Services\Auth\RegisterUserService;
use App\Http\Services\Car\CarService;
use App\Http\Services\Category\CategoryService;
use App\Http\Services\Email\SendEmailService;
use App\Http\Services\Notification\PushNotificationService;
use App\Http\Services\Reservation\ReservationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Auth Services
        $this->app->bind(IAuthService::class, AuthService::class);


        ##########################################################################################################
        ##                                                 CAR                                                  ##
        ##########################################################################################################

        //Car Services
        $this->app->bind(ICarService::class, CarService::class);

        //Car Repositories
        $this->app->bind(ICarRepository::class, CarRepository::class);

        ##########################################################################################################
        ##                                                 RESERVATION                                          ##
        ##########################################################################################################

        //Car Services
        $this->app->bind(IReservationService::class, ReservationService::class);

        //Car Repositories
        $this->app->bind(IReservationRepository::class, ReservationRepository::class);

        //Email Service
        $this->app->bind(ISendEmailService::class, SendEmailService::class);

        //PushNotification Service
        $this->app->bind(IPushNotificationService::class, PushNotificationService::class);

        //Category Service
        $this->app->bind(ICategoryService::class, CategoryService::class);
        //Category Repository
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
