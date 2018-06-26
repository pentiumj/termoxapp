var timestamp = null;
function tiempo_real() { 
    $.ajax({
        async: true, 
        type: "POST",
        url: "datosAsincronos.php",
        data: "&timestamp="+timestamp,
        dataType:"html",
        success: function(data){
            
            var json = data;
            timestamp = json.fecha;
            
            if(timestamp === null){
                alert("es null");
            }
            
            $('#asincronos').html(data);
            setTimeout('tiempo_real()',1000);
        }
    });  
}

$(document).ready(function(){
    tiempo_real();
 
});  