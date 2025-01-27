<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coach extends Model
{
    use HasFactory;

    protected $table = 'coaches';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'years_of_experience', 'hourly_rate', 'city', 'country', 'start_date'];

    protected $keyType = 'string';

    public $incrementing = false;

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
