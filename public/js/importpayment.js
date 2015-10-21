$(function(){
    $('#upthree').click(function(){

        var comprobar = $('#csvthree').val().length;                

        if(comprobar > 0){
            var formulario = $('#subidatres');
            var archivos = new FormData();
            var url = csvthree;
            console.log("existe archivo");
            console.log("envio a la url");

            for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 
                archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));
            }
            console.log("valido el form");
            
            $.ajax({                
                url: url,
                type: 'POST',
                contentType: false, 
                data: archivos,
                processData:false,
                beforeSend : function (){
                    $('#respuestatres').html('<label style="padding-top:10px; color:blue;">Cargando...</label>');
                    console.log("cargando archivo");
                },
                success: function(data){                   
                    if(data.length > 0){
                        $('#respuestatres').html('<label style="padding-top:10px; color:green;">'+ data +'</label>');	
                        $('#subidatres')[0].reset();
                        return false;
                        console.log("importo");
                    }
                },
                error: function (data) {                    
                    var status = JSON.parse(data.responseText);
                    $('#respuestatres').html('<label style="padding-top:10px; color:red;">'+ status +'</label>');
                    return false;
                    console.log("no importo");
                }
             });    
        }
        else         
        {            
            $('#respuestatres').html('<label style="padding-top:10px; color:red;">Selecciona un archivo CSV para importar.</label>');
            return false;
        }
    });
    
    return false;
});
