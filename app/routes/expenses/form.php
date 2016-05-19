<?php

$validation = function($request) use($app) {

	$category = $request->post('category');
	$date = $request->post('date');
	$description = $request->post('description');
	$amount = $request->post('amount');

	$v = $app->validation;

	return $v->validate([
		'category'		=> [$category, 'required'],
		'date'			=> [$date, 'required|date'],
		//'description'	=> [$description, 'required'],
		'amount'		=> [$amount, 'required|int']
	]);

};


$app->post('/expenses/form/', $authenticated(), function() use($app, $validation) {

	$request = $app->request();

	$category = $request->post('category');
	$date = $request->post('date');
	$description = $request->post('description');
	$amount = $request->post('amount');

	$user_id = $app->auth->id;

	$v = $validation($request);

	if ($v->passes()) {
		
		$app->expense->create([

			'category_id' 			=> $category,
			'expense_date_entered'	=> $date,
			'expense_description'	=> $description,
			'expense_amount'		=> $amount,
			'user_id'				=> $user_id

		]);

		$app->flash('success', 'Guardado!');
		$app->response->redirect($app->urlFor('expenses'));


	} else {

		$categories = $app->category->get();

		$app->render('expenses/form.twig', [
		'request'		=> $request,
		'errors' 		=> $v->errors(),
		'categories'	=> $categories
		]);

	}

});

$app->post('/expenses/form/:id', $authenticated(), function($id) use($app, $validation) {

	$expense = $app->expense->where('id', $id)->first();

	if(!$expense) {
		$app->stop();
	}

	$request = $app->request();

	$category = $request->post('category');
	$date = $request->post('date');
	$description = $request->post('description');
	$amount = $request->post('amount');

	$v = $validation($request);

	if ($v->passes()) {

		$expense->update([

			'category_id' 			=> $category,
			'expense_date_entered'	=> $date,
			'expense_description'	=> $description,
			'expense_amount'		=> $amount

		]);

		$app->flash('success', 'Cambios Guardados!');
		$app->response->redirect($app->urlFor('expenses'));

	} else {

		$categories = $app->category->get();

		$app->render('expenses/form.twig', [
		'id'			=> $id,
		'errors'		=> $v->errors(),
		'request'		=> $request,
		'categories'	=> $categories
		]);
	}

});
