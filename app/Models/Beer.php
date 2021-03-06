<?php

namespace App\Models;

use App\Helpers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beer extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    public $incrementing = false;
    protected $hidden = ['deleted_at'];
}
