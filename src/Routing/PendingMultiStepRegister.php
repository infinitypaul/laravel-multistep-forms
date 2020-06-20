<?php

namespace Infinitypaul\MultiStep\Routing;

use Illuminate\Support\Facades\Route;
use Infinitypaul\MultiStep\Controller\MultiStepRedirectController;

class PendingMultiStepRegister
{
    protected $uri;
    protected $controller;
    protected $steps;
    protected $name;
    protected $only = [];
    protected $naming = [];

    /**
     * PendingMultiStepRegister constructor.
     *
     * @param $uri
     * @param $controller
     */
    public function __construct($uri, $controller)
    {
        $this->uri = $uri;
        $this->controller = $controller;
    }

    /**
     * @param $steps
     *
     * @return $this
     */
    public function steps($steps)
    {
        $this->steps = $steps;

        return $this;
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param $only
     *
     * @return $this
     */
    public function only($only)
    {
        $this->only = $only;

        return $this;
    }

    public function __destruct()
    {
        Route::get($this->uri, '\\'.MultiStepRedirectController::class);
        collect()->times($this->steps, function ($step) {
            foreach ($this->only as $namespace) {
                $this->naming[$namespace] = "{$this->name}.{$step}.{$namespace}";
            }
            Route::group([
                'prefix' => $this->uri,
            ], function () use ($step) {
               Route::resource($step, "{$this->controller}Step{$step}")
               ->only($this->only)
               ->names($this->naming);
           });
        });
    }
}
