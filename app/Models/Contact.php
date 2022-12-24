<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender_id',
        'email',
        'postal',
        'address',
        'building_name',
        'content'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name} ";
    }

    public function Gender(){
        return $this->hasMany('App\models\Gender');
    }
}
