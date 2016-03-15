
//javascript functions


//jquery commands
$(document).ready(function(){
	var conn = new WebSocket('ws://localhost:8080');
	var location;

	conn.onopen = function(e) {

    };
	conn.onmessage = function(e) {
    	console.log(e.data);
        var json_obj = JSON.parse(e.data);

    	if (json_obj.type == "position_update") {
             var position_id = "#rowcol".concat(json_obj.position)
    		$(position_id).text(json_obj.sign);
    	}
        if (json_obj.type=="command_update"){
             $("#command").text(json_obj.msg);
        }
    
    };

    //adding click listeners
    for(var i = 0; i < 10; i++) {
        $('#rowcol' + i).click( createCallback(conn, i ) );
    }
   
});
