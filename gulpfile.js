/*var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();

gulp.task('browserSync', function(){
  browserSync.init({
    server: {
      baseDir: ''
    }
  })
});

gulp.task('sass', function(){
  return gulp.src('app/resources/scss/style.scss')
  .pipe(sass({
      includePaths: ['node_modules/susy/sass']
  }))
  .pipe(gulp.dest('app/resources/css'))
  .pipe(browserSync.reload({
    stream: true
  }))
});

gulp.task('watch', ['browserSync','sass'], function(){
  gulp.watch('app/resources/scss/style.scss',['sass']);
  gulp.watch('app/*.html',browserSync.reload);
  // En caso de tener JS en el código :
  //gulp.watch('app/resources/js/*.js',browserSync.reload);
});*/
var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');
var uglify = require('gulp-uglifyjs');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');

// Minify PNG, JPEG, GIF and SVG images
gulp.task('imagemin', function () {
    return gulp.src('./themes/custom/racctheme/img/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('./themes/custom/racctheme/img'));
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("./themes/custom/racctheme/scss/**/*.scss")
        .pipe(sass({
          includePaths: ['node_modules/susy/sass']
        }))
        .pipe(sourcemaps.init())
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest("./themes/custom/racctheme/css"))
        .pipe(browserSync.stream());
});

gulp.task('uglify', function() {
  gulp.src('./themes/custom/racctheme/lib/*.js')
    .pipe(uglify('main.js'))
    .pipe(gulp.dest('./themes/custom/racctheme/js'))
});

// Static Server + watching scss/html files
gulp.task('watch', ['sass', 'uglify'], function() {

    browserSync.init({
        //host: "localhost",
        //port: 8080
        proxy: "localhost:8080/racc-p"
        /*server: {
          baseDir: "./"
        }*/
    });

    gulp.watch("./themes/custom/racctheme/scss/**/*.scss", ['sass']);
    gulp.watch("./themes/custom/racctheme/css/*.css").on('change', browserSync.reload);
    gulp.watch("./themes/custom/racctheme/**/*.twig").on('change', browserSync.reload);
    gulp.watch("./themes/custom/racctheme/lib/*.js").on('change', browserSync.reload);
    gulp.watch("./themes/custom/racctheme/js/*.js").on('change', browserSync.reload);
});

gulp.task('default', ['watch']);
