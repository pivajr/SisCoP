<?php

namespace Deployer;

require 'recipe/laravel.php';

$environmentVariables = array_filter(
    $_SERVER,
    function ($key) {
        return strpos($key, 'DEPLOYER__') === 0;
    },
    ARRAY_FILTER_USE_KEY
);

set('default_timeout', 700);

set('bin/php', function () {
    return '/opt/cpanel/ea-php81/root/usr/bin/php -d memory_limit=-1';
});

set('bin/composer', function () {
    return '{{bin/php}} /home1/saapr376/composer.phar';
});

// Project name
set('application', 'SisCop - Sistema de Controle de Presença');

set('ambiente', $environmentVariables['DEPLOYER_AMBIENTE']);

set('tag_version', $environmentVariables['CI_COMMIT_TAG']);

// set('http_user', true);

// Project repository
set('repository', $environmentVariables['DEPLOYER_REPO'] ?? 'git@gitlab.com:siscop/core/siscop-api-laravel.git');

// [Optional] Allocate tty for git clone. Default value is false.
// set('git_tty', true);

set ('ssh_multiplexing', false);

# To solve this issue: Can't detect http user name. Please set up the `http_user` config parameter.
set('http_user', 'www-data');
set('writable_mode', 'chmod');
set('use_relative_symlink', '0');

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
inventory('hosts.yml');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

after('artisan:migrate', 'artisan:db:seed');
after('artisan:config:cache', 'artisan:route:cache');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
