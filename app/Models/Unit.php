<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Unit extends Model
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}