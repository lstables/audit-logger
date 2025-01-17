<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->text('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};
