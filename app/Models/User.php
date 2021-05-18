<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends BaseModel
{
    protected $table = 'user';

    protected $primaryKey = 'uid';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'uid');
    }
}
