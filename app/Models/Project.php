<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Document;
use App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        "tenant_id",
        "customer_id",
        "name",
        "description",
        "status",
        "priority",
        "assigned_to",
        "created_by",
        "updated_by",
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
