<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\Persistencia;

switch ($_SERVER['REQUEST_URI']) {
    case '/gerenciador_cursos/public/listar-cursos':
        $controlador = new ListarCursos();
        $controlador->processaRequisicao('Listar cursos');
        break;
    case '/gerenciador_cursos/public/novo-curso':
        $controlador = new FormularioInsercao();
        $controlador->processaRequisicao('Novo curso');
        break;
    case '/gerenciador_cursos/public/salvar-curso':
        $controlador = new Persistencia();
        $controlador->processaRequisicao();
        break;
    default:
        echo "Erro 404";
}