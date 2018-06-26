<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 
require_once "../controlador/tHActualC.php"; 
require_once "../controlador/mDatosC.php"; 
require_once '../controlador/tiempoSesionC.php';
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        
        <link href="css/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.date.css" rel="stylesheet" type="text/css" />
        
        <script src="libs/amcharts/amcharts.js"></script>
        <script src="libs/amcharts/serial.js"></script>
        <script src="libs/amcharts/themes/light.js"></script>
        
        
        <script src="js/ajaxAsincrono.js"></script> 
        <script src="js/datosInicio.js"></script> 
        
    </head>
    <body>
        <div id="contenedor">
                       
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

            <?php if($infoUsuario["tipoUsuario"]!=1){?>             
            <div id="contenedorSup">
                <div id="asincronos"></div>
            </div>            
            <?php }?>
            
            <div id="contenedorInf"> 
                
                <center><div class="titulo1">Política de privacidad</div></center><br />
                
                Este sitio Web es de propiedad y está operado por TERMOX, y se denominará en lo sucesivo como "Nosotros", "nuestro" y "nosotros" en esta Política de Privacidad de Internet. Al usar este sitio, usted está de acuerdo con la Política de Privacidad de Internet de este sitio Web ( "el sitio Web"), que figura en esta página Web. La Política de Privacidad de Internet se refiere a la recopilación y uso de información personal que usted pueda suministrarnos a través de su conducta en el sitio Web.<br><br>

Nos reservamos el derecho, a nuestra discreción, de modificar o eliminar partes de esta Política de Privacidad de Internet en cualquier momento. Esta Política de Privacidad de Internet es en adición a cualquiera de los otros términos y condiciones aplicables al sitio Web. No hacemos ninguna representación acerca de sitios Web de terceros que pueden estar enlazados con el sitio Web.<br><br>

Reconocemos la importancia de proteger la privacidad de la información recopilada sobre los visitantes de nuestro sitio Web, en particular la información que es capaz de identificar a un individuo ( "información personal"). Esta Política de Privacidad de Internet regula la forma en que su información personal, obtenida a través del sitio Web, será tratada. Esta Política de Privacidad de Internet debe ser revisada periódicamente a fin de que usted este actualizado con los cambios. Agradecemos sus comentarios y opiniones.<br><br>

<b>Propiedad de la Información de la Compañía</b><br>
La información relacionada a TERMOX.xyz y sus servicios, incluidos los horarios de vuelos, rutas, texto, gráficas, iconos, descargas digitales, compilaciones de datos y logotipos que se denomina como "Información de la Compañía." Innovata es propietario de todos los derechos de autor, marcas comerciales, marcas de servicio, nombres comerciales relacionados con la Información de la Compañía, y la Información de la Compañía son propiedad de Innovata.<br><br>

<b>Limitaciones de Uso</b><br>
Usted no puede copiar, derivar, editar, traducir, descompilar, realizar ingeniería inversa, modificar, usar, o reproducir cualquier código o fuente de código relativo al sitio web TERMOX. Usted no puede utilizar ningún enlace profundo, raspar la página, robot, rastrear, indexar, araña, hacer click en el spam, los programas de macro, agente de Internet, o dispositivo automático, programa, algoritmo o metodología que hace las mismas cosas para el uso, acceso, copia , Obtener información, generar impresiones o clicks, entrar información, almacenar información, búsqueda, generar las búsquedas, o controlar cualquier parte del sitio web TERMOX.<br><br>

<b>Información Personal</b><br>
La información personal sobre los visitantes de nuestro sitio sólo se recoge cuando a sabiendas y voluntariamente es presentada. Por ejemplo, es posible que tengamos que recoger esta información para que usted pueda recibir más servicios o para responder o reenviar cualquier solicitud o más información.<br><br>

<b>Uso de la Información</b><br>
La información personal que presenten los visitantes a nuestro sitio se utiliza únicamente para la finalidad para la que se presenta o para los demás efectos secundarios que están relacionados con el objetivo principal, a menos que revelemos otros usos en esta Política de Privacidad de Internet o en el momento de la colección. Copias de la correspondencia enviada desde el sitio Web, que pueden contener información personal, se guardan como archivos para el mantenimiento de registros y copias de seguridad únicamente.<br><br>

