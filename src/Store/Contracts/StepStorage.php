<?php

namespace Infinitypaul\MultiStep\Store\Contracts;

/**
 * Interface StepStorage.
 */
interface StepStorage
{
    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function put($key, $value);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function forget($key);
}
