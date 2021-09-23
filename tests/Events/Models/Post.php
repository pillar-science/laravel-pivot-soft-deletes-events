<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models;

use PillarScience\LaravelPivotSoftdeletesEvents\Concerns\HasPivotSoftDeletesEventsRelationships;

class Post extends BaseModel
{
    use HasPivotSoftDeletesEventsRelationships;

    protected $table = 'posts';

    protected $fillable = ['name'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
