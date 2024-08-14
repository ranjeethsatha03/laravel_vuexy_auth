<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'state_name', 'state_code'];

    /**
     * Get the country that the state belongs to.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
