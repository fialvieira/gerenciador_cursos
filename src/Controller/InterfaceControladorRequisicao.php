<?php

namespace Alura\Cursos\Controller;

interface InterfaceControladorRequisicao
{
    public function processaRequisicao($titulo = null): void;
}