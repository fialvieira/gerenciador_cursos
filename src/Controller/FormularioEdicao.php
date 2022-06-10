<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
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
        $curso = $this->repositorioCursos->find($id);
        echo $this->renderizaHtml('cursos/formulario.php', [
            'titulo' => 'Alterar curso',
            'curso' => $curso
        ]);
    }
}