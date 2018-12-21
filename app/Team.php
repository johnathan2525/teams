<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{

    protected $fillable = ['name',];

    /**
     * @return HasMany
     */
    public function players(): HasMany {
        return $this->hasMany(Player::class);
    }

}
