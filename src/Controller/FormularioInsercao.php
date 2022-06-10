<?php

namespace Alura\Cursos\Controller;

class FormularioInsercao extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $titulo;

    public function __construct()
    {
        $this->titulo = 'Novo curso';
    }

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/formulario.php', [
            'titulo' => $this->titulo
        ]);
    }
}