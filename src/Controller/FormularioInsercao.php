<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioInsercao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    private $titulo;

    public function __construct()
    {
        $this->titulo = 'Novo curso';
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('cursos/formulario.php', [
            'titulo' => $this->titulo
        ]);
        return new Response(302, [], $html);
    }
}