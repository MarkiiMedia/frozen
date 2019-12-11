<?php

//Opret forbindelse
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


//Tjekker forbindelse
if(mysqli_connect_errno()) {
	echo 'Failed to connect to MySql'. mysqli_connect_errno();
}

