<?php
	require_once __DIR__."/../vendor/autoload.php";
	require_once __DIR__."/src/Stylist.php";

	$app = new Silex\Application();
	$app['debug']=true;

	$DB= new PDO('pgsql:host=localhost; dbname=hair_salon');

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));


	return $app;
?>