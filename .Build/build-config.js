const
  t3package = 'packing_list',
  paths = {
    src: './Sources',
    dest: '../Resources/Public'
  };

let tasks = {
  scss: {
    src: `${paths.src}/Scss/*.scss`,
    base: `${paths.src}/Scss`,
    dest: `${paths.dest}/Stylesheets`
  },
  copyVendorScss: {
    // Add path/file to include to css
    src: [
      './node_modules/materialize-css/sass/*.scss',
      './node_modules/materialize-css/sass/*/**.scss',
      './node_modules/materialize-css/sass/*/*/**.scss',
    ],
    dest: `${paths.src}/Scss/vendor`
  },
  babel: {
    src: `${paths.src}/TypeScript/packing_list.ts`,
    dest: `${paths.dest}/JavaScript`,
    source: 'packing_list.js'
  },
  bundle: {
    // Add path/file to include to bundle
    srcs: [
      './node_modules/materialize-css/dist/js/materialize.min.js',
    ],
    concat: 'bundle.js',
    dest: `${paths.dest}/JavaScript`
  },
  image: {
    src: `${paths.src}/Images/**/*`,
    dest: `${paths.dest}/Images`
  },
  font: {
    src: [
      './node_modules/material-design-icons-iconfont/dist/fonts/MaterialIcons-Regular.eot',
      './node_modules/material-design-icons-iconfont/dist/fonts/MaterialIcons-Regular.ttf',
      './node_modules/material-design-icons-iconfont/dist/fonts/MaterialIcons-Regular.woff',
      './node_modules/material-design-icons-iconfont/dist/fonts/MaterialIcons-Regular.woff2',
    ],
    dest: `${paths.dest}/Fonts`
  },
};

module.exports = {
  t3package,
  paths,
  tasks
};
