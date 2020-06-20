<?php

namespace Infinitypaul\MultiStep;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Infinitypaul\MultiStep\MultiStepSystem disk(string $name = null)
 * @method static mixed step(string $name, int $step)
 * @method static array store(array $data)
 * @method static void complete()
 * @method static array notCompleted()
 * @method static array data()
 *
 * @see \Infinitypaul\MultiStep\Controller\MultiStepManager
 */
class MultiStep extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-multistep-forms';
    }
}
