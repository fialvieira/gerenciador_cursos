<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private EntityRepository $repositorioCursos;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioCursos = $this->entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getQueryParams();
        $id = (array_key_exists('id', $queryString)) ? filter_var($queryString['id'], FILTER_VALIDATE_INT) : null;
        if ($id === false || is_null($id)) {
            return new Response(302, ['Location' => '/gerenciador_cursos/public/atualizar-cursos']);
        }
        $curso = $this->repositorioCursos->find($id);
        $html = $this->renderizaHtml('cursos/formulario.php', [
            'titulo' => 'Alterar curso',
            'curso' => $curso
        ]);
        return new Response(302, [], $html);
    }
}