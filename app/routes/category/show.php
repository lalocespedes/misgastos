<?php

use Illuminate\Pagination\Paginator;

$app->get('/category', $authenticated(), function() use($app) {

	$currentPage = $app->request()->get('page');

	Paginator::currentPageResolver(function() use ($currentPage) {
    	
    	return $currentPage;
	
	});

	$categories = $app->category->paginate(5);

	$categories->setPath('category');

	$app->render('category/show.twig', [
		'categories' => $categories
	]);

})->name('category');
