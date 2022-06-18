<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
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
        echo $this->renderizaHtml('cursos/listar-cursos.php', [
            'titulo' => $this->titulo,
            'cursos' => $this->repositorioDeCursos->findAll()
        ]);
    }
}