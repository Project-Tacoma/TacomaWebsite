'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('styles', function() {
    gulp.src('webroot/src/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('webroot/css/'))
});

//Watch task
gulp.task('default',function() {
    gulp.watch('webroot/src/sass/**/*.scss',['styles']);
});
