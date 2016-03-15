var item_id;
var user_id;

function buy_item (item, user) 
{

	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			if (xmlhttp.responseText)
			{
				document.getElementById("inventory_block").innerHTML+='<div class="inventory_item_block" ><table class="inventory_item_details"><tr><td><div class="inventory_item_icon"><img src="../public/images/items/'+item+'_large.png"  alt="icon" /></div></td><td><div class="inventory_item_name">'+xmlhttp.responseText+'</div></td></tr></table></div>';
			}
			else 
			{
				alert("Don't have sufficient credit!");
			}
		}
	}
	xmlhttp.open("GET","../bin/buy_item.php?data="+item+"_"+user,true);
	xmlhttp.send();
	cancelWarning();
}


function loadContent() {


}

function confirmBuy(item, user)
{
	item_id = item;
	user_id = user;

	$("#cover_layer").height(document.body.clientHeight);
	$("#cover_layer").width(document.body.clientWidth);
	$("#cover_layer").css("opacity","0.6");
	$("#cover_layer").css("z-index","99");

	$("#warning_window").css("opacity","1.0");
	$("#warning_window").css("top",($(window).height()-360)/2+$(window).scrollTop());
	$("#warning_window").css("left",($(window).width()-320)/2+$(window).scrollLeft() );
	$("#warning_window").css("z-index","100");

	$("#warning_message").css("opacity","1.0");
	$("#warning_message").css("z-index","101");

	$("#yes_button").css("opacity","1.0");
	$("#yes_button").css("z-index","101");

	$("#no_button").css("opacity","1.0");
	$("#no_button").css("z-index","101");
}

function cancelWarning()
{
	$("#cover_layer").css("opacity","0.0");
	$("#cover_layer").css("z-index","-1");

	$("#warning_window").css("opacity","0.0");
	$("#warning_window").css("z-index","-1");

	$("#warning_message").css("opacity","0.0");
	$("#warning_message").css("z-index","-1");

	$("#yes_button").css("opacity","0.0");
	$("#yes_button").css("z-index","-1");

	$("#no_button").css("opacity","0.0");
	$("#no_button").css("z-index","-1");
}