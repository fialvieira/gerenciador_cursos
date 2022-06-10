<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class Exclusao implements InterfaceControladorRequisicao
{
    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || is_null($id)) {
            header('Location: /gerenciador_cursos/public/listar-cursos');
            return;
        }
        $curso = $this->entityManager->getReference(Curso::class, $id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        header('Location: /gerenciador_cursos/public/listar-cursos');
    }
}