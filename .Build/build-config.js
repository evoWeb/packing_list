const
  t3package = 'packing_list',
  paths = {
    src: './Sources',
    dest: '../Resources/Public'
  };

let tasks = {
  scss: {
    src: `${paths.src}/Scss/*.scss`,
    base: `${paths.src}/Scss/*.scss`,
    dest: `${paths.dest}/Stylesheets/`
  },
  copyVendorScss: {
    // Add path/file to include to css
    src: [
      './node_modules/materialize-css/sass/*.scss',
      './node_modules/materialize-css/sass/*/**.scss',
      './node_modules/materialize-css/sass/*/*/**.scss',
    ],
    dest: `${paths.src}/Scss/vendor/`
  },
  babel: {
    srcs: [
      `${paths.src}/JavaScript/*.es6`
    ],
    concat: 'app.js',
    dest: `${paths.dest}/JavaScript`
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
    src: `${paths.src}/Font/*.*`,
    dest: `${paths.dest}/Font`
  },
};

module.exports = {
  t3package,
  paths,
  tasks
};
