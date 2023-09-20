<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    // protected $visible = [
    //     'first_name',
    //     'last_name',
    //     'email',
    //     'phone'
    // ];
    protected $hidden = [];
    // protected $fillable = [];
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class,'manager');
    }


}
