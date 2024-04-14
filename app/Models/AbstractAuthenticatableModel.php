<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AbstractAuthenticatableModel extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
}
