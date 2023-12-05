<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alliance extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status_id',
        'rut',
        'name',
        'alias',
        'contact',
        'contact_email',
        'contact_phone',
        'start_date',
        'end_date'
    ];

    protected $dates = ['deleted_at'];
}
