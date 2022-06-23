<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $repositorioDeUsuarios;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_var($request->getParsedBody()['email'], FILTER_VALIDATE_EMAIL);
        if (is_null($email) || $email === false) {
            $this->defineMensagem('danger', 'E-mail digitado não é válido');
            return new Response(302, ['Location' => '/gerenciador_cursos/public/login']);
        }

        $senha = filter_var($request->getParsedBody()['senha'], FILTER_UNSAFE_RAW);

        /**
         * @var Usuario $usuario
         */
        $usuario = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger', 'E-mail ou senha inválidos');
            return new Response(302, ['Location' => '/gerenciador_cursos/public/login']);
        }

        $_SESSION['logado'] = true;
        return new Response(302, ['Location' => '/gerenciador_cursos/public/listar-cursos']);
    }
}