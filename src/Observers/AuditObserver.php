<?php

namespace infinety\AuditLogger\Observers;

use Illuminate\Database\Eloquent\Model;
use infinety\AuditLogger\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditObserver
{
    public function created(Model $model)
    {
        $this->logChanges($model, [], $model->getAttributes());
    }

    public function updated(Model $model)
    {
        $oldValues = $model->getOriginal();
        $newValues = $model->getDirty();

        $this->logChanges($model, $oldValues, $newValues);
    }

    public function deleted(Model $model)
    {
        $this->logChanges($model, $model->getOriginal(), []);
    }

    protected function logChanges(Model $model, array $oldValues, array $newValues)
    {
        // Optionally redact sensitive fields
        $sensitiveFields = config('audit.sensitive_fields', []);
        foreach ($sensitiveFields as $field) {
            if (array_key_exists($field, $oldValues)) {
                $oldValues[$field] = '[REDACTED]';
            }
            if (array_key_exists($field, $newValues)) {
                $newValues[$field] = '[REDACTED]';
            }
        }

        AuditLog::create([
            'model_type' => get_class($model),
            'model_id'   => $model->getKey(),
            'changed_by' => Auth::id() ?: null,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'metadata'   => [
                'ip'        => request()->ip(),
                'userAgent' => request()->userAgent(),
            ],
        ]);
    }
}
