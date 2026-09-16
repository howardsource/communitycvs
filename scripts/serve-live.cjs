const { execFile } = require('child_process');
const browserSync = require('browser-sync');
const config = require('../browser-sync.config.cjs');

const bs = browserSync.create();
const effectiveConfig = {
  ...config,
  open: false
};

function getLocalUrl(instance) {
  if (!instance || !instance.options || typeof instance.options.getIn !== 'function') {
    return null;
  }

  return instance.options.getIn(['urls', 'local']);
}

function openBrowser(url) {
  if (!url) {
    return;
  }

  console.log(`[workspace] Opening browser: ${url}`);
  execFile('open', [String(url)], (error) => {
    if (error) {
      console.error(`[workspace] Failed to open browser automatically: ${error.message}`);
    }
  });
}

bs.init(effectiveConfig, (error, instance) => {
  if (error) {
    console.error(error);
    process.exit(1);
  }

  if (config.open !== false) {
    setTimeout(() => openBrowser(getLocalUrl(instance)), 300);
  }
});

function shutdown() {
  bs.exit();
  process.exit(0);
}

process.on('SIGINT', shutdown);
process.on('SIGTERM', shutdown);
