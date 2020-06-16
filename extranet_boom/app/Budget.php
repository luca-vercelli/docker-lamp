<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    /**
     * Get the client record associated with the budget.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the brand record associated with the budget.
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    /**
     * Get the brand record associated with the budget.
     */
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
