<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $hidden = [];
    // protected $fillable = [];
    protected $guarded = [];



    public function getInvestmentDateAttribute($value) {
        return date('d-m-Y',strtotime($value));
    }


    public function investor() {
        return $this->belongsTo(Investor::class, 'investor_id','id');
    }


    public function manager() {    // manager
        return $this->belongsTo(User::class, 'manager_id','id');
    }

    
    public function plan() {
        return $this->belongsTo(Plan::class,'investment_plan_id','id');
    }
}
