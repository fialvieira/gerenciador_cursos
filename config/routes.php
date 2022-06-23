<?php

use Alura\Cursos\Controller\{CursosEmJson,
    CursosEmXml,
    Deslogar,
    Exclusao,
    FormularioEdicao,
    FormularioInsercao,
    FormularioLogin,
    ListarCursos,
    Persistencia,
    RealizaLogin};

return [
    '/gerenciador_cursos/public/listar-cursos' => ListarCursos::class,
    '/gerenciador_cursos/public/novo-curso' => FormularioInsercao::class,
    '/gerenciador_cursos/public/salvar-curso' => Persistencia::class,
    '/gerenciador_cursos/public/excluir-curso' => Exclusao::class,
    '/gerenciador_cursos/public/atualizar-curso' => FormularioEdicao::class,
    '/gerenciador_cursos/public/login' => FormularioLogin::class,
    '/gerenciador_cursos/public/realiza-login' => RealizaLogin::class,
    '/gerenciador_cursos/public/logout' => Deslogar::class,
    '/gerenciador_cursos/public/buscarCursosEmJson' => CursosEmJson::class,
    '/gerenciador_cursos/public/buscarCursosEmXml' => CursosEmXml::class
];