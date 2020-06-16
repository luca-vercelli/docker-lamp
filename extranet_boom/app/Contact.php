<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Get the client record associated with the Contact.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the budget record associated with the Contact.
     */
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }
}
