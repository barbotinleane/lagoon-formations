<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'https://github.com/barbotinleane/lagoon-formations.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('lagoonformations')
    ->set('remote_user', 'lagoonk')
    ->set('http_user', 'lagoonk')
    ->set('deploy_path', '~/symfony')
    ->set('writable_mode', 'chmod');

// Tasks
task('cache:clear', function () {
    run('php {{release_path}}/bin/console cache:clear');
});

task('init:database', function() {
    run('{{bin/php}} {{bin/console}} doctrine:schema:create');
});

task('echo:options', function() {
    writeln('OPTIONS: {{composer_options}}');
});

task('build', function () {
    cd('{{release_path}}');
    run('npm run build');
});

task('initialize', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:unlock',
    'cleanup',
]);

task('mydeploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:cache:clear',
    'deploy:cache:warmup',
    'deploy:unlock',
    'cleanup',
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
//after('deploy:unlock', 'copy:public');


// Migrate database before symlink new release.
//before('deploy:unlock', 'database:migrate');
