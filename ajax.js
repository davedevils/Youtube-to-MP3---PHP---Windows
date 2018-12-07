$(document).ready(function(){  
	AllCall(); 
});

var LinkCallback = 'callback.php';
var idunique = $("#linkdll").val();
var flag = 0;

function AllCall(){
	
	$("#download").on("click", function(e){
                var clicked = this.id;
                if(clicked != "noclick")
                {
					e.preventDefault();
					idunique = $("#linkdll").val();
					$("#ajaxpage").empty();
					$("#ajaxpage").prepend( "<center>Conversion en cours ...</br><img src='loading.gif' alt='chargement'></center>" ); 
					PostPage(idunique);
                }
	});
	

};


function PostPage(page) {

if(flag==0) {
flag = 1;
  $.ajax({
    type: 'POST',
    url: LinkCallback,
    data: "url="+ page ,
    cache: false,
    success: function(data) {
        $("#ajaxpage").html(data);
		AllCall();
		flag=0;
    }, 
    error: function(jqXHR) {
        //error
		$("#ajaxpage").html("div class='block-center ajaxcenterpage'><p><center>Erreur de chargement ... Merci de re-essayer plus tard </center></p></div>");
		flag=0;
    }
	});
}
};
