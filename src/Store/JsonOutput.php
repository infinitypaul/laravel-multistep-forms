<?php


namespace Infinitypaul\MultiStep\Store;


use Infinitypaul\MultiStep\Store\Contracts\StepStorage;

class JsonOutput implements StepStorage
{

    public function put($key, $value)
    {
        return response()->json([
            'key' => $key,
            'value' => $value
        ]);
    }

    public function get($key)
    {
        return response()->json([
            'key' => $key
        ]);
    }

    public function forget($key)
    {
        return response()->json([
            'key' => $key
        ]);
    }
}
