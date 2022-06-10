<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements InterfaceControladorRequisicao
{
    private $repositorioDeCursos;
    private $titulo;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
        $this->titulo = 'Listar cursos';
    }

    public function processaRequisicao(): void
    {
        $titulo = $this->titulo;
        $cursos = $this->repositorioDeCursos->findAll();
        require __DIR__ . '/../../view/cursos/listar-cursos.php';
    }
}