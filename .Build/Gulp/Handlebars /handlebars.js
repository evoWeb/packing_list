let {
  src,
  dest,
} = require('gulp');

const path = require('path');

const rename = require('gulp-rename');
const handlebars = require('gulp-compile-handlebars');
const browserSync = require('browser-sync').create();

const { paths, tasks } = require('../../config');

/*
* @Desc     Compiles .hbs to .html and copy to public
* */
let hbs = () => {
  return src(tasks.handlebars.src)
    .pipe(handlebars(tasks.handlebars.data, tasks.handlebars.options))
    .pipe(rename(tasks.handlebars.rename))
    .pipe(dest(paths.dest))
    .pipe(browserSync.stream());
};

module.exports = hbs;
