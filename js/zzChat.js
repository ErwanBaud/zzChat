var url = "./zzChatAjax.php";
//var timer = setInterval(getMessages, 5 * 1000);			// timer for getMessages
//var ctimer = setInterval(getConnected, 1 * 60 * 1000);	// timer for getConnected

/* First display */
getMessages();
getConnected();

/* AJAX : call addmsg() function when the form is submitted	*/
$(function(){
		$("#msgArea form").submit(function()
		{
			/* timer getMessages() stop	*/
			clearInterval(timer);
			/* load the input text content	*/
			var message = $("#msgArea form input[id=msg]").val();
			/* AJAX request	*/
			$.post(url, {action:"addmsg", message:message}, function(data)
			{
				if(data.error == "ok")
				{
					getMessages();
					/* erase the input text content	*/
					$("#msgArea form input[id=msg]").val("");
				}
				/* timer getMessages() restart	*/
				timer = setInterval(getMessages, 5 * 1000);
			}
			, "json");
			/* block the form submission	*/
			return false;
		});
});

/* getMessages() load all messages in zzChat.json and display it in textArea div	*/
function getMessages()
{
	/* move is true if we have to scroll, false else	*/
	var move = false;
	
	$.post(url, {action:"getMessages"}, function(data)
	{
		if(data.error == "ok")
		{	
			/* if the scrollbar is on the bottom we have to set it on the bottom too after the display of messages	*/
			if( $("#textArea").scrollTop() + $("#textArea").height() + 2 == $("#textArea").prop("scrollHeight") )
				move = true;
							
			/* erase and write messages in textArea div	*/
			$("#textArea").empty().append(data.messages);
			if( move )
				/* move the scrollbar on the bottom	*/
				$('#textArea').animate({"scrollTop": $('#textArea')[0].scrollHeight}, "slow");
		}
	}, "json");
		
	return false;
}

/* getConnected() load all users in users.json and display it in online div	*/
function getConnected()
{
	$.post(url, {action:"getConnected"}, function(data)
	{
		if(data.error == "ok")
		{
			/* erase and write users in online div	*/
			$("#online p").empty().append(data.online);
		}
	}, "json");
		
	return false;
}
