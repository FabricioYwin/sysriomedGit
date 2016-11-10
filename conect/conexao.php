<?php

try{
	$conPDO = new PDO("sqlsrv:Server=NTB-01\SQLEXPRESS;Database=medx", "sa", "adma7vek7");
}catch(PDOException $e){
	echo "Falha de Conexão<br>";	
	echo "Erro: "; echo $e->getMessage()."<br>";
	echo "Por favor, entre em contato com o Administrador do Sistema.";
}


