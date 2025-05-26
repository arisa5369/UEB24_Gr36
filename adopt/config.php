<?php

define('LOG_DIR', 'logs/');

if (!file_exists(LOG_DIR)) {
    mkdir(LOG_DIR, 0755, true);
}

if (!is_writable(LOG_DIR)) {
    chmod(LOG_DIR, 0755);
}
?>