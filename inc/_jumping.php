<?php
	function jumping($where,$when) {
		print '
		<script>
			setTimeout("window.location.href='."'$where'".'",'.$when.');
		</script>
		';
	}
?>