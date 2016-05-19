<?php

$app->get('/expenses/delete/:id', $authenticated(), function($id) use($app) {

	$expense = $app->expense->where('id', $id)->first();

	if(!$expense) {
		$app->response->redirect($app->urlFor('expenses'));
	}

	$expense->items()->delete();

	$expense->taxes()->delete();

	$expense->delete();

	unlink(INC_ROOT.'/public/uploads/'.$expense->expense_uuid.'.xml');

	$app->flash('Danger', 'Registro borrado!');
	$app->response->redirect($app->urlFor('expenses'));

})->name('expenses-delete');