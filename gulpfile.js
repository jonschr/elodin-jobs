// Define globalThis if it's not defined
if (typeof globalThis === 'undefined') {
    // This works in all modern browsers, but not in older ones:
    // globalThis = window || self || this;

    // This works in all environments, including older browsers and Node.js:
    var getGlobal = function () {
        // Safely retrieve the global object in any environment
        if (typeof self !== 'undefined') {
            return self;
        }
        if (typeof window !== 'undefined') {
            return window;
        }
        if (typeof global !== 'undefined') {
            return global;
        }
        // If all else fails, create a new global object:
        return Function('return this')();
    };
    globalThis = getGlobal();
}

//* Vars
var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var sourcemaps = require('gulp-sourcemaps');
var sassGlob = require('gulp-sass-glob');

//* Tasks
gulp.task('style', function () {
    return gulp
        .src('css/elodin-jobs.scss')
        .pipe(sassGlob())
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('css/'));
});

//* Watchers here
gulp.task('watch', function () {
    gulp.watch('css/**/*.scss', gulp.series(['style']));
});

gulp.task('default', gulp.series(['watch']));
