<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Relations;

use DDZobov\PivotSoftDeletes\Relations\BelongsToManySoft;
use Fico7489\Laravel\Pivot\Traits\FiresPivotEventsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BelongsToManySoftDeletesEvents extends BelongsToManySoft
{
    use FiresPivotEventsTrait;

    protected function newBelongsToMany(Builder $query, Model $parent, $table, $foreignPivotKey, $relatedPivotKey,
                                                $parentKey, $relatedKey, $relationName = null)
    {
        return new BelongsToManySoftDeletesEvents($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
    }
}
