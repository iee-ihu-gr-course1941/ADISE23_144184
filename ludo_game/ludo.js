$( document ).ready(function() {
    //console.log( "ready!" );
    // change the color of private areas of players
    var arrRedArea = ['0208', '0308', '0408', '0508', '0608', '0708'];
   // var arrBlueArea = ['0809', '0810', '0811', '0812', '0813', '0814'];
    var arrYellowArea = ['0908', '1008', '1108', '1208', '1308', '1408'];
    //var arrGreenArea = ['0802', '0803', '0804', '0805', '0806', '0807'];

    jQuery.each(arrRedArea, function(index, item) {
        $("#box_" + item).addClass("box-red");
    });


    jQuery.each(arrYellowArea, function(index, item) {
        $("#box_" + item).addClass("box-yellow");
    });

    // jQuery.each(arrGreenArea, function(index, item) {
    //     $("#box_" + item).addClass("box-green");
    // });

    // make all clickable area disabled
    $("#all-stick-positions").addClass("disabledbutton");
    // refresh the whole game
    $("#refresh").click(function () {
        if(confirm("Are you sure to end this game?")) {
            $("#all-stick-positions").addClass("disabledbutton");
            $("#dice").attr("disabled",false);

            $.ajax({ url: "/ludo/ludoProcess.php",
                data: {data: JSON.stringify({action: 'refresh'})},
                type: 'post',
                success: function(result){
                    location.reload();
                }});
        }
    });

    // roll the dice
    $("#dice").click(function(){

        $.ajax({ url: "/ludo/ludoProcess.php",
                data: {data: JSON.stringify({action: 'diceRoll'})},
                type: 'post',
                success: function(result){
                    $("#all-stick-positions").removeClass("disabledbutton");
                    $("#dice-result").html(result);
                    //$("#dice").attr("disabled",true);
                }});
    });


    // requesting to move a specific piece after roll the dice
    $(".stick_position").click(function(event){
        // Example usage
        var dataString = {action: 'move', boxId: event.target.id, currentValue: $(this).html()}; //console.log($('#' + event.target.id).html());
        var existingValue = $(this).html();

        $.ajax({ url: "/ludo/ludoProcess.php",
            data: {data: JSON.stringify(dataString)},
            type: 'post',
            success: function(result){
                $("#all-stick-positions").addClass("disabledbutton");
                //$("#dice").attr("disabled",false);

                // if wrong move or request
                if(result.search("Wrong") >= 0 || result.search("end") >= 0 || result.search("try") >= 0 || result.search("move") >= 0){
                    alert(result);
                    $("#all-stick-positions").removeClass("disabledbutton");

                }else{
                  //  console.log(event.target.id)
                    // changing the place for a piece from current box to new box
                    $('#' + event.target.id).html(result);
                    var arr = event.target.id.split('_');
                    var move = arr[1] + arr[2];
                    console.log(move);
                    if(existingValue.length > 0){
                        var existingBoxValue = $('#box_' + existingValue).html();
                        if(existingBoxValue.length > 0){ //alert(existingBoxValue); alert(move.toUpperCase());
                              var existingBoxNewValue = existingBoxValue.replace(move.toUpperCase(), '');
                        }
                        $('#box_' + existingValue).html(existingBoxNewValue);
                    }

                    var updatedValue = $('#box_' + result).html();
                    if(updatedValue.length > 0){
                        updatedValue += ' ';
                    }

                    if(existingValue == result){
                        $("#all-stick-positions").removeClass("disabledbutton");
                    }
                    console.log(move + result);   
                                 
                    $('#box_' + result).html(updatedValue + move.toUpperCase());
                 //   gameState();
                }
            }});
    });
});



function gameStateFinder() {
    gameState();
}
function gameState() {
    // Fetch session data using AJAX
    $.ajax({
        url: "sessionget.php",
        dataType: "json",
        success: function (data) {
            // Data contains all session values as key-value pairs
            console.log(data);

            for(var x = 0; x <= 15; x++)
            {
                for(var y = 0; y <= 15; y++)
                {
                    var xx = '';
                    var yy = '';
                    if (x < 10) {
                        xx = '0' + x;
                    } else{
                        xx = '' + x;
                    }
            
                    if (y < 10) {
                        yy = '0' + y;
                    }
                    else{
                        yy = '' + y;
                    }
                    $('#box_' + xx + yy).html('');
                    
                }
            }

            var username = getCookie("username");
            if(username === 'Player1'){
                document.getElementById('redRow').style.display = 'none';
                console.log(data.turn)
                if(data.turn == 0){
                    $("#all-stick-positions").removeClass("disabledbutton");
                    document.getElementById('dice').style.display = 'inherit';
                    $("#dice-result").html('');
                }
                else  if(data.turn == 1){
                    $("#all-stick-positions").addClass("disabledbutton");
                    document.getElementById('dice').style.display = 'none';
                    $("#dice-result").html('Player 1 Turn');
                }
                  
            }

            if(username === 'Player2'){
                document.getElementById('yellowRow').style.display = 'none';
                console.log(data.turn)
                if(data.turn == 1){
                    $("#all-stick-positions").removeClass("disabledbutton");
                    document.getElementById('dice').style.display = 'inherit';
                    $("#dice-result").html('');
                }
                else if(data.turn == 0){
                    $("#all-stick-positions").addClass("disabledbutton");
                    document.getElementById('dice').style.display = 'none';
                    $("#dice-result").html('Player ' +2+ ' Turn');
                }
                  
            }
            
            // You can access individual session values like this:
            var red1 = data.red1LatestPosition;
            var red2 = data.red2LatestPosition;
            var red3 = data.red3LatestPosition;
            var red4 = data.red4LatestPosition;
            var player1score = data.player1score; 
            $('#player1score').html('Score : ' + player1score);

            var yellow1 = data.yellow1LatestPosition;
            var yellow2 = data.yellow2LatestPosition;
            var yellow3 = data.yellow3LatestPosition;
            var yellow4 = data.yellow4LatestPosition;
            var player2score = data.player2score;
            $('#player2score').html('Score : ' + player2score);
            // position_r_1
            if(red1){
                $('#position_r_1').html(red1);
                $('#box_' + red1).html('R1');
            }

            if(red2){
                $('#position_r_2').html(red2);
                $('#box_' + red2).html('R2');
            }

            if(red3){
                $('#position_r_3').html(red3);
                $('#box_' + red3).html('R3');
            }

            if(red4){
                $('#position_r_4').html(red4);
                $('#box_' + red4).html('R4');
            }

            if(yellow1){
                $('#position_y_1').html(yellow1);
                $('#box_' + yellow1).html('Y1');
            }

            if(yellow2){
                $('#position_y_2').html(yellow2);
                $('#box_' + yellow2).html('Y2');
            }

            if(yellow3){
                $('#position_y_3').html(yellow3);
                $('#box_' + yellow3).html('Y3');
            }

            if(yellow4){
                $('#position_y_4').html(yellow4);
                $('#box_' + yellow4).html('Y4');
            }

         
        },
        error: function (error) {
            console.error("Error fetching session data:", error);
        }
    });

};
gameState();

setInterval(gameStateFinder, 12000);

 function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}


