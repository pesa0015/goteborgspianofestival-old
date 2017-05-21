'use strict';

var gulp = require('gulp');
var watch = require('gulp-watch');
var sass = require('gulp-sass');
var minifyCSS = require('gulp-csso');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var runSequence = require('run-sequence');

gulp.task('niftymodal', function() {
    return gulp.src('vendor/niftymodal/css/component.css')
        .pipe(minifyCSS())
        .pipe(rename('component.min.css'))
        .pipe(gulp.dest('vendor/niftymodal/css'));
});

gulp.task('js', function() {
    return gulp.src('build/js/*.js')
        .pipe(uglify())
        .pipe(concat('dist.min.js'))
        .pipe(gulp.dest('js'));
});

gulp.task('css', function() {
    return gulp.src('build/sass/main.scss')
        .pipe(sass()).pipe(minifyCSS())
        .pipe(concat('css/dist.min.css'))
        .pipe(gulp.dest('.'));
});

gulp.task('vendor-js', function() {
    return gulp.src(['vendor/jquery.min.js', 'vendor/*/js/*.js', 'js/dist.min.js'])
        .pipe(uglify())
        .pipe(concat('script.min.js'))
        .pipe(gulp.dest('js'));
});

gulp.task('vendor-css', function() {
    return gulp.src(['vendor/*/css/*.min.css', '!vendor/bootstrap/css/*.min.css', '!vendor/quill/css/*.min.css', 'css/dist.min.css'])
        .pipe(concat('style.css'))
        .pipe(gulp.dest('.'));
});

gulp.task('watch', function() {
    runSequence('css', 'vendor-css');
    runSequence('js', 'vendor-js');
    watch('build/sass/*.scss', function() {
        runSequence('css', 'vendor-css');
    });
    watch('build/js/*.js', function() {
        runSequence('js', 'vendor-js');
    });
});
