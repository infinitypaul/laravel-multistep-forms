<?php

namespace Infinitypaul\MultiStep\Models;

use Illuminate\Database\Eloquent\Model;
use Infinitypaul\MultiStep\Controller\Keys;

class Step extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('steps.table_names'));
    }

    protected static function booted()
    {
        static::creating(function ($step) {
            self::getHashedKeys();
            $step->slug = session()->get('step_key');
        });
    }

    protected static function getHashedKeys(){
        $key = Keys::getHashedToken();
        while (self::where('slug', $key)->exists()) {
            $key = Keys::getHashedToken();
        }
        session(['step_key' => $key]);
    }
}
