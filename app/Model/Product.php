<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'category_id',
        'created_by',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function category(){
        return $this->hasOne('App\Model\Category', 'id', 'category_id');
    }

    public function creator(){
        return $this->hasOne('App\Model\User', 'id', 'created_by');
    }
}
