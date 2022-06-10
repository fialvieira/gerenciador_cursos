<?php

namespace Alura\Cursos\Controller;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    public function processaRequisicao($titulo = null) : void
    {
        require __DIR__ . '/../../view/cursos/formulario.php';
    }
}