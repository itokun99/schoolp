var gulp = require('gulp'),
    php = require('gulp-connect-php'),
    sass = require("gulp-sass"),
    wait = require("gulp-wait"),
    rename = require("gulp-rename"),
    uglify = require("gulp-uglify"),
    concat = require('gulp-concat'),
    autoprefixer = require("gulp-autoprefixer"),
    browserSync = require('browser-sync');

var reload  = browserSync.reload;

gulp.task('php', function() {
    php.server({ base: 'public', port: 8010, keepalive: true});
});

gulp.task('browser-sync',['php'], function() {
    browserSync.init({
        proxy: '127.0.0.1:8010',
        port: 8080,
        open: true,
        notify: false
    });
});

gulp.task('sass', function () {
	return gulp.src("./assets/website/sass/**/*.scss")
		.pipe(wait(500))
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: ['./bower_components/susy/sass', './bower_components/breakpoint-sass/stylesheets']
		}).on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['>1%', 'last 2 versions'],
			cascade: false
		}))
		.pipe(gulp.dest("./public/assets/css"));
});

gulp.task('scripts', function() {
    return gulp.src(['./assets/website/js/jquery.js', 
    './assets/website/js/bootstrap.js', 
    './assets/website/js/popper.min.js', 
    './assets/website/js/jquery.waypoints.min.js', 
    './assets/website/js/gmail-platform-api.js',
    './assets/website/js/default.js',
    './assets/website/js/kessystem.js',
    './assets/website/js/maps.js',
    './assets/website/js/news.js',  
    './assets/website/js/news-detail.js',
    './assets/website/js/parent-upgrade.js',  
    './assets/website/js/profile.js', 
    './assets/website/js/register.js', 
    './assets/website/js/forget-password.js', 
    './assets/website/js/about.js', 
    './assets/website/js/contact.js', 
    './assets/website/js/faq.js', 
    './assets/website/js/home.js'])
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest("./public/assets/dist"))
        .pipe(rename('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest("./public/assets/dist"));
});

gulp.task('default', ['browser-sync'], function () {
    gulp.watch("./assets/website/sass/**/*.scss",['sass']);
    gulp.watch("./assets/website/js/**/*.js",['scripts']);
    gulp.watch("./public/assets/css/**/*.css").on("change", reload);
    gulp.watch("./public/assets/dist/**/*.js").on("change", reload);
    gulp.watch("./public/*.php").on("change", reload);   
});
