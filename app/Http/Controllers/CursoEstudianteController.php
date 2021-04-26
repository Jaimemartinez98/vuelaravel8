<?php

namespace App\Http\Controllers;

use App\Models\Curso_estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursoEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('curso_estudiantes')
            ->join('cursos', 'curso_estudiantes.curso_id', '=', 'cursos.id')
            ->join('personas', 'curso_estudiantes.persona_id', '=', 'personas.id')
            ->select('curso_estudiantes.curso_id','curso_estudiantes.id','curso_estudiantes.persona_id', 'personas.nombre', 'personas.apellido','cursos.nombrecurso', 'cursos.intensidadhoraria')
            ->get();
        return $users;
       // return Curso_estudiante::get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curso_estudiante = new Curso_estudiante;
        $curso_estudiante->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso_estudiante  $curso_estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Curso_estudiante $curso_estudiante)
    {
       return $curso_estudiante;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso_estudiante  $curso_estudiante
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        
        
        $curso_estudiante = Curso_estudiante::find($id);
        $curso_estudiante->update($request->all());

        return response()->json('Dato Actualizado');
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso_estudiante  $curso_estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso_estudiante = Curso_estudiante::find($id);
        $curso_estudiante->delete();
        return response()->json('Curso Eliminado');
    }
}
