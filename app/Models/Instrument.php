<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'brand',
        'year_acquired',
        'purchase_price',
        'description',
        'condition',
        'is_favorite',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }



    /**
     * Get the available instrument types.
     */
    public static function getTypes()
    {
        return [
            'Acoustic Guitar',
            'Electric Guitar',
            'Bass Guitar',
            'Drums',
            'Piano',
            'Keyboard',
            'Synth',
            'Sax',
            'Trumpet',
            'Violin',
            'Cello',
            'Flute',
            'Clarinet',
            'Harmonica',
            'Ukulele',
            'Other'
        ];
    }

    /**
     * Get the available condition options.
     */
    public static function getConditions()
    {
        return [
            'Like New',
            'Great',
            'Good',
            'Fair',
            'Poor',
            'Needs Repair'
        ];
    }
}
