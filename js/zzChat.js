var url = "./zzChatAjax.php";
var timer = setInterval(getMessages, 5 * 1000);
var ctimer = setInterval(getConnected, 1 * 60 * 1000);

getMessages();
getConnected();

$(function(){
		$("#msgArea form").submit(function()
		{
			clearInterval(timer);
			var message = $("#msgArea form input[id=msg]").val();
			$.post(url, {action:"addmsg", message:message}, function(data)
			{
				if(data.error == "ok")
				{
					getMessages();
					$("#msgArea form input[id=msg]").val("");
				}
				timer = setInterval(getMessages, 1000);
			}
			, "json");
			
			return false;
		});
});

function getMessages()
{
	var move = false;
	$.post(url, {action:"getMessages"}, function(data)
	{
		if(data.error == "ok")
		{
			if( $("#textArea").scrollTop() + $("#textArea").height() + 2 == $("#textArea").prop("scrollHeight") )
				move = true;
				
			$("#textArea").empty().append(data.messages);
			if( move )
				$('#textArea').animate({"scrollTop": $('#textArea')[0].scrollHeight}, "slow");
		}
	}, "json");
		
	return false;
}


function getConnected()
{
	$.post(url, {action:"getConnected"}, function(data)
	{
		if(data.error == "ok")
		{
			$("#online p").empty().append(data.online);
		}
	}, "json");
		
	return false;
}
