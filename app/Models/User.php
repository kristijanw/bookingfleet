<?php

namespace App\Models;

use DirectoryTree\Authorization\Traits\Authorizable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;
    use Authorizable;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /** @var array<int,string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function excursion(): HasMany
    {
        return $this->hasMany(Excursion::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
