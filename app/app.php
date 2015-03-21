<?php
	require_once __DIR__."/../vendor/autoload.php";
	require_once __DIR__."/../src/Stylist.php";

	$app = new Silex\Application();
	$app['debug']=true;

	$DB= new PDO('pgsql:host=localhost; dbname=hair_salon');

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));


    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

	$app->get("/stylists", function () use ($app)
	{
		return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
	});

	$app->post("/stylists", function () use ($app)
	{
		return $app['twig']->render('stylists.twig');
	});

	$app->delete("/stylists/{id}", function () use ($app)
	{
		return $app['twig']->render('stylists.twig');
	});

	$app->patch("/delete_stylists", function () use ($app)
	{
		return $app['twig']->render('stylists.twig');
	});

	$app->get("/stylist/{id}", function() use ($app)
	{
		return $app['twig']->render('stylists.twig');
	});

	$app->patch("/stylist/{id}", function() use($app)
	{
		return $app['twig']->render('stylists.twig');
	});

	$app->get("/stylists/{id}", function() use ($app)
	{
		return $app['twig']->render("/stylists/{id}/edit");
	});


	return $app;
?>