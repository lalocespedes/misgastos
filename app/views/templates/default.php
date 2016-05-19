<html>
<head>
	<title>Website | {% block title %} {% endblock %}</title>
        <link href="/css/app.css" type="text/css" rel="stylesheet" />
    	<script src="/js/modernizr.js"></script>
</head>
<body>
	{% include 'templates/partials/messages.twig' %}
	{% include 'templates/partials/navigation.twig' %}
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<fieldset>
					<legend>{{ title }}</legend>
				</fieldset>
			</div>
		</div>

		<p class="text-center text-danger"> {% if errores %} <i class="fa fa-exclamation-circle"></i> {{ errores }}{% endif %} </p>

		{% block content %}{% endblock %}
	</div>
	<script src="/js/app.js"></script>
	
</body>
</html>