<?php

$app->post('/premium_charge', function() use($app) {

	$request = $app->request();

	if (isset($_POST['stripeToken'])) {
		
		$token = $request->post('stripeToken');

		\Stripe\Stripe::setApiKey(stripe_private);

		try {

			Stripe\Charge::create(array(
			  "amount" => $request->post('total'),
			  "currency" => "usd",
			  "source" => $token,
			  "description" => $request->post('description') //aqui poner el user
			));

			//hacer query a la db agregando el status
			$app->flash('global', 'Pago aplicado!');
			$app->response->redirect($app->urlFor('home'));
			
		} catch (Stripe_CardError $e) {
			
		}

	}

})->name('premium_charge');