$(function download () {

    $(".select2").on("select2:select", function (e) { 
        var id = $(".select2").val();
        
        $.ajax({
            url: url,
            type: "POST",
            data: {
                paginator: self.data
            },
            error: function(error){
                console.log(error);
            },
            success: function(data){
                window.location = self.urlReport + '/download/' + data[0];
            }
        });       
    });
});