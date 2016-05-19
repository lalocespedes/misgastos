{% extends 'templates/default.php' %}

{% block title %} {{ user.getFullNameOrUsername}} {% endblock %}

{% block content %}

<div class="row">
    <div class="col-lg-5">
        <div class="media">
            <a class="pull-left" href="#">
				<img src="{{ user.getAvatarUrl }}">
			</a>
            <div class="media-body">
                <h4 class="media-heading">{{ user.username }}<small> Mexico</small></h4>
                <h5>Software Developer at <a href="http://gridle.in">Gridle.in</a></h5>
                <dl>
					{% if user.getFullName  %}
						<dt>Full name</dt>
						<dd>{{ user.getFullName }}</dd>
					{% endif %}
						<dt>Email address</dt>
						<dd>{{ user.email }}</dd>
				</dl>
                <hr style="margin:8px auto">
                <h4><span class="label label-info">Admin</span></h4>
            </div>
        </div>
    </div>
</div>
{% endblock %}