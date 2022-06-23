<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

$caminho = parse_url($_SERVER['REQUEST_URI']);
$rotas = require __DIR__ . '/../config/routes.php';
/**
 * @var ContainerInterface $container
 */
$container = require __DIR__ . '/../config/dependencies.php';

if (!array_key_exists($caminho['path'], $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$ehRotaDeLogin = str_contains($caminho['path'], 'login');

if (!isset($_SESSION['logado']) && !$ehRotaDeLogin) {
    header('Location: /gerenciador_cursos/public/login');
    exit();
}

$psr17Factory = new Psr17Factory();
$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$classeControladora = $rotas[$caminho['path']];
/**
 * @var RequestHandlerInterface $controlador
 */
$controlador = $container->get($classeControladora);
$resposta = $controlador->handle($request);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}
echo $resposta->getBody();