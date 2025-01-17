<?php

namespace infinety\AuditLogger\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use infinety\AuditLogger\Models\AuditLog;

class Replayer
{
    /**
     * Rewind a model to a specific timestamp
     */
    public function rewind(Model $model, Carbon $toTime)
    {
        $logs = AuditLog::where('model_type', get_class($model))
            ->where('model_id', $model->getKey())
            ->where('created_at', '>', $toTime)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($logs as $log) {
            $oldValues = $log->old_values ?? [];
            $newValues = $log->new_values ?? [];

            // If it was an update
            if (!empty($oldValues) && !empty($newValues)) {
                $model->forceFill($oldValues)->save();
            }
            // If it was a delete
            elseif (!empty($oldValues) && empty($newValues)) {
                $model->forceFill($oldValues)->save();
            }
            // If it was a create
            elseif (empty($oldValues) && !empty($newValues)) {
                $model->delete();
            }
        }
    }
}
