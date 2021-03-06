<?php

$app->get('/change-password', $authenticated(), function() use($app) {
	$app->render('auth/password/change.php', [
		'title'	=> 'Cambiar password'
	]);
})->name('auth.password.change');

$app->post('/change-password', $authenticated(), function() use($app) {

	$request = $app->request;

	$passwordOld = $app->request->post('password_old');
	$password = $app->request->post('password');
	$passwordConfirm = $app->request->post('password_confirm');

	$v = $app->validation;

	$v->validate([
		'password_old' => [$passwordOld, 'required|matchesCurrentPassword'],
		'password' => [$password, 'required|min(6))'],
		'password_confirm' => [$passwordConfirm, 'required|matches(password)']
	]);

	if ($v->passes()) {

		$user = $app->auth;

		$user->update([
			'password' => $app->hash->password($password)
		]);

		$app->mail->send('email/auth/password/changed.php', [], function($message) use ($user) {
			
			$message->to($user->email);
			$message->subject('Haz cambiado tu password');

		});
		
		echo "cambio de password";
		exit();

	}

	dd($v->errors());

})->name('password.change.post');

