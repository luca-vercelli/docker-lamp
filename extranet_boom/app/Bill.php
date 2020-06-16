<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /**
     * Get the client record associated with the budget.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the budget record associated with the bill.
     */
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }
}
