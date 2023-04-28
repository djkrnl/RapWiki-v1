<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapper extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function album()
	{
		return $this->belongsToMany(Album::class, 'album_rapper');
	}
    use HasFactory;
}
