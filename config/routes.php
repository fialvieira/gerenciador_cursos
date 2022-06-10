<?php

use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;

return [
    '/gerenciador_cursos/public/listar-cursos' => ListarCursos::class,
    '/gerenciador_cursos/public/novo-curso' => FormularioInsercao::class,
    '/gerenciador_cursos/public/salvar-curso' => Persistencia::class
];