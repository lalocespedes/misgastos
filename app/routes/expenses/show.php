<?php

use Illuminate\Pagination\Paginator;

$app->get('/expenses', $authenticated(), function() use($app) {

	$currentPage = $app->request()->get('page');

	Paginator::currentPageResolver(function() use ($currentPage) {
    	
    	return $currentPage;
	
	});

	if ($app->auth->isAdmin()) {

		$expenses = $app->expense
						->with('category', 'user')
						->paginate(5);
	
	} else{

		$expenses = $app->expense
						->with('category')
						->where('user_id', $app->auth->id)
						->paginate(5);
	}
	
	$expenses->setPath('expenses');

	$app->render('expenses/show.twig', [
		'expenses'	=> $expenses
	]);

})->name('expenses');
