import {dest} from 'gulp';

import sourcemaps from 'gulp-sourcemaps';
import browserify from 'browserify';
import source from 'vinyl-source-stream';
import buffer from 'vinyl-buffer';
import tsify from 'tsify';
import terser from 'gulp-terser';
import rename from 'gulp-rename';
import browserSync from 'browser-sync';

import {tasks} from '../../build-config';

const browser = browserSync.create();

/*
* @Desc  Compiles all .ts files to js and copy to public
* @Src   \/TypeScript\/*.ts
* */
let compileTypescript = () => {
  return browserify(tasks.babel.src, {debug: true})
    .on('error', console.log)
    .plugin(tsify)
    .bundle()
    .pipe(source(tasks.babel.source))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps: true}))
    // This will output the non-minified version
    .pipe(dest(tasks.babel.dest))
    // Add transformation tasks to the pipeline here.
    .pipe(rename({extname: '.min.js'}))
    .pipe(terser())
    .pipe(sourcemaps.write('./', {
      mapFile: function (mapFilePath) {
        // source map files are named *.map instead of *.js.map
        return mapFilePath.replace('.min.js.map', '.js.map');
      }
    }))
    .pipe(dest(tasks.babel.dest))
    .pipe(browser.stream());
};

module.exports = compileTypescript;
