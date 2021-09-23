<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models;

use PillarScience\LaravelPivotSoftdeletesEvents\Concerns\HasPivotSoftDeletesEventsRelationships;

class User extends BaseModel
{
    use HasPivotSoftDeletesEventsRelationships;

    protected $table = 'users';

    protected $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)
            ->withPivot(['value']);
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class)
            ->withPivot(['value']);
    }
}
