<?php

namespace Infinitypaul\MultiStep\Controller;

use Infinitypaul\MultiStep\MultiStepSystem;
use Infinitypaul\MultiStep\Store\Contracts\StepStorage;
use Infinitypaul\MultiStep\Store\DatabaseStorage;
use Infinitypaul\MultiStep\Store\JsonOutput;
use Infinitypaul\MultiStep\Store\SessionStorage;
use InvalidArgumentException;

class MultiStepManager
{
    protected $app;

    /**
     * The array of resolved filesystem drivers.
     *
     * @var array
     */
    protected $disks = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function disk($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->disks[$name] = $this->get($name);
    }

    protected function get($name)
    {
        return $this->disks[$name] ?? $this->resolve($name);
    }

    protected function resolve($name)
    {
        $config = $this->getConfig();
        if (is_null($config)) {
            throw new InvalidArgumentException("Disk [{$name}] does not have a configured driver.");
        }

        $driverMethod = 'create'.ucfirst($name).'Driver';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        } else {
            throw new InvalidArgumentException("Driver [{$name}] is not supported.");
        }
    }

    protected function getConfig()
    {
        return $this->getDefaultDriver() ?: null;
    }

    protected function createSessionDriver($config)
    {
        return $this->createStepSystem(new SessionStorage(request()));
    }

    protected function createDatabaseDriver($config)
    {
        return $this->createStepSystem(new DatabaseStorage);
    }

    protected function createJsonDriver()
    {
        return $this->createStepSystem(new JsonOutput);
    }

    protected function createStepSystem(StepStorage $stepStorage)
    {
        return new MultiStepSystem($stepStorage);
    }

    /**
     * Get the default file driver.
     *
     * @return string
     */
    protected function getDefaultDriver()
    {
        return $this->app['config']['steps.default'];
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->disk()->$method(...$parameters);
    }
}
