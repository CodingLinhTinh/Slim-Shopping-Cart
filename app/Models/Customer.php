<?php
namespace Cart\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
      'email',
      'name'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}