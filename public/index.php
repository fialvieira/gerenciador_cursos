<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\InterfaceControladorRequisicao;

$caminho = parse_url($_SERVER['REQUEST_URI']);
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho['path'], $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$ehRodaDeLogin = str_contains($caminho['path'], 'login');

if (!isset($_SESSION['logado']) && !$ehRodaDeLogin) {
    header('Location: /gerenciador_cursos/public/login');
    exit();
}

$classeControladora = $rotas[$caminho['path']];
/**
 * @var InterfaceControladorRequisicao $controlador
 */
$controlador = new $classeControladora();  // Se tiver uma string com o nome de uma classe em uma variável o PHP interpreta como ela
$controlador->processaRequisicao();