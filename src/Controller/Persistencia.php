<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getQueryParams();
        $idEntidade = (array_key_exists('id', $queryString)) ? filter_var($queryString['id'], FILTER_VALIDATE_INT): null;
        $descricao = strip_tags($request->getParsedBody()['descricao']);
        $curso = new Curso();
        $curso->setDescricao($descricao);
        if (!is_null($idEntidade) && $idEntidade !== false) {
            $curso->setId($idEntidade);
            $this->entityManager->merge($curso);
            $mensagem = 'Curso atualizado com sucesso';
        } else {
            $this->entityManager->persist($curso);
            $mensagem = 'Curso inserido com sucesso';
        }
        $this->defineMensagem('success', $mensagem);
        $this->entityManager->flush();
        return new Response(302, ['Location' => '/gerenciador_cursos/public/listar-cursos']);
    }
}