<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $timestamps = false;
	protected $fillable = ['name', 'image'];

	public function contact()
	{
		return $this->belongsTo(Contact::class);
	}
}
