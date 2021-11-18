<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Url extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['destination', 'slug'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getShortenedUrlAttribute()
    {
        return env('APP_URL') . "/{$this->slug}";
    }

    public static function store(Request $request)
    {

        return Url::create([
            'destination' => $request->destination,
            'slug' => Str::random(5)
        ]);
    }

    public static function getAll()
    {
        return Url::get();
    }
}
