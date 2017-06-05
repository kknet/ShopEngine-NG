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
        'plugins/owlcarousel/owl.carousel.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js'
    ])
    .pipe(concat('shopengine.libs.js'))
    .pipe(uglify())
    .pipe(gulp.dest('js'));
});

gulp.task('css', function() {
    return gulp.src([
        'style/_full_/theme.scss.css',
        'style/_full_/custom.css',
        'style/_full_/custom.media.css'
    ])
    .pipe(concat('shopengine.all.css'))
    .pipe(cssnano())
    .pipe(gulp.dest('css'));
});

gulp.task('css-libs', function() {
    return gulp.src([
        'css/magnific-popup.css',
        'plugins/owlcarousel/assets/owl.carousel.min.css',
        'plugins/owlcarousel/assets/owl.theme.default.min.css'
    ])
    .pipe(concat('shopengine.libs.css'))
    .pipe(cssnano())
    .pipe(gulp.dest('css'));
});

