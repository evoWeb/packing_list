import {src, dest} from 'gulp';

const rename = require('gulp-rename');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cssnano = require('gulp-cssnano');
const changed = require('gulp-changed');
const browserSync = require('browser-sync').create();

const { tasks } = require('../../build-config');

/*
* @Desc     copy vendor css files from node_modules to src,
*           to import in main.scss
* */
let copyVendorCss = () => {
  if (tasks.copyVendorCss) {
    return src(tasks.copyVendorCss.src)
      .pipe(rename({prefix: '_', extname: '.scss'}))
      .pipe(dest(tasks.copyVendorCss.dest));
  }

  if (tasks.copyVendorScss) {
    return src(tasks.copyVendorScss.src)
      .pipe(rename({prefix: '', extname: '.scss'}))
      .pipe(dest(tasks.copyVendorScss.dest));
  }
}

/*
* @Desc     converts scss to css and copy to public
* @Series   copyVendorCss {function}
* */
let scss = () => {
  return src(tasks.scss.src)
    .pipe(changed(tasks.scss.src))
    .pipe(sass({
        includePaths: require('node-normalize-scss').includePaths
      }
    ))
    .pipe(autoprefixer({
      overrideBrowserslist: ['last 2 versions'],
      cascade: false
    }))
    .pipe(rename({
      extname: '.min.css'
    }))
    .pipe(cssnano())
    .pipe(dest(tasks.scss.dest))
    .pipe(browserSync.stream());
}

module.exports = { copyVendorCss, scss };
