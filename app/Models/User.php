<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';

    protected $primaryKey = 'uid';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'uid');
    }
}
