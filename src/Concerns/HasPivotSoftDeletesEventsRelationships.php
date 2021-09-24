<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Concerns;

use Fico7489\Laravel\Pivot\Traits\PivotEventTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PillarScience\LaravelPivotSoftdeletesEvents\Relations\BelongsToManySoftDeletesEvents;

trait HasPivotSoftDeletesEventsRelationships
{
    use PivotEventTrait;

    protected function newBelongsToMany(Builder $query, Model $parent, $table, $foreignPivotKey, $relatedPivotKey,
                                                $parentKey, $relatedKey, $relationName = null)
    {
        return new BelongsToManySoftDeletesEvents($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
    }
}
