var docLink = '';
$(document).ready(function() {
  $("a.payments_link").on("click", function(event){
	event.preventDefault();
    docLink = $(this).attr("href");
	showMesage("Отправка ", "Вы подтверждаете отправку документов?", "<button class='yes'>да</button>&nbsp;&nbsp;<button class='no'>нет</button>");
  });
});


function showMesage(head, msg, footer=''){
	$(".hideModal").remove();
	$(".modalMes").remove();
	$("style.modal").remove();
	$("body").append("<div class='hideModal'></div><div class='modalMes'><div class='modalInner'><div class='modalClose'>&times;</div><div class='modalHead'><h3>"+head+"</h3></div><div class='modalBody'>"+msg+"</div><div class='modalFooter'>"+footer+"</div></div></div>");
	$("body").append("<style class='modal' type='text/css'>.modalMes{position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 200;} .modalMes .modalInner{display: block; position: relative; margin: 0 auto; margin-top: 20%; background-color: #fff; padding: 10px; transition: 2s; width: 20%;} .modalMes .modalClose{position: absolute; top: 0; right: 0; font-size: 30px; line-height: 20px; height: 20px; cursor: pointer;} .hideModal{position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 199; background-color: rgba(0, 0, 0, .5);} .modalFooter{margin-top: 10px;}</style>");
	
  	$('.modalClose').on("click", function(){hideMesage();});
	$("button.yes").on("click", function(){sendDoc(); hideMesage();});
    $("button.no").on("click", function(){hideMesage();});
}

function hideMesage(){
	$(".hideModal").hide();
	$(".modalMes").hide();
}

function sendDoc(){
  	window.open(docLink,'_blank');
}