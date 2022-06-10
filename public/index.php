<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\Persistencia;

$caminho = parse_url($_SERVER['REQUEST_URI']);
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho['path'], $rotas)) {
    http_response_code(404);
    exit();
}

$classeControladora = $rotas[$caminho['path']];
/**
 * @var InterfaceControladorRequisicao $controlador
 */
$controlador = new $classeControladora();  // Se tiver uma string com o nome de uma classe em uma variável o PHP interpreta como ela
$controlador->processaRequisicao();