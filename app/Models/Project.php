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
        "customer_id",
        "name",
        "description",
        "status",
        "priority",
        "budget",
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
