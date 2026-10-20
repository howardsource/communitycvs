const fs = require('fs');
const path = require('path');

const configPath = path.join(__dirname, 'workspace.config.json');
const defaults = {
  proxy: 'http://localhost',
  port: 3000,
  uiPort: 3001,
  open: true
};

let config = { ...defaults };

if (fs.existsSync(configPath)) {
  config = {
    ...config,
    ...JSON.parse(fs.readFileSync(configPath, 'utf8'))
  };
}

module.exports = {
  proxy: process.env.BROWSER_SYNC_PROXY || config.proxy,
  port: Number(process.env.BROWSER_SYNC_PORT || config.port),
  ui: {
    port: Number(process.env.BROWSER_SYNC_UI_PORT || config.uiPort)
  },
  open: process.env.BROWSER_SYNC_OPEN
    ? process.env.BROWSER_SYNC_OPEN === 'true'
    : config.open,
  notify: false,
  ghostMode: false,
  injectChanges: true,
  reloadDelay: 0,
  files: [
    'wp-content/themes/communitycvs/css/**/*.css',
    'wp-content/themes/lacvs/css/**/*.css',
    'wp-content/themes/communitycvs/**/*.php',
    'wp-content/themes/lacvs/**/*.php',
    'wp-content/themes/communitycvs/js/**/*.js'
  ],
  snippetOptions: {
    ignorePaths: [
      '/wp-admin/**',
      '/wp-login.php'
    ]
  }
};
