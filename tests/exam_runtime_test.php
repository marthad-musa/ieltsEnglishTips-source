<?php

require_once __DIR__ . '/../app/bootstrap.php';

$tests = 0;
$failures = [];
$assert = function(string $name, bool $condition) use (&$tests, &$failures): void {
    $tests++;
    if (!$condition) {
        $failures[] = $name;
    }
};

$router = (new ReflectionClass(App::class))->newInstanceWithoutConstructor();
$_GET['url'] = 'manage_courses/edit/12';
$assert('router preserves controller, method, and ID segments', $router->getUrl() === ['manage_courses', 'edit', '12']);

$_GET['url'] = '/';
$assert('router treats the site root as an empty route', $router->getUrl() === []);
$assert('application root points to app directory', realpath(APPROOT) === realpath(__DIR__ . '/../app'));
$assert('admin dashboard view exists', is_file(APPROOT . '/views/dashboard/admin.php'));

ob_start();
$_GET['url'] = 'pages/about';
new App();
$aboutPage = ob_get_clean();
$assert('About route dispatches and renders its view', strpos($aboutPage, 'About Us') !== false);

ob_start();
$_GET['url'] = 'missing-controller';
new App();
ob_end_clean();
$assert('unknown controller returns 404', http_response_code() === 404);

if ($failures) {
    fwrite(STDERR, count($failures) . " of {$tests} checks failed:\n- " . implode("\n- ", $failures) . "\n");
    exit(1);
}

fwrite(STDOUT, "All {$tests} application bootstrap checks passed.\n");
