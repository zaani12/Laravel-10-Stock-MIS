<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable=[
        'fullName',
        'phone',
        'email',
        'address',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'supplier_id'); // Assuming 'supplier_id' is the foreign key in the Invoice model
    }
}
