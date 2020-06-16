<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Get the brand record associated with the client.
     */
     public function brand()
     {
       return $this->hasMany('App\Brand');
     }

     /**
      * Get the contact record associated with the client.
      */
      public function contact()
      {
        return $this->hasMany('App\Contact');
      }

      /**
       * Get the budget record associated with the client.
       */
       public function budget()
       {
         return $this->hasMany('App\Budget');
       }
}
