<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao implements InterfaceControladorRequisicao
{
    private \Doctrine\ORM\EntityRepository $repositorioCursos;
    private \Doctrine\ORM\EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $this->entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || is_null($id)) {
            header('Location: /gerenciador_cursos/public/atualizar-cursos');
            return;
        }
        $titulo = 'Alterar curso';
        $curso = $this->repositorioCursos->find($id);
        require __DIR__ . '/../../view/cursos/formulario.php';
    }
}