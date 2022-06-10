<?php

use Alura\Cursos\Controller\{Exclusao, FormularioEdicao, FormularioInsercao, ListarCursos, Persistencia};

return [
    '/gerenciador_cursos/public/listar-cursos' => ListarCursos::class,
    '/gerenciador_cursos/public/novo-curso' => FormularioInsercao::class,
    '/gerenciador_cursos/public/salvar-curso' => Persistencia::class,
    '/gerenciador_cursos/public/excluir-curso' => Exclusao::class,
    '/gerenciador_cursos/public/atualizar-curso' => FormularioEdicao::class
];