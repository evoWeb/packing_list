let {
  src,
  dest
} = require('gulp');

const { t3package } = require('../../config');

let copyToSitePackage = (done) => {
  src([
    './public/Css/*',
    './public/Font/**/*',
    './public/Images/**/*',
    './public/Videos/**/*',
    './public/JavaScript/*'
  ], {
    base: './public'
  })
    .pipe(dest('../../packages/' + t3package + '/Resources/Public/'));

  done();
};

module.exports = copyToSitePackage;
