<?php
// Cilësimet për log-un
define('LOG_DIR', 'logs/');

// Sigurohu që direktoria logs ekziston dhe ka leje shkrimi
if (!file_exists(LOG_DIR)) {
    mkdir(LOG_DIR, 0755, true);
}

// Kontrollo dhe vendos lejet e direktorisë
if (!is_writable(LOG_DIR)) {
    chmod(LOG_DIR, 0755);
}
?>