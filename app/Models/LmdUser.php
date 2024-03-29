<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LmdUser extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'lmd_users';
    protected $guarded = [];
}
