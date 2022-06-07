<?php
namespace Deployer;

require 'recipe/symfony.php';

// Configurations

set('repository', 'https://github.com/barbotinleane/lagoon-formations.git');

add('shared_files', ['.env.local']);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('ssh.cluster031.hosting.ovh.net')
    ->set('remote_user', 'lagoonk')
    ->set('deploy_path', '~/symfony')
    ->set('writable_mode', 'chmod');

// Tasks
task('pwd', function (): void {
    $result = run('pwd');
    writeln("Current dir: {$result}");
});

// [Optional]  Migrate database before symlink new release.
before('deploy:symlink', 'database:migrate');

// Build yarn locally
task('deploy:build:assets', function (): void {
    run('yarn install');
    run('yarn encore production');
})->local()->desc('Install front-end assets');

before('deploy:symlink', 'deploy:build:assets');

// Upload assets
task('upload:assets', function (): void {
    upload(__DIR__.'/public/build/', '{{release_path}}/public/build');
});

after('deploy:build:assets', 'upload:assets');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
