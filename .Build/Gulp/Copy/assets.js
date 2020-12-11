let {
  src,
  dest
} = require('gulp');

const { tasks } = require('../../build-config');

/*
* @Desc     Copy images to public
* */
let image = () => {
  return src(tasks.image.src)
    .pipe(dest(tasks.image.dest));
};

/*
* @Desc     Copy fonts to public
* */
let font = () => {
  return src(tasks.font.src)
    .pipe(dest(tasks.font.dest));
};

module.exports = {
  image,
  font
};
