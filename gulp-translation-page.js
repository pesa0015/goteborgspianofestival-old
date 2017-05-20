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
    return gulp.src('lang/build/script.js')
        .pipe(uglify())
        .pipe(concat('dist-translate.min.js'))
        .pipe(gulp.dest('js'));
});

gulp.task('css', function() {
    return gulp.src('lang/build/style.css')
        .pipe(minifyCSS())
        .pipe(concat('css/dist-translate.min.css'))
        .pipe(gulp.dest('.'));
});

gulp.task('vendor-js', function() {
    return gulp.src(['vendor/quill/js/quill.min.js', 'vendor/niftymodal/js/*.js', 'js/dist-translate.min.js'])
        .pipe(uglify())
        .pipe(concat('script-translate.min.js'))
        .pipe(gulp.dest('js'));
});

gulp.task('vendor-css', function() {
    return gulp.src(['vendor/bootstrap/css/bootstrap.min.css', 'vendor/quill/css/quill.snow.min.css', 'vendor/niftymodal/css/component.min.css', 'css/dist-translate.min.css'])
        .pipe(concat('style-translate.min.css'))
        .pipe(gulp.dest('.'));
});

gulp.task('watch', function() {
    runSequence('css', 'vendor-css');
    runSequence('js', 'vendor-js');
    watch('lang/build/style.css', function() {
        runSequence('css', 'vendor-css');
    });
    watch('build/js/*.js', function() {
        runSequence('js', 'vendor-js');
    });
});
