<?php

namespace App\Traits;

use Illuminate\Support\Fluent;

/**
 * @property \Illuminate\Support\Fluent $settings
 */
trait HasSettingsProperty
{
    /**
     * @param array $settings
     */
    public function setSettingsAttribute($settings): void
    {
        $this->attributes['settings'] = \Safe\json_encode($settings);
    }

    /**
     * @return \Illuminate\Support\Fluent
     */
    public function getSettingsAttribute(): Fluent
    {
        return new Fluent($this->getSettings());
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return \Safe\array_replace_recursive(\defined('static::DEFAULT_SETTINGS') ? \constant('static::DEFAULT_SETTINGS') : [], \Safe\json_decode($this->attributes['settings'] ?? '{}', true) ?? []);
    }
}
