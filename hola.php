<?php

require 'header.php';

?>

<main>

<?php
if (isset($_SESSION['userUid'])){
	echo '<p class="login-status">YOU ARE LOGGED IN</p>';
}

else {
	echo '<p class="login-status">YOU ARE LOGGED OUT</p>';
}
?>

</main>

<?php 

require 'footer.php';

?>
