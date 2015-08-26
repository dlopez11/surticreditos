$(function(){
    $('#upone').click(function(){
        
        var update = 0;
        
        if($("#update").is(':checked')) {  
            update = 1;
        }
        
        var comprobar = $('#csvone').val().length;

        if(comprobar > 0){
            var formulario = $('#subida');
            var archivos = new FormData(formulario[0]);

//            for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 
//                console.log(i);
//                archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));
//            }
            
            $.ajax({                
                url: csvone,
                type: 'POST',
                contentType: false, 
                data: archivos,
                processData:false,
                beforeSend : function (){
                    $('#respuesta').html('<label style="padding-top:10px; color:blue;">Cargando...</label>');
                },
                success: function(data){                   
                    if(data.length > 0){
                        $('#respuesta').html('<label style="padding-top:10px; color:green;">'+ data +'</label>');	
                        $('#subida')[0].reset();
                        return false;
                    }
                },
                error: function (data) {                    
                    var status = JSON.parse(data.responseText);
                    $('#respuesta').html('<label style="padding-top:10px; color:red;">'+ status +'</label>');
                    return false;
                }
    });    
        }
        else {          
            $('#respuesta').html('<label style="padding-top:10px; color:red;">Selecciona un archivo CSV para importar.</label>');
//            alert('Selecciona un archivo CSV para importar.');
            return false;
        }
    });
    
    return false;
});
