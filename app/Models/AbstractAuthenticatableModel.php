<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AbstractAuthenticatableModel extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
}