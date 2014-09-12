# LaraTwig

_A simple [Twig](http://twig.sensiolabs.org/) integration package for [Laravel](http://laravel.com/)._

## Warning

LaraTwig isn't quite ready for public use yet, so do so at your own risk!

## Why Twig?

Laravel ships with [Blade](http://laravel.com/docs/templates#blade-templating), which is a decent lightweight template engine. However, sometimes you need something a little more full-featured and powerful, and Twig is the clear leader in PHP template engines. If you're already familiar with Twig, then there's no point in explaining further... you already know the awesomeness. If you're new to Twig, check out the fantastic [documentation](http://twig.sensiolabs.org/documentation) to see what the fuss is all about.

## Why LaraTwig?

There already is a [great Twig package for Laravel](https://github.com/rcrowe/TwigBridge), and it's a lot more feature-rich than this one. My goal with LaraTwig is to have a simple and straightforward alternative that is easy to maintain and quick to implement.

## Installation and Usage

### 1. Install

Add the package to your _composer.json_ file:

	{
		"require": {
			...
			"kuz/laratwig": "0.*"
		}
	}

Then run `composer update`.

### 2. Integrate

Register the service provider in _app/config/app.php_:

	'providers' => array(
		...
		'Kuz\LaraTwig\LaraTwigServiceProvider',
	),

### 3. Configure

If you want to change the default config, run the following Artisan command:

	php artisan config:publish kuz/laratwig --path=vendor/kuz/laratwig/config

You can then make changes in `app/config/packages/kuz/laratwig/twig.php`.

### 4. Create

Create your view files in the usual place, using the file extension set in the config (_.twig_ by default).

## Helper Functions

Twig requires you to [register functions](http://twig.sensiolabs.org/doc/advanced.html#functions) that you want to use in your templates. LaraTwig makes this a bit easier by allowing you to specify them in the config file. There are already some commonly-used Laravel functions in there, but you can add your own like this:

	'functions' => [
		...
		'base64_encode',
		'b64e' => function ($value) {
			return base64_encode($value);
		},
	],

Basically, we just utilized two different methods to add a `base64_encode` function for our templates. In the first example, we are telling Twig that calling `base64_encode('some string')` will call a function of the same name. In the second example, we are telling Twig that calling `b64e('my string')` will execute the specified closure (or any other [callable](http://php.net/manual/en/language.types.callable.php) that you specify).

## Facades

LaraTwig does **not** provide a way to use [Facades](http://laravel.com/docs/facades) in your Twig templates. However, Laravel's `app()` function is already registered for you, which should allow you to pretty much do everything you normally would. For example, if you wanted to use `Form::text('name')` in your template, you would instead use `app('form').text('name')`.

## Acknowledgments

Thanks to [Fabien Potencier](https://github.com/fabpot) and the Twig team for building an amazing template engine.

Thanks to [Taylor Otwell](https://github.com/taylorotwell) for creating and maintaining one of the best Web development frameworks available in **any** programming language.

Thanks to [Rob Crowe](https://github.com/rcrowe) and [Barry vd. Heuvel](https://github.com/barryvdh) for their work on the [Laravel TwigBridge](https://github.com/rcrowe/TwigBridge) package, which inspired some of the ideas for LaraTwig.