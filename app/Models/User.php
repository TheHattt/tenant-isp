<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Tenant;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = ["name", "email", "password", "tenant_id"];
    protected $hidden = ["password", "remember_token"];

    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    protected static function booted()
    {
        // add filters that apply to all queries
        // automatically apply the tenant scope to all queries
        static::addGlobalScope("tenant", function (Builder $builder) {
            // Safely check if the application is running in the console
            if (app()->runningInConsole()) {
                return;
            }

            // get the authenticated service
            $auth = app("auth");
            // check if there is a logged in user
            if ($auth->hasUser() && ($user = $auth->user())) {
                // check if tenant_id === to the logged in user's tenant_id
                if ($tenantId = $user->tenant_id) {
                    // filter for a specific tenant : belongs to company A not B -> use tenant_id
                    $builder->where("tenant_id", $tenantId);
                }
            }
        });
    }
}
