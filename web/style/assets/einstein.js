var userID = "3181141";
var botToken = "uRjztu1BDZD4oc6Pwgu4HQ25";
var buckets = "922675";
var chats = "133978483";

$(document).ready(function() {
    var isShift = false;
    $(document).keyup(function (event) {
        if (!event.shiftKey) isShift = false;
    }).keydown(function (event) {
        if (event.shiftKey) isShift = true; 
        if(event.which == 13 && isShift == true) {
            if(checkSelect(getSelectedText()) === true)
                showMesage("Вы нашли ошибку", "Вы подтверждаете отправку опечатки?", "<button class='yes'>да</button>&nbsp;&nbsp;<button class='no'>нет</button>");
        }

    });
});

function sendErrormes_js(select){
	var urlChats = "https://3.basecamp.com/"+userID+"/integrations/"+botToken+"/buckets/"+buckets+"/chats/"+chats+"/lines";
	var msg = "<p>Найдена ошибка:<br><strong>На странице:</strong> <em>"+location.href+"</em><br> <strong>В тексте:</strong> <em>"+select+"</em></p>";
	$.ajax({
        url: urlChats,
        type: "POST",
        dataType: 'json',
        data: {"content": msg},
        success: function (data, textStatus) {
        	console.info(data);
        	console.info(textStatus);
        },
        jsonpCallback: 'parseResponse'
      });
}

function getSelectedText(){
    var text = "";
    if (window.getSelection) {
        text = window.getSelection();
    }else if (document.getSelection) {
        text = document.getSelection();
    }else if (document.selection) {
        text = document.selection.createRange().text;
    }
    return text;
}

function clearPageSelection(){
	if(window.getSelection){
		if(window.getSelection().empty){
			window.getSelection().empty();
		} 
		else if(window.getSelection().removeAllRanges){
			window.getSelection().removeAllRanges();
		}
	} 
	else if(document.selection){
		document.selection.empty();
	}
} 

function checkSelect(msg){
	if(msg.toString().length == 0){
		showMesage("Ошибка", "<font color='red'>Чтобы указать опечатку выделите фрагмент текста не менее 10 символов и нажмите Shift + Enter</font>");
		return false;
	}
    else if(msg.toString().length > 60){
        showMesage("Ошибка", "<font color='red'>Вы выделили слишком много.<br>Максимальное количество - 60 символов.<br>Попробуйте снова.</font>");
        return false;
    }
	else if(msg.toString().length < 10){
		showMesage("Ошибка", "<font color='red'>Чтобы указать опечатку выделите фрагмент текста не менее 10 символов и нажмите Shift + Enter.</font>");
		return false;
	}
	else
		return true;
}

function showMesage(head, msg, footer=''){
	$(".hideModal").remove();
	$(".modalMes").remove();
	$("style.modal").remove();
	$("body").append("<div class='hideModal'></div><div class='modalMes'><div class='modalInner'><div class='modalClose'>&times;</div><div class='modalHead'><h3>"+head+"</h3></div><div class='modalBody'>"+msg+"</div><div class='modalFooter'>"+footer+"</div></div></div>");
	$("body").append("<style class='modal' type='text/css'>.modalMes{position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 200;} .modalMes .modalInner{display: block; position: relative; margin: 0 auto; margin-top: 20%; background-color: #fff; padding: 10px; transition: 2s; width: 20%;} .modalMes .modalClose{position: absolute; top: 0; right: 0; font-size: 30px; line-height: 20px; height: 20px; cursor: pointer;} .hideModal{position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 199; background-color: rgba(0, 0, 0, .5);} .modalFooter{margin-top: 10px;}</style>");

	$('.modalClose').on("click", function(){hideMesage();});
	$("button.yes").on("click", function(){sendErrormes_js(getSelectedText()); showMesage("Спасибо", "Ваше сообщение отправлено.");});
    $("button.no").on("click", function(){hideMesage(); clearPageSelection();});
}

function hideMesage(){
	$(".hideModal").hide();
	$(".modalMes").hide();
}