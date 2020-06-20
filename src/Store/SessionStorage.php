<?php

namespace Infinitypaul\MultiStep\Store;

use Illuminate\Http\Request;
use Infinitypaul\MultiStep\Store\Contracts\StepStorage;

/**
 * @method string completed()
 * @method string data()
 */
class SessionStorage implements StepStorage
{
    protected $request;

    /**
     * MultiStepSystem constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $key
     * @param $value
     */
    public function put($key, $value)
    {
        return $this->request->session()->put($key, $value);
    }

    public function get($key)
    {
        return $this->request->session()->get($key);
    }

    public function forget($key)
    {
        return $this->request->session()->forget($key);
    }
}
