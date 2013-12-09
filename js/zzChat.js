var url = "./zzChatAjax.php";
var timer = setInterval(getMessages, 1000);
var ctimer = setInterval(getConnected, 1000);

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
	$.post(url, {action:"getMessages"}, function(data)
	{
		if(data.error == "ok")
		{
			$("#textArea").empty().append(data.messages);
			if(data.scroll == "yes") $('#textArea').animate({"scrollTop": $('#textArea')[0].scrollHeight}, "fast");
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
