<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursosEmJson implements RequestHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private \Doctrine\ORM\EntityRepository $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioDeCursos = $this->entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($this->repositorioDeCursos->findAll()));
    }
}