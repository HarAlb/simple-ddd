<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

{your_domain}/docs - Here we present requests documentation

## About Project

Project is simple api with DDD architecture.

What we have and why?

[X]Service - is a final class, write here business logic, can use repository but not model.
In this project we will be use DTO-s for save connection with controller.
If the developer knows what is Single Responsibility,we won't get GOD object.

!IMPORTANT all SERVICES will be implemented from App\Api\Base\Contracts\InternalServiceContract interface.

[X]Repository - is a single file who can call model, To abandon models in the future and write clean SQL queries

[X]DTO - we use for disable using Request in service, and really know what need service from request.

[X]Controller - we use as [adapter](https://refactoring.guru/design-patterns/adapter)
The class will create DTO-s that needs service, also catch exceptions from service, and modify as a response.

In the App\Api\Base repository we create classes for disabled duplication and here are files that can be used for V2.
