<?php

namespace Alura\Cursos\Controller;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    private $titulo;

    public function __construct()
    {
        $this->titulo = 'Novo curso';
    }

    public function processaRequisicao(): void
    {
        $titulo = $this->titulo;
        require __DIR__ . '/../../view/cursos/formulario.php';
    }
}