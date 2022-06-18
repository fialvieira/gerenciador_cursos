<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
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