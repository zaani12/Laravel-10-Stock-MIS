<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_number', 'invoice_date', 'supplier_id', 'amount'];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id'); // Assuming 'supplier_id' is the foreign key
    }
}
