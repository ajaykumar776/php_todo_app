<?php
require("config.php");
$query = "delete from tasks where id = $_GET[id]";
$query_run = mysqli_query($con,$query);
?>
<script type="text/javascript">
	alert("Task Deleted.....");
	window.location.href = "index1.php";
</script>