let {
  src,
  dest
} = require('gulp');

const concat = require('gulp-concat');

const { tasks } = require('../../build-config');

/*
* @Desc     bundles JavaScript files and copy to public
* */
let bundle = () => {
  return src(tasks.bundle.srcs)
    .pipe(concat(tasks.bundle.concat))
    .pipe(dest(tasks.bundle.dest));
};

module.exports = bundle;
