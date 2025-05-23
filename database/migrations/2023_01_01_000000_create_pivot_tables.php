<?php

Schema::create('planta_classificacao', function (Blueprint $table) {
    $table->foreignId('planta_id')->constrained('plantas')->onDelete('cascade');
    $table->foreignId('classificacao_id')->constrained('classificacao')->onDelete('cascade');
    $table->primary(['planta_id', 'classificacao_id']);
});
