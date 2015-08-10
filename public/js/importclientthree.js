$(function(){
    $('#upthree').click(function(){

        var comprobar = $('#csvthree').val().length;

        if(comprobar > 0){
            var formulario = $('#subidatres');
            var archivos = new FormData();
            var url = csvthree;

            for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 
                archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));
            }
            $.ajax({                
                url: url,
                type: 'POST',
                contentType: false, 
                data: archivos,
                processData:false,
                beforeSend : function (){
                    $('#respuestatres').html('<label style="padding-top:10px; color:blue;">Cargando...</label>');
                },
                success: function(data){                   
                    if(data.length > 0){
                        $('#respuestatres').html('<label style="padding-top:10px; color:green;">'+ data +'</label>');	
                        $('#subidatres')[0].reset();
                        return false;
                    }
                },
                error: function (data) {                    
                    var status = JSON.parse(data.responseText);
                    $('#respuestatres').html('<label style="padding-top:10px; color:red;">'+ status +'</label>');
                    return false;
                }
    });    
        }
        else         
        {            
            alert('Selecciona un archivo CSV para importar.');
            return false;
        }
    });
    
    return false;
});
