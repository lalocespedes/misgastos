<?php

$app->get('/premium', function() use($app) {

	$app->render('premium/premium.twig');

});