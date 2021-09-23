<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models;

use PillarScience\LaravelPivotSoftdeletesEvents\Concerns\HasPivotSoftDeletesEventsRelationships;

class Video extends BaseModel
{
    use HasPivotSoftDeletesEventsRelationships;

    protected $table = 'videos';

    protected $fillable = ['name'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
