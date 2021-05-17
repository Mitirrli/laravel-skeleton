<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Relations\Relation;

class Polymorphic implements Rule
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @param string      $name
     * @param string|null $message
     */
    public function __construct(string $name, string $message = null)
    {
        $this->name = $name;
        $this->message = $message;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $model = \request()->get(\Safe\sprintf('%s_type', $this->name));

        $model = Relation::getMorphedModel($model) ?? $model;

        return \class_exists($model) && (bool) \call_user_func([$model, 'find'], \request()->get(\Safe\sprintf('%s_id', $this->name)));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message ?: '未指定目标或目标不存在';
    }
}
