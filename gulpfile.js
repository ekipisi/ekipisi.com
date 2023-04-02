var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var mq4HoverShim = require('mq4-hover-shim');
var rimraf = require('rimraf').sync;
var concat = require('gulp-concat');
var minify = require('gulp-minify');
var cleanCSS = require('gulp-clean-css');
var nodepath =  'node_modules/';
var assetspath =  './resources/bulkit/';

gulp.task('reset', function() {
    rimraf('./public/css/*');
    rimraf('./public/fonts/*');
    rimraf('./public/images/*');
    rimraf('./public/js/*');
});

gulp.task('copy', function() {
    gulp.src(['./resources/bulkit/css/icons.min.css']).pipe(gulp.dest('./public/css/'));
    gulp.src(['./resources/bulkit/fonts/**/*']).pipe(gulp.dest('./public/fonts/'));
    gulp.src([nodepath + 'datedropper/dd-icon/**/*']).pipe(gulp.dest('./public/css/dd-icon/'));
    gulp.src([nodepath + 'wickedpicker/fonts/**/*']).pipe(gulp.dest('./public/fonts/'));
    gulp.src([nodepath + 'slick-carousel/slick/fonts/**/*']).pipe(gulp.dest('./public/css/fonts/'));
    gulp.src([nodepath + 'slick-carousel/slick/ajax-loader.gif']).pipe(gulp.dest('./public/css/'));
});

var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed',
    includePaths: [nodepath + 'bulma/sass']
};

var scssOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed',
    includePaths: ['./resources/assets/scss/partials']
};

gulp.task('compile-sass', function () {
    var processors = [
        mq4HoverShim.postprocessorFor({ hoverSelectorPrefix: '.is-true-hover' }),
        autoprefixer({
            browsers: [
                "Chrome >= 45",
                "Firefox ESR",
                "Edge >= 12",
                "Explorer >= 10",
                "iOS >= 9",
                "Safari >= 9",
                "Android >= 4.4",
                "Opera >= 30"
            ]
        })
    ];
    return gulp.src('./resources/bulma/bulma.sass')
        // .pipe(sourcemaps.init())
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(postcss(processors))
        // .pipe(sourcemaps.write())
        .pipe(gulp.dest('./public/css/'));
});

gulp.task('compile-scss', function () {
    var processors = [
        mq4HoverShim.postprocessorFor({ hoverSelectorPrefix: '.is-true-hover' }),
        autoprefixer({
            browsers: [
                "Chrome >= 45",
                "Firefox ESR",
                "Edge >= 12",
                "Explorer >= 10",
                "iOS >= 9",
                "Safari >= 9",
                "Android >= 4.4",
                "Opera >= 30"
            ]
        })
    ];
    return gulp.src('./resources/assets/scss/ekipisi.scss')
        // .pipe(sourcemaps.init())
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(postcss(processors))
        // .pipe(sourcemaps.write())
        .pipe(cleanCSS())
        .pipe(gulp.dest('./public/css/'));
});

gulp.task('compile-css', function() {
    return gulp.src([ 
        nodepath + 'izitoast/dist/css/iziToast.min.css', 
        // nodepath + 'slick-carousel/slick/slick.css',
        // nodepath + 'slick-carousel/slick/slick-theme.css',
        nodepath + 'animate.css/animate.min.css',
        // nodepath + 'wickedpicker/dist/wickedpicker.min.css',
        // nodepath + 'datedropper/datedropper.min.css',
        // nodepath + 'timedropper/timedropper.min.css',
        // nodepath + 'easy-autocomplete/dist/easy-autocomplete.min.css',
        nodepath + 'card-js/card-js.min.css',
        //Additional static css assets
        // assetspath + 'css/datepicker/datepicker.css',
        assetspath + 'css/chosen/chosen.css',
        assetspath + 'js/flickity/flickity.css',
        assetspath + 'js/simplemde/simplemde.min.css',
        assetspath + 'js/fileuploader/jquery.fileuploader.min.css',
        assetspath + 'js/card/card.css',
    ])
        .pipe(concat('app.css'))
        .pipe(cleanCSS())
        .pipe(gulp.dest('./public/css/'));
});

gulp.task('compile-js', function() {
    return gulp.src([ 
        nodepath + 'jquery/dist/jquery.min.js', 
        // nodepath + 'slick-carousel/slick/slick.min.js', 
        nodepath + 'izitoast/dist/js/iziToast.min.js',
        nodepath + 'chosen-js/chosen.jquery.min.js',
        nodepath + 'scrollreveal/dist/scrollreveal.min.js',
        nodepath + 'vivus/dist/vivus.min.js',
        nodepath + 'waypoints/lib/jquery.waypoints.min.js',
        nodepath + 'waypoints/lib/shortcuts/sticky.min.js',
        nodepath + 'jquery.counterup/jquery.counterup.min.js',
        nodepath + '@claviska/jquery-dropdown/jquery.dropdown.min.js',
        // nodepath + '@fengyuanchen/datepicker/dist/datepicker.min.js',
        // nodepath + 'paper/dist/paper-full.min.js',
        // nodepath + 'wickedpicker/dist/wickedpicker.min.js',
        // nodepath + 'datedropper/datedropper.min.js',
        // nodepath + 'timedropper/timedropper.min.js',
        // nodepath + 'easy-autocomplete/dist/jquery.easy-autocomplete.min.js',
        // nodepath + 'jquery-tags-input/dist/jquery.tagsinput.min.js',
        nodepath + 'jquery-validation/dist/jquery.validate.min.js',
        nodepath + 'jquery-validation/dist/additional-methods.js',
        nodepath + 'card-js/card-js.min.js',
        nodepath + 'inputmask/dist/min/jquery.inputmask.bundle.min.js',
        //Additional static js assets
        // assetspath + 'js/ggpopover/ggpopover.min.js',
        assetspath + 'js/ggpopover/ggtooltip.js',
        assetspath + 'js/gmap/gmap.min.js',
        assetspath + 'js/fileuploader/jquery.fileuploader.js',
        assetspath + 'js/steps/jquery.steps.js',
        assetspath + 'js/flickity/flickity.pkgd.min.js',
        assetspath + 'js/simplemde/simplemde.min.js',
        assetspath + 'js/card/card.js',
        assetspath + 'js/scrollspy/scrollspy.min.js',
        // nodepath + 'bulma-extensions/bulma-steps/dist/bulma-steps.min.js',
    ])
        .pipe(concat('app.js'))
        .pipe(minify())
        .pipe(gulp.dest('./public/js/'));
});

gulp.task('copy-js', function() {
    gulp.src('./resources/assets/js/**/*.js')
        // .pipe(concat('ekipisi.js'))
        .pipe(minify())
        .pipe(gulp.dest('./public/js/'));
});

//Copy images to production site
gulp.task('copy-images', function() {
    gulp.src('./resources/bulkit/images/**/*')
        .pipe(gulp.dest('./public/images/'));
});

gulp.task('init', ['setupBulma']);
gulp.task('build', ['reset','copy', 'compile-js', 'compile-css', 'copy-js', 'compile-sass', 'compile-scss', 'copy-images']);