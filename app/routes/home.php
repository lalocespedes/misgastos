<?php

$app->get('/', $authenticated(), function() use($app) {

	$phinx = new Phinx\Console\PhinxApplication();

	$wrap = new Phinx\Wrapper\TextWrapper($phinx, [
        'configuration' => INC_ROOT.'/app/phinx.yml', 
        'parser' => 'yaml', 
        'name' => 'misgastos', 
        'user' => 'root', 
        'pass' => 'root'
    ]);


	call_user_func([$wrap, 'getMigrate']);

	$expense_this_month = $app->expense->this_month()->sum('expense_amount');

	$expense_this_year = $app->expense->this_year()->sum('expense_amount');

	$category_first = $app->expense->category_first()->get();

	if (!$app->auth->isAdmin()) {

		$expense_this_month = $app->expense->this_month()->where('user_id', $app->auth->id)->sum('expense_amount');

		$expense_this_year = $app->expense->this_year()->where('user_id', $app->auth->id)->sum('expense_amount');

		$category_first = $app->expense->category_first()->where('user_id', $app->auth->id)->get();
	}

	$app->render('home.twig', [
		'expense_this_month'	=> $expense_this_month,
		'expense_this_year' 	=> $expense_this_year,
		'category_first'		=> $category_first
	]);

})->name('home');
