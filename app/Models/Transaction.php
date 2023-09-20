<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $hidden = [];
    protected $guarded = [];
    // protected $fillable = [];
    
    protected $casts = [
        'payout_date' => 'date:d-m-Y',
    ];

    protected function getPayoutDateAttribute($value)
    {
        return date('d-m-Y',strtotime($value));
    }

    public function investment() {
        return $this->belongsTo(Investment::class, 'investment_id','id');
    }
    
}
