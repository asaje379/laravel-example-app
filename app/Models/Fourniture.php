<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fourniture extends Model
{
    use HasFactory;


    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class);
    }
}
