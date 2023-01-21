<?php
namespace Deployer;

use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__.'/vendor/autoload.php';
require 'recipe/symfony.php';

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');

// Config

set('repository', 'https://github.com/pcpasapas/symfony.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host($_ENV['DEPLOYER_REPO_HOST'])
    ->hostname($_ENV['DEPLOYER_REPO_HOSTNAME'])
    ->set('deploy_path', '/var/www/html/{{application}}')
    ;

// Hooks

after('deploy:failed', 'deploy:unlock');
