<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $hidden = [];
    protected $guarded = [];

    // protected $fillable = [
    //     'name',
    //     'details',
    //     'payment_percent',
    //     'first_payment_duration',
    //     'other_payment_duration',
    //     'total_emi',
    //     'manager ',
    // ];

    public function user() {
        return $this->belongsTo(User::class, 'manager');
    }

}

