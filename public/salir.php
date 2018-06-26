<?php

session_start();

		unset($_SESSION["cedula"]); 
		unset($_SESSION["pass"]);
                unset($_SESSION['escala']);
                unset($_SESSION['tipo']);
                unset($_SESSION['idFarmacia']);

session_destroy();

		header('location: index.php');
		exit;