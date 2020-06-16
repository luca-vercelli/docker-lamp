<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * Get the client record associated with the brand.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the budget record associated with the brand.
     */
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }
}
