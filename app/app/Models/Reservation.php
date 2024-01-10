<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'user_id',
        'category_id',
        'start_reservation_date',
        'end_reservation_date',
        'confirm_reservation',
        'canceled',
        'confirm_rental',
        'confirm_return'
    ];

    protected $casts = [
        'canceled' => 'boolean',
        'confirm_rental' => 'boolean',
        'confirm_return' => 'boolean',
        'confirm_reservation' => 'boolean',
        'start_reservation_date' => 'date:d/m/Y H:i:s',
        'end_reservation_date' => 'date:d/m/Y H:i:s',
    ];

    protected $with = [
        'user',
        'category'
    ];



    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

//    public function cars(): BelongsToMany
//    {
//        return $this->belongsToMany(Car::class);
//    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
