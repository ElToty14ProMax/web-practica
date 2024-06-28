<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('identidad');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('situacion_academica');
            $table->string('estado');
            $table->string('direccion');
            $table->string('fecha_de_nacimiento');
            $table->string('grupo');
            $table->string('carrera');
            $table->string('facultad_filial');
            $table->string('tipo_de_curso');
            $table->string('correo_electronico');
            $table->string('fuente_de_ingreso');
            $table->string('origen_academico');
            $table->string('regimen_de_estudio');
            $table->string('natural_de');
            $table->string('telefono');
            $table->string('fecha_de_ingreso_a_la_es');
            $table->string('estado_civil');
            $table->string('organizacion_politica');
            $table->string('fecha_de_ingreso_al_ces');
            $table->string('fecha_de_matricula');
            $table->string('sexo');
            $table->string('color_de_la_piel');
            $table->string('tipo_de_estudiante');
            $table->string('anno_de_estudio');
            $table->string('centro_de_trabajo');
            $table->string('nombre_del_padre');
            $table->string('nivel_academico_del_padre');
            $table->string('nombre_de_la_madre');
            $table->string('nivel_academico_de_la_madre');
            $table->string('tipo_de_servicio_militar');
            $table->string('edad');
            $table->timestamps();
        });
    }
};
