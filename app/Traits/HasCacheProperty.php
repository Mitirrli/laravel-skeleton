<?php

namespace App\Traits;

use Illuminate\Support\Fluent;

/**
 * @property \Illuminate\Support\Fluent $cache
 */
trait HasCacheProperty
{
    /**
     * @param array $cache
     */
    public function setCacheAttribute($cache): void
    {
        $this->attributes['cache'] = \Safe\json_encode($cache);
    }

    /**
     * @return \Illuminate\Support\Fluent
     */
    public function getCacheAttribute(): Fluent
    {
        return new Fluent($this->getCache());
    }

    /**
     * @return array
     */
    public function getCache(): array
    {
        return \Safe\array_replace_recursive(\defined('static::DEFAULT_CACHE') ? \constant('static::DEFAULT_CACHE') : [], \Safe\json_decode($this->attributes['cache'] ?? '{}', true) ?? []);
    }
}
