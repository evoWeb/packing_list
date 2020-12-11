import {src, dest} from 'gulp';

import sourcemaps from 'gulp-sourcemaps';
import rename from 'gulp-rename';
import sass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import cssnano from 'gulp-cssnano';
import changed from 'gulp-changed';
import browserSync from 'browser-sync';

const { tasks } = require('../../build-config');

browserSync.create();

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
    .pipe(sourcemaps.init())
    .pipe(changed(tasks.scss.dest))
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
    .pipe(sourcemaps.write('./'))
    .pipe(dest(tasks.scss.dest))
    .pipe(browserSync.stream());
}

module.exports = { copyVendorCss, scss };
