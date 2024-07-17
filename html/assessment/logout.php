<!-- Logout from Admin Portal -->

<?php

session_start();

session_destroy();

header('Location: admin.php');

exit;

?>
