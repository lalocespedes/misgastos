<?php

$authenticationCheck = function($required) use ($app) {

	return function() use ($required, $app) {

		if ((!$app->auth && $required) || ($app->auth && !$required)) {
			
			$app->redirect($app->urlFor('login'));
			//$app->stop();
		}
	};
};

$authenticated = function() use($authenticationCheck) {

	return $authenticationCheck(true);

};

$guest = function() use($app) {

	return function() use ($app) {

		if ($app->auth) {

			$app->redirect($app->urlFor('home'));
		}
	};

};

$admin = function() use ($app) {

	return function() use ($app) {

		if (!$app->auth || !$app->auth->isAdmin()) {

			$response["message"] = "Access Denied. Admin Area";
            echoRespnse(401, $response);
			$app->stop();
		}
	};

};
