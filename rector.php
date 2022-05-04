<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Rector\PHPOffice\Set\PHPOfficeSetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $containerConfigurator->import(PHPOfficeSetList::PHPEXCEL_TO_PHPSPREADSHEET);

    // get services (needed for register a single rule)
    // $services = $containerConfigurator->services();

    // register a single rule
    // $services->set(TypedPropertyRector::class);
};