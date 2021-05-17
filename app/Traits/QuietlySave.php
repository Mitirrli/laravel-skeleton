<?php

namespace App\Traits;

trait QuietlySave
{
    /**
     * @param array $options
     *
     * @return mixed
     */
    public function saveQuietly(array $options = []): mixed
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }
}
