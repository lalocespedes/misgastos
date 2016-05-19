var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

var config = {
     sassPath: './resources/sass',
     bowerDir: './bower_components' 
}

gulp.task('styles', function(){

	return gulp.src([
		'./assets/styles/app.scss',
		'./bower_components/alertify.js/themes/alertify.core.css',
		'./bower_components/alertify.js/themes/alertify.default.css',
		'./bower_components/bootswatch-dist/css/bootstrap.css',
		'./bower_components/jquery-ui/themes/smoothness/jquery-ui.min.css'
	])
	.pipe(sass({
		includePaths:[
			'./bower_components/fontawesome/scss',
		]
	}))
	.pipe(concat('app.css'))
	.pipe(gulp.dest('./public/css'));

});

gulp.task('scripts', function() {

	gulp.src([
		'./bower_components/jquery/dist/jquery.js',
		'./bower_components/jquery-validation/dist/jquery.validate.js',
		'./bower_components/alertify.js/lib/alertify.js',
		'./bower_components/jquery-ui/jquery-ui.js',
		'./bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.js',
		'./assets/scripts/app.js'
	])
	.pipe(concat('app.js'))
	.pipe(gulp.dest('./public/js'));

	return gulp.src('./bower_components/modernizr/modernizr.js')
		.pipe(gulp.dest('./public/js'));

});

gulp.task('icons', function() { 
    return gulp.src(config.bowerDir + '/fontawesome/fonts/**.*') 
        .pipe(gulp.dest('./public/fonts')); 
});

gulp.task('watch', function(){
	gulp.wath('./assets/styles/**/*.scss', ['styles']);
	gulp.wath('./assets/scripts/**/*.js', ['scripts']);
});

gulp.task('default', ['styles', 'scripts', 'icons']);