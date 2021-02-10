$("#scriptureform").submit(function(event){
    event.preventDefault(); //prevent default action 
    var post_url = $(this).attr("response.php"); //get form action url
    var request_method = $(this).attr("POST"); //get form GET/POST method
	var form_data = new FormData(this); //Creates new FormData object
    $.ajax({
        url : post_url,
        type: request_method,
        data : form_data,
		contentType: false,
		cache: false,
		processData:false
    }).done(function(response){ 
        console.log(response);
        $("#scripturedisplay").html(response);
    });
});