'use strict';

import {parallel, series, watch} from 'gulp';
import bundle from './Gulp/JavaScript/bundle-js';
import babel from './Gulp/JavaScript/babel-ts';
import {browserSyncInit, browserSyncReload} from './Gulp/browserSync';
import {copyVendorCss, scss} from './Gulp/Css/css';
import {image, font} from './Gulp/Copy/assets';

let watchFiles = () => {
  watch([
    './src/scss/**/*',
    './src/hbs/**/*.scss'
  ], scss).on('change', browserSyncReload);
  watch('./src/**/*.es6', bundle).on('change', browserSyncReload);
};

exports.bundle = parallel(bundle);
exports.babel = parallel(babel);
exports.js = series(bundle, babel);
exports.css = series(copyVendorCss, scss);
exports.assets = parallel(image, font);
exports.default = series(
  exports.assets,
  exports.css,
  exports.js
);
exports.watch = series(
  exports.assets,
  exports.css,
  exports.js,
  parallel(watchFiles, browserSyncInit)
);
