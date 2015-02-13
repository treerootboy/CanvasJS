process.env.DISABLE_NOTIFIER = true;
var gulp = require('gulp');
var phpunit = require('gulp-phpunit');
 
gulp.task('phpunit', function() {
    gulp.src('phpunit.xml').pipe(phpunit());
});

gulp.task('default', ['phpunit']);
