<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Customer;

class Project extends Model
{
    protected $casts = [
        "created_at" => "date",
        "updated_at" => "date",
        "start_date" => "date",
        "end_date" => "date",
    ];

    protected $fillable = [
        "tenant_id",
        "customer_id",
        "name",
        "description",
        "status",
        "priority",
        "budget",
        "assigned_to",
        "created_by",
        "updated_by",
        "start_date",
        "end_date",
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