<b>Divulgación</b><br>
Aparte de donde usted ha consentido y divulgado es necesario alcanzar el fin para el cual fue presentado, la información personal puede ser revelada en situaciones especiales cuando tenemos razones para creer que ello es necesario para identificar, contactar o tomar acción legal en contra de cualquier persona que dañe, perjudique, o interfiera (intencionalmente o no) con nuestros derechos o propiedad, los usuarios, o cualquier otra persona que podría ser perjudicada por dichas actividades. Además, podemos divulgar información personal cuando creemos de buena fe que la ley exige dicha divulgación. Nosotros podemos hacer participes a terceros para que le proporcionen productos o servicios en nuestro nombre. En esa circunstancia, podemos divulgar su información personal a los terceros a fin de satisfacer su solicitud de productos o servicios.<br><br>

<b>Seguridad</b><br>
Nos esforzamos para garantizar la seguridad, integridad y privacidad de la información personal enviada a nuestros sitios, y nosotros revisamos y actualizamos nuestras medidas de seguridad a la luz de las tecnologías actuales. Desafortunadamente, ninguna transmisión de datos a través de Internet puede ser garantizada  como totalmente segura. Sin embargo, nos esforzaremos por adoptar todas las medidas razonables para proteger la información personal que usted pueda transmitirnos o de nuestros productos y servicios en línea. Una vez que recibimos su transmisión, también vamos a hacer nuestros mejores esfuerzos para garantizar su seguridad en nuestros sistemas. Además, nuestros empleados y los contratistas que proporcionan servicios relacionados con nuestros sistemas de información están obligados a respetar la confidencialidad de cualquier información personal en poder nuestro. Sin embargo, no nos haremos responsable por los acontecimientos derivados del acceso no autorizado a su información personal.<br><br>

<b>Cookies</b><br>
Las Cookies son datos que un sitio Web transfiere al disco duro de un individuo para el mantenimiento de registros. Las Cookies, que son estándar en la industria y son utilizados por la mayoría de los sitios Web, incluyendo los utilizados por nosotros, pueden facilitar al usuario el acceso continuo y el uso de un sitio. Ellos nos permiten personalizar el sitio Web a sus necesidades. Si no quiere que la información sea recogida mediante el uso de cookies, hay un procedimiento simple en la mayoría de los navegadores que le permite negar o aceptar la característica cookie. Pero usted debe tener en cuenta que las cookies pueden ser necesarias para proveerlo a usted con algunas características de nuestros servicios en línea<br><br>

<b>Acceso a la Información</b><br>
Nos esforzaremos por adoptar todas las medidas razonables para mantener segura la información que tenemos acerca de usted, y para mantener esta información exacta y actualizada. Si, en cualquier momento, usted descubre que las información que poseemos sobre usted es incorrecta, puede ponerse en contacto con nosotros para corregir dicha información.  Además, nuestros empleados y los contratistas que proporcionan servicios relacionados con nuestros sistemas de información están obligados a respetar la confidencialidad de cualquier información personal en nuestro poder.<br><br>

<b>Enlaces a otros sitios</b><br>
Ofrecemos enlaces a sitios Web fuera de nuestros sitios Web, así como a sitios Web de terceros. Estos sitios enlazados no están bajo nuestro control, y no podemos aceptar responsabilidad por la conducta de las empresas vinculadas a nuestra página Web. Antes de revelar su información personal en cualquier otro sitio Web, le sugerimos examinar los términos y condiciones de uso de dicho sitio Web y su declaración de privacidad.<br><br>

<b>Problemas o Preguntas</b><br>
Si llegamos a darnos cuenta de cualquier preocupación o problema con nuestros sitios Web, tomaremos en serio estos asuntos y trabajaremos para hacer frente a sus inquietudes. Si tiene alguna pregunta respecto a nuestra política de privacidad, o usted tiene un problema o queja, por favor póngase en contacto con nosotros en info@termox.xyz.<br><br>
                

            </div>


            <?php include './plantilla/pie.php'; ?>
            
        </div>
            <?php include './plantilla/analytics.php'; ?>
    </body>
    
</html>

<?php 

} else{
    
    echo "Usted no tiene acceso a esta zona";
    
} 
?>