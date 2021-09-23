<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models;

use PillarScience\LaravelPivotSoftdeletesEvents\Concerns\HasPivotSoftDeletesEventsRelationships;

class Tag extends BaseModel
{
    use HasPivotSoftDeletesEventsRelationships;

    protected $table = 'videos';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
