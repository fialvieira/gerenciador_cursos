<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $repositorioDeCursos;
    private $titulo;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioDeCursos = $this->entityManager->getRepository(Curso::class);
        $this->titulo = 'Listar cursos';
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('cursos/listar-cursos.php', [
            'titulo' => $this->titulo,
            'cursos' => $this->repositorioDeCursos->findAll()
        ]);
        return new Response(302, [], $html);
    }
}