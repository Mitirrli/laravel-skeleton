<?php

namespace App\Traits;

use Illuminate\Support\Fluent;

/**
 * @property \Illuminate\Support\Fluent $extends
 */
trait HasExtendsProperty
{
    /**
     * @param array $extends
     */
    public function setExtendsAttribute($extends): void
    {
        $this->attributes['extends'] = \Safe\json_encode($extends);
    }

    /**
     * @return \Illuminate\Support\Fluent
     */
    public function getExtendsAttribute(): Fluent
    {
        return new Fluent($this->getExtends());
    }

    /**
     * @return array
     */
    public function getExtends(): array
    {
        return \Safe\array_replace_recursive(\defined('static::DEFAULT_EXTENDS') ? \constant('static::DEFAULT_EXTENDS') : [], \Safe\json_decode($this->attributes['extends'] ?? '{}', true) ?? []);
    }
}
