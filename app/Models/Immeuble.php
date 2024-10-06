<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    use HasFactory;
    protected $table = 'immeubles';

    protected $fillable = ['name', 'address', 'price', 'description', 'picture', 'rooms', 'toilets', 'air_conditioning', 'heating', 'ville']; // Ajoutez 'ville' ici

    protected $casts = [
        'air_conditioning' => 'boolean',
        'heating' => 'boolean',
    ];


    public function reservations()
{
    return $this->hasMany(Reservation::class);
}
}
