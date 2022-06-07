<?php
// deploy.php
declare(strict_types=1);

namespace Deployer;


require 'recipe/symfony4.php';

// Project name
set('application', 'Lagoon Formations');

// Project repository
set('repository', 'https://github.com/barbotinleane/lagoon-formations.git');

// Set composer options
set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-scripts');

// shared files & folders
add('shared_files', ['.env.local']);
add('shared_dirs', ['public/upload']);

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
// before('deploy:symlink', 'database:migrate');

// Build yarn locally
task('deploy:build:assets', function (): void {
    run('yarn install');
    run('yarn encore production');
});

before('deploy:symlink', 'deploy:build:assets');

// Upload assets
task('upload:assets', function (): void {
    upload(__DIR__ . '/public/build/', '{{release_path}}/public/build');
});

after('deploy:build:assets', 'upload:assets');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
