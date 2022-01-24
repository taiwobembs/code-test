<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProducts extends Model {
    protected $table = 'users_products';

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'created_at',
        'updated_at'
    ];

}