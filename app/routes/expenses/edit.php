<?php

$app->get('/expenses/edit/:id', $authenticated(), function($id) use($app) {

	$expense = $app->expense->with('category')
							->with('supplier')
							->with('items')
							->with('taxes')
							->where('id', $id)
							->first();

	if(!$expense) {
		$app->response->redirect($app->urlFor('expenses'));
	}

	$categories = $app->category->get();

	if ($expense->expense_uuid) {

		$app->render('expenses/xml.twig', [
		'id'			=> $id,
		'expense'		=> $expense,
		'categories'	=> $categories
	]);


	} else {

		$app->render('expenses/form.twig', [
			'title'			=> 'Editar Gasto',
			'id'			=> $id,
			'expense'		=> $expense,
			'categories'	=> $categories
		]);

	}

})->name('expenses-edit');
