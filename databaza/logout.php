<?php
session_start();
session_unset();
session_destroy();
header('Location: /UEB24_Gr36/faqja_kryesore/index1.php');
exit;
?>