<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursosEmXml implements RequestHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private \Doctrine\ORM\EntityRepository $repositorioDeCursos;
    private $cursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioDeCursos = $this->entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Curso[] cursos */
        $this->cursos = $this->repositorioDeCursos->findAll();
        $cursosEmXml = new \SimpleXMLElement('<cursos/>');
        foreach ($this->cursos as $curso) {
            $cursoEmXml = $cursosEmXml->addChild('curso');
            $cursoEmXml->addChild('id', $curso->getId());
            $cursoEmXml->addChild('descricao', $curso->getDescricao());
        }
        return new Response(200, ['Content-Type' => 'application/xml'], $cursosEmXml->asXML());
    }
}