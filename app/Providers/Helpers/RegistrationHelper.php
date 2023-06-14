<?php
declare(strict_types=1);

namespace App\Providers\Helpers;

trait RegistrationHelper
{
    /**
     *  Bind repositories example
     *
     *  private array $this->bindRepositories = [
     *      RepositoryContract::class => [
     *          'concrete' => Repository::class,
     *          'model' => Model::class,
     *      ],
     *  ];
     *
     *  Bind services example
     *
     *  private array $this->bindServices = [
     *      ServiceContract::class => Service::class,
     *  ];
     */

    public function __construct($app)
    {
        parent::__construct($app);

        if (empty($this->bindRepositories)) {
            $this->bindRepositories = [];
        }
        if (empty($this->bindServices)) {
            $this->bindServices = [];
        }
    }

    public function register(): void
    {
        collect($this->bindRepositories)->each(function ($bind, string $contract) {
            $this->app->bind($contract, function () use ($bind) {
                if (is_string($bind)) {
                    return new $bind;
                }

                return new $bind['concrete']($bind['model']::getModel());
            });
        });

        collect($this->bindServices)->each(function (string $concrete, string $contract) {
            $this->app->bind($contract, $concrete);
        });
    }

    public function provides(): array
    {
        return array_keys([
            ...$this->bindRepositories,
            ...$this->bindServices,
        ]);
    }
}
