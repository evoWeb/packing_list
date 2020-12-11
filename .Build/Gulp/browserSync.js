const browserSync = require('browser-sync').create();
const { paths } = require('../build-config');
/*
* @Desc     Init BorwserSync with UI
* */
let browserSyncInit = () => {
  browserSync.init({
    injectChanges: true,
    server: {
      baseDir: paths.dest
    },
    open: false
  });
};

/*
* @Desc     Reload BorwserSync on change @watch-task
* */
let browserSyncReload = () => {
  browserSync.reload();
}

module.exports = { browserSyncInit, browserSyncReload };
