<?php
	require_once __DIR__."/../vendor/autoload.php";
	require_once __DIR__."/../src/Stylist.php";

	$app = new Silex\Application();
	$app['debug']=true;

	$DB= new PDO('pgsql:host=localhost; dbname=hair_salon');

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));


    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

	$app->get("/", function () use ($app)
	{
		return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
	});

	$app->post("/stylists", function () use ($app)
	{	
		//to add a new stylist
		$new_stylist = new Stylist($_POST['name']);
		$new_stylist->save();
		return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
	});

	// $app->delete("/stylists/{id}", function () use ($app)
	// {
	// 	//delete a stylist
	// 	return $app['twig']->render('stylists.twig');
	// });

	// $app->patch("/delete_stylists", function () use ($app)
	// {
	// 	//
	// 	return $app['twig']->render('stylists.twig');
	// });

	// $app->get("/stylists/{id}", function() use ($app)
	// {
	// 	//view a specific stylist
	// 	return $app['twig']->render('stylist.twig');
	// });

	// $app->patch("/stylists/{id}", function() use($app)
	// {
	// 	//change a specific stylist
	// 	return $app['twig']->render('stylist.twig');
	// });

	// $app->get("/stylists/{id}/edit", function() use ($app)
	// {
	// 	return $app['twig']->render('stylists_edit.twig');
	// });


	return $app;
?>