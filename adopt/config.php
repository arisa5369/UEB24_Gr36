<?php
// Cilësimet për log-un
define('LOG_DIR', 'logs/');

// Sigurohu që direktoria logs ekziston
if (!file_exists(LOG_DIR)) {
    mkdir(LOG_DIR, 0755, true);
}
?>