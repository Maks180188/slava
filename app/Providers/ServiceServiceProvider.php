<?php

namespace App\Providers;

use App\Interfaces\ParseFileInterface;
use App\Interfaces\RowRepositoryInterface;
use App\Providers\Helpers\RegistrationHelper;
use App\Repositories\RowRepository;
use App\Services\ParseFileService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    use RegistrationHelper;

    private array $bindServices = [
        ParseFileInterface::class => ParseFileService::class,
        RowRepositoryInterface::class => RowRepository::class,
    ];
}
