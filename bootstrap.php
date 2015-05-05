<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;

require_once "vendor/autoload.php";

$isDevMode = true;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
/*$conn = array(
    'driver' => 'pdo_mysql',
    'user'     => 'root',
    'password' => '1234',
    'dbname'   => 'db',
    'host'     => 'db.local'
);*/
$db_yml = getenv("DB_YML") == "" ? __DIR__ . "/config/db.yml" : __DIR__ . "/" . getenv("DB_YML");
$db_config = Yaml::parse(file_get_contents( $db_yml ));
$conn = $db_config["database"][getenv("CONN")];

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

// custom type
require_once "MyNumeric.php";
Doctrine\DBAL\Types\Type::addType('mynumeric', 'DbDiffer\Types\MyNumeric');


// postgresql mapping
$platform = $entityManager->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('_int4', 'integer');
$platform->registerDoctrineTypeMapping('abstime', 'string'); // date?
$platform->registerDoctrineTypeMapping('oid', 'string');
$platform->registerDoctrineTypeMapping('numeric', 'mynumeric');

