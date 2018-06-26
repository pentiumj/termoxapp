<?php

    require_once '../controlador/validarUsuarioC.php';
    require_once '../controlador/listarDatosC.php';
    
    
    
    if($_POST){
        
        if( isset($_POST['cedula']) 
            && isset($_POST['pass']) 
            && !empty($_POST['cedula'])
            && !empty($_POST['pass'])
            && is_numeric($_POST['cedula'])
           ){

            $url = "inicio.php";
            $cedula = $_POST['cedula'];
            $pass = $_POST['pass'];

            $usuario = mostrarDatosTabla($cedula, $pass);
            $usuarioA = consultarUsuarioAdmin($cedula, $pass);

            if($usuario != 0){
                $datos = listarDatosF();
                $escala = $datos[0][3];
    
                if($escala == 0){
                    $_SESSION['escala'] = "c";
                }else{
                    $_SESSION['escala'] = "f";
                }
                
                $_SESSION['cedula'] = $cedula;
                $_SESSION['pass'] = $pass;
                $_SESSION['tipo'] = $usuario[0]['tipoUsuario'];
                $_SESSION['idFarmacia'] = $usuario[0]['idFarmacia'];
                //print_r($usuario);
                header('Location: '.$url);
                
            }
            else if($usuarioA != 0){
                $_SESSION['cedula'] = $cedula;
                $_SESSION['pass'] = $pass;
                $_SESSION['tipo'] = $usuarioA[0]['tipoUsuario'];
                $_SESSION['idFarmacia'] = 1;
                header('Location: '.$url);
            }{?>
                <script>alert('Datos incorrectos');
                location = "./";</script>
                <?php
                
            }

        }
        else{
            if(!is_numeric($_POST['cedula'])){
               echo "<script>alert('Datos incorectos');location = './';</script>";
            }else{
               echo "<script>alert('Llene todos los campos');location = './';</script>";
            }
             
        }
    }