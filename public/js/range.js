
$(document).ready(function(){$("#two-inputs").hide();$("#opciones").hide();$("#btn-rep").hide();$("#two-inputs").dateRangePicker({separator:" hasta ",getValue:function(){if($("#inicio").val()&&$("#fin").val()){return $("#inicio").val()+" hasta "+$("#fin").val()}else{return""}},setValue:function(e,d,c){$("#inicio").val(d);inicio=d;$("#fin").val(c);fin=c;var f=$("#opciones").val();if(f==1){a()}else{b()}$("#btn-rep").show()}});$("#pre-opciones").change(function(){$("#two-inputs").show();$("#pre-opciones").hide();indice=$("#pre-opciones").val();$("#opciones")[0].selectedIndex=indice;$("#opciones").show()});$("#opciones").change(function(){$("#two-inputs").click()});function a(){$.ajax({data:$("#frmFecha").serialize(),url:"generarGraficosTemp.php",type:"post",beforeSend:function(){$("#ver").html("Enviando, espere por favor...")},success:function(c){$("#ver").html(c)}})}function b(){$.ajax({data:$("#frmFecha").serialize(),url:"generarGraficosHume.php",type:"post",beforeSend:function(){$("#ver").html("Enviando, espere por favor...")},success:function(c){$("#ver").html(c)}})}});