<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Report extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'property_id',
        'name',
        'cost',
        'description',
        'status',
        'date',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
