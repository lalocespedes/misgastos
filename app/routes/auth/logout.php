<?php

$app->get('/logout', $authenticated(), function() use($app) {

	unset($_SESSION[$app->config->get('auth.session')]);

	$app->flash('global', 'You has been logged out');

	$app->redirect($app->urlFor('home'));

})->name('logout');