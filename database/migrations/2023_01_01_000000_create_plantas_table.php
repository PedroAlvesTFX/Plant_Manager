<?php
Schema::create('plantas', function (Blueprint $table) {
    $table->id();
    $table->string('nome_popular');
    $table->string('nome_cientifico');
    $table->boolean('e_apicola')->default(false);
    $table->boolean('e_panc')->default(false);
    $table->boolean('e_forrageira')->default(false);
    $table->string('cor_fruto')->nullable();
    $table->string('cor_flor')->nullable();
    $table->string('cor_folha')->nullable();
    $table->timestamps();
    $table->timestamp('data')->nullable();
});
