<?php

use Doctrine\ORM\Tools\Console\Command as ORMCommand;

require_once 'vendor/autoload.php';

$helperSet = null;

define('BASEPATH', dirname(__DIR__));

if(getenv('PHP_ENV')){
define('ENVIRONMENT', getenv('PHP_ENV'));
}else{
define('ENVIRONMENT', 'development');
}

define('APPPATH', 'application/');
define('EXT', '.php');

require_once APPPATH."libraries/doctrine.php";

$doctrine = new Doctrine();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($doctrine->em->getConnection()),
'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($doctrine->em),
));

$cli = new Symfony\Component\Console\Application('Command Line Interface', \Doctrine\ORM\Version::VERSION);

$helperSet = ($helperSet) ?: new \Symfony\Component\Console\Helper\HelperSet();

$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

$cli->addCommands(array(
  // Migrations Commands
  new ORMCommand\ConvertDoctrine1SchemaCommand(),
  new ORMCommand\ConvertMappingCommand(),
  new ORMCommand\EnsureProductionSettingsCommand(),
  new ORMCommand\GenerateEntitiesCommand(),
  new ORMCommand\GenerateProxiesCommand(),
  new ORMCommand\GenerateRepositoriesCommand(),
  new ORMCommand\InfoCommand(),
  new ORMCommand\MappingDescribeCommand(),
  new ORMCommand\RunDqlCommand(),
  new ORMCommand\ValidateSchemaCommand(),

));

\Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);
$cli->run();
