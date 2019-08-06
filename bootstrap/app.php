<?php

require_once __DIR__ . '/../vendor/autoload.php';
$command = implode(" ", $_SERVER['argv']);
if (strpos($command, "--env") !== false) {
    $env = explode("=", $command)[1];
    (new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
        dirname(__DIR__),
        '.env.' . $env
    ))->bootstrap();
} else {
    (new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
        dirname(__DIR__)
    ))->bootstrap();
}


/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);
collect(scandir(__DIR__ . '/../config'))->each(function ($item) use ($app) {
    $app->configure(basename($item, '.php'));
});
// $app->withFacades();

// $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\CustomHandler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/
$app->middleware([
    \Barryvdh\Cors\HandleCors::class,
]);
// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/
$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\FormRequestServiceProvider::class);
$app->register(Barryvdh\Cors\ServiceProvider::class);
$app->register(\App\Http\Repositories\RepositoriesProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);
$app->make('queue');
$app->bound('queue');
$app->withFacades(true, [
    App\Http\Libraries\Providers\MainServiceProviderFacade::class => "MainServiceProvider",
    App\Http\Libraries\EmailSenders\MailFactoryFacade::class => "ExMailer"
]);
$app->withEloquent();
/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__ . '/../routes/web.php';
});

return $app;
