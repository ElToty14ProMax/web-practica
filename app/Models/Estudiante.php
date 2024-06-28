<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{

    protected $fillable = [
        'identidad',
        'nombre',
        'apellidos',
        'provincia',
        'municipio',
        'situacion_academica',
        'estado',
        'direccion',
        'fecha_de_nacimiento',
        'grupo', 'carrera',
        'facultad_filial',
        'tipo_de_curso',
        'correo_electronico',
        'fuente_de_ingreso',
        'origen_academico',
        'regimen_de_estudio',
        'natural_de', 'telefono',
        'fecha_de_ingreso_a_la_es',
        'estado_civil',
        'organizacion_politica',
        'fecha_de_ingreso_al_ces',
        'fecha_de_matricula',
        'sexo',
        'color_de_la_piel',
        'tipo_de_estudiante', 'anno_de_estudio',
        'centro_de_trabajo', 'nombre_del_padre',
        'nivel_academico_del_padre',
        'nombre_de_la_madre',
        'nivel_academico_de_la_madre',
        'tipo_de_servicio_militar',
        'edad'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
}
