<?php

namespace Infinitypaul\MultiStep\Store;

use Illuminate\Support\Arr;
use Infinitypaul\MultiStep\Models\Step;
use Infinitypaul\MultiStep\Store\Contracts\StepStorage;

/**
 * @method string completed()
 */
class DatabaseStorage implements StepStorage
{
    protected $step;

    public function __construct()
    {
        $this->step = new Step();
    }

    /**
     * {@inheritdoc}
     */
    public function put($key, $value)
    {
        $me = [];

        if (! is_array($key)) {
            $key = [$key => $value];
        }

        foreach ($key as $arrayKey => $arrayValue) {
            Arr::set($me, $arrayKey, $arrayValue);
        }

        var_dump($me);

//        $this->step->data = json_encode($me);
//        $this->step->save();

//        $this->step->updateOrCreate(
//            ['slug' => session()->get('step_key')],
//            ['data' => json_encode($me), 'key' => $key]
//        );

        //dd(Arr::get($me, $key));
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $keys = explode('.', $key);
        $data = $this->step->where('slug', session()->get('step_key'))->first();

        return $data->data[end($keys)] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function forget($key)
    {
        if ($this->step->where('key', $key)->delete()) {
            session()->forget('step_key');
        }
    }
}
