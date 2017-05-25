var gulp  = require('gulp'),
    concat      = require('gulp-concat'),
    uglify      = require('gulp-uglifyjs'),
    cssnano     = require('gulp-cssnano'),
    rename      = require('gulp-rename');
    
gulp.task('js', function() {
    return gulp.src([
        'js/main_scripts.js',
        'js/theme.js'
    ])
    .pipe(concat('shopengine.all.js'))
    .pipe(uglify())
    .pipe(gulp.dest('js'));
});

gulp.task('js-libs', function() {
    return gulp.src([
        'js/jquery-1.9.1.min.js',
        'js/jquery.magnific-popup.js',
    ])
    .pipe(concat('shopengine.libs.js'))
    .pipe(uglify())
    .pipe(gulp.dest('js'));
});

gulp.task('css', function() {
    return gulp.src([
        'style/_full_/theme.scss.css',
        'style/_full_/custom.css',
        'style/_full_/custom.media.css',
        'css/magnific-popup.css'
    ])
    .pipe(concat('shopengine.all.css'))
    .pipe(cssnano())
    .pipe(gulp.dest('css'));
});

