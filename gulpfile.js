var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var fontgen = require('gulp-fontgen');



var sassPaths = [
    'resources/bower_components/normalize.scss/sass',
    'resources/bower_components/foundation-sites/scss',
    'resources/bower_components/motion-ui/src',
    'resources/assets/sass/**/*.scss'
];

//style paths
var sassFiles = 'resources/assets/sass/**/*.scss',
    cssDest = 'public/static/advertiser/css/',
    jsFiles = 'resources/assets/js/**/*.js',
    jsLib = 'resources/bower_components/**/*.min.js',
    jsDest = 'public/static/advertiser/js/',
    fontFiles = 'resources/assets/fonts/**/*.{ttf,otf}';
    fontDest = 'public/static/advertiser/fonts/';

gulp.task('sass', function () {
    return gulp.src(sassFiles)
        .pipe(sass({
            includePaths: sassPaths,
            outputStyle: 'compressed' // if css compressed **file size**
        })
            .on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions', 'ie >= 9']
        }))
        .pipe(gulp.dest(cssDest));
});

gulp.task('js', function () {
    return gulp.src(jsFiles)
        .pipe(concat('app.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('app.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest));
});

gulp.task('fontgen', function() {
    return gulp.src(fontFiles)
        .pipe(fontgen({
            dest: fontDest
        }));
});

gulp.task('jsLib', function () {
    return gulp.src(jsLib)
        .pipe(gulp.dest(jsDest));
});

// Watch Files For Changes
gulp.task('watch', function () {
    gulp.watch([sassFiles, jsFiles], ['sass', 'js']);
});

// Default Task
gulp.task('default', ['fontgen', 'sass', 'jsLib', 'js']);