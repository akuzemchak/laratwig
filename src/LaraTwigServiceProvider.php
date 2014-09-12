<?php

namespace Kuz\LaraTwig;

use Illuminate\Support\ServiceProvider;

class LaraTwigServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->bindShared('twig.loader', function ($app) {
            return new FileLoader(
                $app['config']->get('view.paths'),
                $app['config']->get('laratwig::twig.file_extension')
            );
        });

        $this->app->bindShared('twig', function ($app) {
            return new \Twig_Environment($app['twig.loader'], $app['config']->get('laratwig::twig.options'));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $app = $this->app;

        $this->package('kuz/laratwig', null, __DIR__ . '/..');

        $app['view']->addExtension(
            $app['config']->get('laratwig::twig.file_extension'),
            'twig',
            function () use ($app) {
                return new TwigEngine($app['twig']);
            }
        );

        $this->registerFunctions();
    }

    /**
     * Register configured functions with Twig
     *
     * @return void
     */
    protected function registerFunctions()
    {
        $functions = $this->app['config']->get('laratwig::twig.functions');

        foreach ($functions as $alias => $callable) {
            if (is_int($alias) and is_string($callable)) {
                $alias = $callable;
            }

            $this->app['twig']->addFunction(new \Twig_SimpleFunction($alias, $callable));
        }
    }
}
