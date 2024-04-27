<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    /**
     * Muestra la página de inicio de la prueba.
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $aplicante = [
            'puntos' => 0,
            'nivel' => 1,
            'nombre' => 'Nicolás Llanos',
            'aprobado' => false
        ];
        while ($aplicante['nivel'] < 20) {
            $aplicante = $this->entrenar($aplicante);
        }
        $aplicante['aprobado'] = $this->evaluar($aplicante);

        return view('prueba', compact('aplicante'));
    }

    /**
     * Entrena al aplicante para subir de nivel
     * @param array $aplicante
     * @return array
     */
    private function entrenar($aplicante)
    {
        $aplicante['puntos'] += 10 / $aplicante['nivel'];
        if ($aplicante['puntos'] >= 100) {
            $aplicante['nivel']++;
            $aplicante['puntos'] = 0;
        }
        return $aplicante;
    }

    /**
     * Valida el nivel del aplicante para saber si aprobo o no, el nivel de aprovacion es 10
     * @param array $aplicante
     * @return bool
     */
    private function evaluar(array $aplicante)
    {
        return $aplicante['nivel'] >= 20;
    }
}
