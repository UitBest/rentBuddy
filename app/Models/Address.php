<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Extra traits for the model.
     */
    use HasFactory;

    /**
     * The attributes that are assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'street',
        'postal_code',
        'city_id',
    ];

    /**
     * The attributes that should be searchable.
     *
     * @var array<string>
     */
    protected array $searchable = [
        'id',
        'name',
        'orders.order_number',
    ];

    /**
     * Get the city that owns the address.
     */
    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
