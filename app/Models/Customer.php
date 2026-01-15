<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tenant;
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Project;

class Customer extends Model
{
    protected $fillable = ["tenant_id", "name", "email", "phone", "avatar"];

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

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
