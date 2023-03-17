<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuickCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'slug',
        'linkedin_url',
        'github_url',
    ];
}
