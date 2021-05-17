<?php

namespace App\Traits;

trait QuietlyUpdate
{
    /**
     * @param array $update
     * @param array $options
     *
     * @return mixed
     */
    public function updateQuietly(array $update, array $options = []): mixed
    {
        return static::withoutEvents(function () use ($options) {
            return $this->update($options, $options);
        });
    }
}
