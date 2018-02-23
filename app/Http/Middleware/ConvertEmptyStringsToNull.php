<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest as Middleware;

class ConvertEmptyStringsToNull extends Middleware
{
    /**
     * The attributes that should not be converted.
     *
     * @var array
     */
    protected $except = [
        'pronoun:othertext',
        'arrat:othertext',
        'depat:othertext',
    ];

    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (in_array($key, $this->except, true)) {
            return $value;
        }

        return is_string($value) && $value === '' ? null : $value;
    }
}
