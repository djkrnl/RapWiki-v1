<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function rapper()
	{
		return $this->belongsToMany(Rapper::class, 'album_rapper');
	}
	public function track()
    {
        return $this->hasMany(AlbumTrack::class);
    }
    use HasFactory;
}
