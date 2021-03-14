<?php
include("config2.php");
echo br_us($_GET['data']);	
?>
<HTML>
<form action="?" method="GET">
	<input type="date" name="data">Data<br>
	<input type="submit" value="salvar">
</form>

</HTML>