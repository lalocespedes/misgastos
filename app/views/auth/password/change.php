{% extends 'templates/default.php' %}

{% block title %} Change password {% endblock %}

{% block content %}

<div class="col-md-6 col-md-offset-3">

<form action="{{ urlFor('password.change.post') }}" method="post" class="form-horizontal" role="form" autocomplete="off">
	<div>
		<label for="password_old">Password actual</label>
		<input type="password" name="password_old" class="form-control" id="password_old">
		{% if errors.has('password_old') %}{{ errors.first('password_old')}}{% endif %}
	</div>
	<div>
		<label for="password_new">Nuevo password</label>
		<input type="password" name="password" class="form-control" id="password">
		{% if errors.has('password') %}{{ errors.first('password')}}{% endif %}
	</div>
	<div>
		<label for="password_confirm">Confirmar nuevo Password</label>
		<input type="password" name="password_confirm" class="form-control" id="password_confirm">
		{% if errors.has('password_confirm') %}{{ errors.first('password_confirm')}}{% endif %}
	</div>
	<br>
	<div>
		<button id="save" class="btn btn-success btn-lg btn-block"><i class="fa fa-floppy-o fa-2x"> Guardar</i></button>
	</div>
	<input type='hidden' name='{{ csrf_key }}' value='{{ csrf_token }}'>
</form>


</div>
{% endblock %}