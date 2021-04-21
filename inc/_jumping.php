<?php
//átirányítás oldalra - 2 paraméter (hova, mennyi idő múlva)
	function jumping($where,$when) {
		print '
		<script>
			setTimeout("window.location.href='."'$where'".'",'.$when.');
		</script>
		';
	}
?>