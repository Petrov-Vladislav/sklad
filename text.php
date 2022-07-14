<?php
	$mysqli = new mysqli("localhost", "hostvlad_sklad", "", "hostvlad_sklad");
	if (mysqli_connect_errno()) {
        echo "Подключение к серверу невозможно. Причина: ".mysqli_connect_error();
        exit;
    }
	$result_set = $mysqli->query("SELECT * FROM text");
    while($row = $result_set->fetch_assoc()) {
        print_r($row);
        echo "<br>";
    }
	
	$mysqli->close()
?>