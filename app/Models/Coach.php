<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
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

    public function scopeSearchText($query, $text): Builder
    {
        if (! $text) {
            return $query;
        }

        return $query->where(function ($query) use ($text) {
            $query->where('name', 'like', "%$text%")
                ->orWhere('country', 'like', "%$text%")
                ->orWhere('city', 'like', "%$text%");
        });
    }

    public function scopeFilterByName($query, $name): Builder
    {
        if (! $name) {
            return $query;
        }

        return $query->where('name', 'like', "%$name%");
    }

    public function scopeFilterByLocation($query, $location): Builder
    {
        if (! $location) {
            return $query;
        }

        return $query->where('location', 'like', "%$location%");
    }

    public function scopeSort($query, $sortBy, $order): Builder|JsonResponse
    {
        if (! $sortBy || ! $order) {
            return $query;
        }
        $allowedSortBy = ['name', 'hourly_rate'];

        if (! in_array($sortBy, $allowedSortBy)) {
            return response()->json(['error' => 'Invalid sort_by value. Allowed: name, hourly_rate.'], 400);
        }

        if (! in_array($order, ['asc', 'desc'])) {
            return response()->json(['error' => 'Invalid sort value. Use "asc" or "desc".'], 400);
        }

        return $query->orderBy($sortBy, $order);
    }
}
