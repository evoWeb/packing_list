let {
  src,
  dest
} = require('gulp');

const babel = require('gulp-babel');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();

const { tasks } = require('../../build-config');

/*
* @Desc   Compiles all .es6 files to js and copy to public
* @Src   \/hbs\/**\/*.es6
* @Src   \/js\/**\/*.es6
* */
let compileES = () => {
  return src(tasks.babel.srcs)
    .pipe(babel({
      compact: false,
      presets: [
        [
          "@babel/preset-env",
          {
            "useBuiltIns": "entry",
            "corejs": 3,
          }
        ]
      ],
      plugins: [
        '@babel/plugin-proposal-class-properties'
      ]
    }))
    .pipe(concat(tasks.babel.concat))
    .pipe(dest(tasks.babel.dest))
    .pipe(browserSync.stream());
};

module.exports = compileES;
