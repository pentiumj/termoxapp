<?php
    session_start();

    require_once '../controlador/datosAsincronosC.php';
    require_once '../controlador/listarDatosC.php';
    require_once '../controlador/validarUsuarioC.php';
    require_once '../controlador/horaEnvioC.php';
    
    set_time_limit(0); //Establece el número de segundos que se permite la ejecución de un script.
    $fecha_ac = isset($_POST['timestamp']) ? $_POST['timestamp']:0;

    $resultadoFnA = fnAsincrona($fecha_ac, $_SESSION['idFarmacia']);
    $temp = $resultadoFnA[0];
    $hume = $resultadoFnA[1];
    $grados = "°C";
    $predefT = $datos[0][1];
    $predefH = $datos[0][2];
    $predefHMin = $datos[0][3];
    $alertaT = 0;
    $alertaH = 0;
    $ban = 0;
    if(count($resultadoFnA) != 0){
        if(isset($_SESSION['escala'])){

            if($_SESSION['escala']=='f'){
                $temp = round($temp*(9/5)+32,2); 
                $predefT = round($datos[0][1]*(9/5)+32,2);
                $grados = "°F";
            }

        }

        print "Temperatura actual: <font color='red'>".$temp.$grados."</font></br>Humedad relativa actual: <font color='red'>".$hume."%</font>";
        if($temp >= $predefT){
            echo "<br/><font color='red'>Alerta, temperatura demasiado elevada</font>";
            $alertaT = 1;
        }
        if($hume >= $predefH){
            echo "<br/><font color='red'>Alerta, humedad demasiado elevada</font>";
            $alertaH = 1;
        }
        if($hume < $predefHMin){
            echo "<br/><font color='red'>Alerta, humedad demasiado baja</font>";
            $alertaH = 1;
        }


        $usuario = mostrarDatosTabla($_SESSION['cedula'], $_SESSION['pass']);
        //print_r($usuario);



       if(($alertaT == 1 || $alertaH == 1) && $ban == 0 && ($envio == NULL OR $fechaHora >= $envio ) ){

            $nombre=$usuario[0]['nombre']." ".$usuario[0]['apellido'];    
            $IP = $_SERVER['REMOTE_ADDR'];    
            $tipo="Content-type: text/html\r\n"; 
            $correo="contacto@losprogramasgratis.net";    
            $sitio="TERMOX";    
            $sheader="From: ".$nombre."<".$correo."> \nReply-To:".$correo."\n";     
            $sheader=$sheader."Content-Type: text/html";    
            $mi_mail=$usuario[0]['email'];    
            $asunto="ALERTA EN FARMACIA";    
            $mensaje="<p>Señor $nombre, se ha presentado una alerta en su farmacia con los siguientes datos: </p>"
                    . "<p>IP equipo: $IP </br>    "
                    . "<p>-------------------------------------------------------------------</p>    ";
            if($alertaT == 1) $mensaje .= "<p>Alerta de temperatura: ". $temp . $grados . "</p>"; 
            if($alertaH == 1) $mensaje .= "<p>Alerta de humedad: ". $hume . "%</p>"; 
            $mensaje .= "<p>-------------------------------------------------------------------</p>";    
            mail($mi_mail,$asunto,$mensaje, $sheader);
            $ban = 1;

            actualizarFH();

        }
    }else{
        echo "<br><font color='red'>No hay un dispositivo conectado</font><br><br>";
    }
    