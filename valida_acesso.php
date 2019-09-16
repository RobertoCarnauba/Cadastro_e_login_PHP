<?php

    session_start();

	require_once('banco.php');

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	//echo $usuario."-".$senha;

	 $sql = " SELECT id,usuario,email FROM usertest WHERE usuario = '$usuario' AND senha = '$senha' ";
	 //echo $sql;

	 $objDb = new db();
	 $link = $objDb->conecta_mysql();

	 $resultado_id = mysqli_query($link, $sql);

	 if($resultado_id){    
		 $dados_usuario = mysqli_fetch_array($resultado_id);
	 	if(isset($dados_usuario['usuario'])){
			 echo 'usuario existe';
	 		$_SESSION['id_usuario'] = $dados_usuario['id'];
	 		$_SESSION['usuario'] = $dados_usuario['usuario'];
		    $_SESSION['email'] = $dados_usuario['email'];

	 		 header('Location:panel.php');	
		   } else {
			header('Location: login.php');
		   }
	    } else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
	 }


	


?>