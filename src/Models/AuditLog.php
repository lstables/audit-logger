<?php

namespace infinety\AuditLogger\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_logs';

    protected $guarded = [];

    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json',
        'metadata'   => 'json',
    ];
}
