<?php if($_SESSION['tipo']==1){    ?>
<div id='cssmenu'>
    <ul>
       <li><a href='./'><span>Inicio</span></a></li>          
       </li>
       <li class='has-sub'><a href='#'><span>Administradores</span></a>
           <ul>
               <li class='has-sub'><a href='./agregarAdm.php'><span>Agregar</span></a></li>
               <li class='has-sub'><a href='./listarAdm.php'><span>Listar</span></a></li>
          </ul>
       </li>
       <li class='has-sub'><a href='#'><span>Farmacias</span></a>
           <ul>
              <li class='has-sub'><a href='./agregarFar.php'><span>Agregar</span></a></li>
              <li class='has-sub'><a href='./listarFar.php'><span>Listar</span></a></li>
          </ul>
       </li>
       <li class='has-sub'><a href='#'><span>Configuraciones</span></a>
           <ul>
                 <li class='has-sub'><a href='./tiempoSesion.php'><span>Tiempo de sesión</span></a></li>
           </ul>
       </li>
       <li class='has-sub'><a href='#'><span>Back up</span></a>
           <ul>
                 <li class='has-sub'><a href='./paraExportar.php'><span>Exportar BD</span></a></li>
           </ul>
       </li>
       <li ><a href='./salir.php'><span>Salir</span></a></li>
    </ul>
</div>
<?php } ?>

<?php if($_SESSION['tipo']==2){    ?>
<div id='cssmenu'>
    <ul>
       <li><a href='./'><span>Inicio</span></a></li>
       <li class='has-sub'><a href="#"><span>Datos</span></a>
          <ul>
              <li class='has-sub'><a href='./tablaDatos.php'><span>Generales</span></a></li>
              <li class='has-sub'><a href='./gestionAlarmas.php'><span>Alarmas</span></a></li>
          </ul>
       </li>
       <li class='has-sub'><a href='#'><span>Gestión</span></a>
           <ul>
              <li class='has-sub'><a href='./regentes.php'><span>Regentes</span></a></li>
              <li class='has-sub'><a href='./administradores.php'><span>Administración</span></a></li>
              
          </ul>
       </li>
       <li class='has-sub'><a href='#'><span>Configuraciones</span></a>
           <ul>
                 <li class='has-sub'><a href='./escalas.php'><span>Escalas</span></a></li>
                 <li class='has-sub'><a href='./alarmas.php'><span>Alarmas</span></a></li>
                 <li class='has-sub'><a href='./tiempoSesion.php'><span>Tiempo de sesión</span></a></li>
           </ul>
       </li>
       <li ><a href='./salir.php'><span>Salir</span></a></li>
    </ul>
</div>
<?php } ?>


<?php if($_SESSION['tipo']==3){    ?>
<div id='cssmenu'>
    <ul>
       <li><a href='./'><span>Inicio</span></a></li>
       <li class='has-sub'><a href="#"><span>Datos</span></a>
          <ul>
              <li class='has-sub'><a href='./tablaDatos.php'><span>Generales</span></a></li>
              <li class='has-sub'><a href='./gestionAlarmas.php'><span>Alarmas</span></a></li>
          </ul>
       </li>
       
       <li class='has-sub'><a href='#'><span>Configuraciones</span></a>
           <ul>
                 <li class='has-sub'><a href='./tiempoSesion.php'><span>Tiempo de sesión</span></a></li>
           </ul>
       </li>
       <li ><a href='./salir.php'><span>Salir</span></a></li>
    </ul>
</div>
<?php } ?>