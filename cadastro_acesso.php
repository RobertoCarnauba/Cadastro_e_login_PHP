<?php

	require_once('banco.php');

	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$usuario_existe = false;
	$email_existe = false;

	$objDb = new db();
	$link = $objDb->conecta_mysql();
    // //chek usuario
	 $sql = " select * from usertest where usuario = '$usuario'";
	 if($result_id = mysqli_query($link, $sql)){
       $dados = mysqli_fetch_array($result_id);
     	
	   if(isset($dados['usuario'])){
	 	  $usuario_existe = true;
	    }
	    } else {
	 	echo 'Erro ao tentar localizar registro';
	 }

	// //chek email
	 $sql = " select * from usertest where email = '$email'";
	 if($result_id = mysqli_query($link, $sql)){ 
	 $dados = mysqli_fetch_array($result_id);	
	    if(isset($dados['email'])){
	 	  $email_existe = true;
	       }
	     } else {
	 	echo 'Erro ao tentar localizar registro';
	 }
    // //check se user and email existe
	 if($usuario_existe  || $email_existe){
	 	 $retorno_get = '';

		 if($usuario_existe ){
	 		 $retorno_get.="erro_usuario=1&";
	 	 }

	 	 if($email_existe ){
	 		$retorno_get.="erro_email=1&";
	 	}

	 	header("Location: cadastro.php?".$retorno_get);
	 	die();
	 }


	

	 $sql = " insert into usertest(usuario, email, senha) values ('$usuario', '$email', '$senha') ";

	// //executar a query
	 if(mysqli_query($link, $sql)){
	 	header('Location:panel.php');
	 } else {
	 	echo 'Erro ao registrar o usuário!';
	 }


?>