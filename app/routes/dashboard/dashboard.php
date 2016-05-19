<?php

$app->get('/dashboard', $authenticated(), function() use($app) {

	$expense_this_month = $app->expense->this_month();

	$expense_this_year = $app->expense->this_year();

	$category_first = $app->expense->category_first();

	$app->render('dashboard/dashboard.twig',[

		'expense_this_month'	=> $expense_this_month,
		'expense_this_year' 	=> $expense_this_year,
		'category_first'		=> $category_first

	]);
})->name('dashboard');