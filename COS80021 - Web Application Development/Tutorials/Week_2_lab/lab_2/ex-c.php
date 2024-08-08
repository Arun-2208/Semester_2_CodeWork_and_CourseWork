<html>
<?php
$i=10;
while ($i>0) {
	if ($i == 8) {
		$i--;
		continue;
	}
	if ($i == 5)
		break;
		
	echo $i--; // then change this line to 'recho --$i'
	echo "<br>";
}

?>
</html>
		