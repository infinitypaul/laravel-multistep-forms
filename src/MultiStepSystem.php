<?php

namespace Infinitypaul\MultiStep;

use Illuminate\Http\Request;
use Infinitypaul\MultiStep\Store\Contracts\StepStorage;
use Infinitypaul\MultiStep\Store\JsonOutput;
use Infinitypaul\MultiStep\Store\SessionStorage;


class MultiStepSystem
{

    protected $step;
    protected $name;
    protected $storage;

    /**
     * MultiStepSystem constructor.
     *
     * @param \Infinitypaul\MultiStep\Store\Contracts\StepStorage $storage
     */
    public function __construct(StepStorage $storage)
    {
        $this->storage = $storage;
    }

    protected function key(){
        return "multistep.{$this->name}";
    }

    /**
     * @param $name
     * @param $step
     *
     * @return \Infinitypaul\MultiStep\MultiStepSystem
     */
    public function step($name, $step){
        $this->step = $step;
        $this->name = $name;

        return $this;
    }


    public function store($data){
        $this->storage->put($this->key().".{$this->step}.data", $data);
        return $this;
    }

    public function complete(){
        $this->storage->put($this->key().".{$this->step}.complete", true);
        return $this;
    }

    public function notCompleted(...$steps){
        foreach ($steps as $step){
            if(!$this->storage->get($this->key().".{$step}.complete")){
                return true;
            }
        }

        return false;
    }

    public function data(){
         $products = collect($this->storage->get($this->key()))->pluck('data');

         return $products->flatMap(function ($values) {
             return $values;
         });
    }


    public function clearAll(){
        $this->storage->forget($this->key());

        return $this;
    }

    public function __get($property)
    {
       return $this->storage->get($this->key().".{$this->step}.data.{$property}");
    }


}
