<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/app'
    ]);

    // Define what rule sets will be applied
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_72);

    // get services (needed for register a single rule)
	$services = $containerConfigurator->services();

	$containerConfigurator->import(\Example\Utils\Rector\Set\ExampleSetList::EXAMPLE_1_0);
    $containerConfigurator->import(\Rector\Nette\Set\NetteSetList::NETTE_30);
};
