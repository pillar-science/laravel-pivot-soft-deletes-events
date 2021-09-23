<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models;

use PillarScience\LaravelPivotSoftdeletesEvents\Concerns\HasPivotSoftDeletesEventsRelationships;

class Seller extends BaseModel
{
    use HasPivotSoftDeletesEventsRelationships;

    public $incrementing = false;

    protected $table = 'sellers';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['value']);
    }
}
