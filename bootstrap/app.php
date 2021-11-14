<?php
use Cart\App;
use Cart\Middleware\OldInputMiddleware;
use Cart\Middleware\ValidationErrorsMiddleware;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Views\Twig;

session_start();
require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv('../');
$dotenv->load();

$app = new App;

$container = $app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

Braintree_Configuration::environment(getenv('BRAINTREE_ENVIRONMENT'));
Braintree_Configuration::merchantId(getenv('BRAINTREE_MERCHANTID'));
Braintree_Configuration::publicKey(getenv('BRAINTREE_PUBLICKEY'));
Braintree_Configuration::privateKey(getenv('BRAINTREE_PRIVATEKEY'));

require __DIR__ . '/../app/routes.php';

$app->add(new ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new OldInputMiddleware($container->get(Twig::class)));