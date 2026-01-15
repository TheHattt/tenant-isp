<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ["customer_id", "file_type", "file_path"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
