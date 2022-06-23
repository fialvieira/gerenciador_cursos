<?php

use Alura\Cursos\Infra\EntityManagerCreator;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;

$containterBuilder = new ContainerBuilder();

$containterBuilder->addDefinitions([
    EntityManagerInterface::class => function () {
        return ((new EntityManagerCreator())->getEntityManager());
    },
]);
return $containterBuilder->build();