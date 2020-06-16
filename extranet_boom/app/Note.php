<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	/**
	 * Get the budget record associated with the bill.
	 */
	public function bill()
	{
			return $this->belongsTo('App\Bill');
	}
}
