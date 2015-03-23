<?php
	require_once __DIR__."/../vendor/autoload.php";
	require_once __DIR__."/../src/Stylist.php";

	$app = new Silex\Application();
	$app['debug']=true;

	$DB= new PDO('pgsql:host=localhost; dbname=hair_salon');

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));


    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

	$app->get("/", function() use ($app)
	{
		return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
	});

	$app->get("/stylists", function() use ($app)
	{
		return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
	});

	//WORKS TO ADD NEW STYLIST
	$app->post("/stylists", function () use ($app)
	{	
		//to add a new stylist
		$new_stylist = new Stylist($_POST['name']);
		$new_stylist->save();
		return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
	});

	$app->get("/stylists/{id}", function($id) use ($app)
	{
		//view a specific stylist
		$current_stylist = Stylist::find($id);
		return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'stylists'=>Stylist::getAll()));
	});

	$app->get("/stylists/{id}/edit", function($id) use ($app)
	{
		$current_stylist = Stylist::find($id);
		return $app['twig']->render('stylist_edit.twig', array('stylist' => $current_stylist));		
	});

	$app->patch("/stylists/{id}", function($id) use ($app) {
        $current_stylist = Stylist::find($id);
        $new_name = $_POST['name'];
        $current_stylist->update($new_name);
        return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'stylists'=> Stylist::getAll()));
    });

	$app->delete("/stylists/{id}", function ($id) use ($app)
	{
		//delete a stylist
		$current_stylist = Stylist::find($id);
		$current_stylist->delete();
		return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
	});    

	//WORKS TO DELETE ALL STYLISTS ON HOME PAGE AND STAY HOME
	$app->post("/delete_stylists", function() use ($app) 
	{
        Stylist::deleteAll();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

	//Clients section
	$app->get("clients", function() use ($app){
		return $app['twig']->render('clients.twig', array('clients'=> Client::getAll()));
	})
	return $app;
?>