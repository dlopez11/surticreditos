$(function(){
    $('#upfour').click(function(){

        var comprobar = $('#csvfour').val().length;

        if(comprobar > 0){
            var formulario = $('#subidacuatro');
            var archivos = new FormData();
            var url = csvfour;

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
                    $('#respuestacuatro').html('<label style="padding-top:10px; color:blue;">Cargando...</label>');
                },
                success: function(data){                   
                    if(data.length > 0){
                        $('#respuestacuatro').html('<label style="padding-top:10px; color:green;">'+ data +'</label>');	
                        $('#subidacuatro')[0].reset();
                        return false;
                    }
                },
                error: function (data) {                    
                    var status = JSON.parse(data.responseText);
                    $('#respuestacuatro').html('<label style="padding-top:10px; color:red;">'+ status +'</label>');
                    return false;
                }
    });    
        }
        else         
        {            
            $('#respuestacuatro').html('<label style="padding-top:10px; color:red;">Selecciona un archivo CSV para importar.</label>');
            return false;
        }
    });
    
    return false;
});