<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tenant;
use App\Models\Scopes\TenantScope;

class Customer extends Model
{
    protected $fillable = ["tenant_id", "name", "email", "phone"];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope());
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
