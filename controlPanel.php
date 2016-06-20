<?php
//============ristric user from viewing this page without login
// if user did not login then redirect them to login page (index.php)
session_start();
if(!isSet($_SESSION['loggedOn'])){
  header("Location: index.php");
}

if(!isSet($_SESSION['connectPATH'])){
  header("Location: carsel.php");
}

//variables...
$connectPATH = $_SESSION['connectPATH'];
$userID = $_SESSION['userID'];
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-Frame-Options" content="deny">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>IAP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="css/custom.css" rel="stylesheet">
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"> </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

        <script src="js/jsfunctions.js"></script>
        <script src="js/mows.js"></script>


        <script type="text/javascript">

        ////////////// mqtt fucntions //////////
        var connectPATH = <?php echo "'".$connectPATH."'" ; ?> ;
        var moveTopic = connectPATH+"/move";
        var statusTopic = connectPATH+"/status";

        var client;
        client = mows.createClient('ws://0.tcp.ngrok.io:13568');
        
        client.on('message', function (topic, message) {

         console.log(message);
         console.log(topic);
         });


      $(document).ready(function(){

          $("#stop").fadeOut();
        // event handler for mqtt
        $('#upBtn').click(function(e){
                e.preventDefault();
                client && client.publish(moveTopic, "1");

        });
        $('#rightBtn').click(function(e){
                e.preventDefault();
                client && client.publish(moveTopic, "2");

        });
        $('#downBtn').click(function(e){
                e.preventDefault();
                client && client.publish(moveTopic, "3");

        });
        $('#leftBtn').click(function(e){
                e.preventDefault();
                client && client.publish(moveTopic, "4");

        });
        $('#stopBtn').click(function(e){
                e.preventDefault();
                client && client.publish(moveTopic, "5");

        });

          var screen_width = $(window).width();
          var imgSize = screen_width * 0.1;
          $('#controlPanel img').attr('width',imgSize);

      $(window).on('beforeunload ',function() {
        
        closeConnection();

        //closeConnection();
          
         return 'Connection were lost just LEAVE and come back again';
      });

      });

     function closeConnection() {
        // send close status to mqtt server so that car can also disconnect as well
        client && client.publish(statusTopic, "0");

        $.post("closeConnection.php", {userID:<?php echo "'".$userID."'";?>}, function(data){
          console.log(data);


        });
     }
    </script>
         

    
  </head>
  <body>

  	<!--test begin-->
 

  	<!--test end-->
  	<!--nav-->
 	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CHOE</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Add CAR <span class="sr-only">(current)</span></a></li>
        <li><a href="#">About</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right test">

        <li><a href="logout.php">Sign out</a></li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




  	<!--nav end-->
    <div class="container">

    	<div class="panel panel-success">

      	  <div class="panel-heading">
            <h3 class="panel-title"> Control Panel </h3>
       	  </div>

          <div calss="panel-body">

            <div clas="row">

              <div class="col-md-6">
                <div class="embed-responsive embed-responsive-4by3">
                   
                    <div id="remote">
                      <video id="remote-video" autoplay=""  style="border:1px solid" width="640" height="480">
                        Your browser does not support the video tag.
                      </video>

                      <div class="col-sm-offset-5 col-sm-8" id="startDiv" >
                      <button type="button" class="btn btn-success" id="start" onclick="start();">START</button>
                      </div> 

                      <div class="col-sm-offset-1 col-sm-8" id="stopDiv" >
                      <button type="button" class="btn btn-primary" id="stop" onclick="stop();">STOP</button>
                      </div>  

                    </div> <!-- remote div-->
                </div> <!-- embed-responseive div-->
              </div> <!-- col-mod  div-->

              <div class="col-md-6">
                <div id="controlPanel">

                  <div id="upContainer">
                    <button id="upBtn"> <img src="images/up.png"/> </button>
                  </div>

                   <div id="leftContainer">
                  <button id="leftBtn"> <img src="images/left.png"/> </button>
                  </div>

                  <div id="stopContainer">
                  <button id="stopBtn"> <img src="images/minus.png"/> </button>
                  </div>

                   <div id="rightContainer">
                  <button id="rightBtn"><img src="images/right.png"/>  </button>
                  </div>

                   <div id="downContainer">
                  <button id="downBtn"><img src="images/down.png"/>  </button>
                  </div>


                </div> <!-- controlPanel  div-->
               </div> <!-- col-mod  div-->

            </div> <!-- row  div-->
          </div>  <!-- panelbody  div-->

      </div>
      <!--panel end-->
      <div id="controls">

            <details open>
                <summary>Advanced options</summary>
                <fieldset>
                    <span>Signalling Server Address: </span><input required type="text" id="signalling_server" value="0.tcp.ngrok.io:13039" title="<host>:<port>, default address is autodetected"/><br>

                </fieldset>
            </details>
            
        </div>
   </div>
   <!--container end-->
              <script>

             
                var signalling_server_hostname = "58.106.130.184";
            var signalling_server_address = signalling_server_hostname + ':' + (8080);
            var ws = null;
            var pc;


            var pcConfig = {"iceServers": [
                    {"urls": ["stun:stun.l.google.com:19302"]}

                ]};
            var pcOptions = {
                optional: [
                    {DtlsSrtpKeyAgreement: true}
                ]
            };
            var mediaConstraints = {
                optional: [],
                mandatory: {
                    OfferToReceiveAudio: true,
                    OfferToReceiveVideo: true
                }
            };

            RTCPeerConnection = window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
            RTCSessionDescription = window.mozRTCSessionDescription || window.RTCSessionDescription;
            RTCIceCandidate = window.mozRTCIceCandidate || window.RTCIceCandidate;
            navigator.getUserMedia = navigator.getUserMedia || navigator.mozGetUserMedia || navigator.webkitGetUserMedia;
            URL = window.webkitURL || window.URL;

            function createPeerConnection() {
                try {
                    var pcConfig_ = pcConfig;
                    
                    console.log(JSON.stringify(pcConfig_));
                    pc = new RTCPeerConnection(pcConfig_, pcOptions);
                    pc.onicecandidate = onIceCandidate;
                    pc.onaddstream = onRemoteStreamAdded;
                    pc.onremovestream = onRemoteStreamRemoved;
                    console.log("peer connection successfully created!");
                } catch (e) {
                    
                }
            }
            var indexTest = 1;
            function onIceCandidate(event) {
                if (event.candidate) {
                    var candidate = {
                        sdpMLineIndex: event.candidate.sdpMLineIndex,
                        sdpMid: event.candidate.sdpMid,
                        candidate: event.candidate.candidate
                    };
                    console.log("notsing"+indexTest++);
                    console.log(candidate);
                    
                    var command = {
                        command_id: "addicecandidate",
                        data: JSON.stringify(candidate) 


                        // my candidate(net interface) from ICE
                    };
                    console.log("not sending");
                    
                   ws.send(JSON.stringify(command));
                } else {
                    console.log("End of candidates.");
                }
            }

            function onRemoteStreamAdded(event) {
                console.log("Remote stream added:", URL.createObjectURL(event.stream));
                var remoteVideoElement = document.getElementById('remote-video');
                remoteVideoElement.src = URL.createObjectURL(event.stream);
                remoteVideoElement.play();
            }

            function onRemoteStreamRemoved(event) {
                var remoteVideoElement = document.getElementById('remote-video');
                remoteVideoElement.src = '';
            }

            function start() {
                if ("WebSocket" in window) {
                    $("#start").fadeOut();
                    $("#stop").fadeIn();
                    document.documentElement.style.cursor ='wait';
                    server = document.getElementById("signalling_server").value.toLowerCase();


                    ws = new WebSocket('ws://' + server + '/stream/webrtc');

                    function offer(stream) {
                        console.log("when");
                        createPeerConnection();

                        if (stream) { /// does not come here no stream
                            console.log(stream);
                            pc.addStream(stream);
                        }
                        var command = {
                            command_id: "offer"
                        };
                       
                       ws.send(JSON.stringify(command));
                        console.log("offer(), command=" + JSON.stringify(command));
                    }

                    ws.onopen = function () {
                        console.log("onopen()");

                        offer();
                    };

                    ws.onmessage = function (evt) {
                        var msg = JSON.parse(evt.data);
                        console.log("on message");
                        console.log(msg);
                        console.log("type=" + msg.type);

                        switch (msg.type) {
                            case "offer":
                                pc.setRemoteDescription(new RTCSessionDescription(msg),
                                    function onRemoteSdpSuccess() {
                                        console.log('onRemoteSdpSucces()');

                                        pc.createAnswer(function (sessionDescription) {
                                            pc.setLocalDescription(sessionDescription);
                                            var command = {
                                                command_id: "answer",
                                                data: JSON.stringify(sessionDescription)
                                            };
                                            ws.send(JSON.stringify(command));
                                            console.log("answer");
                                            console.log(command);

                                        }, function (error) {
                                            alert("Failed to createAnswer: " + error);

                                        }, mediaConstraints);
                                    },
                                    function onRemoteSdpError(event) {
                                        alert('Failed to setRemoteDescription: ' + event);
                                    }
                                );

                                var command = {
                                    command_id: "geticecandidate"
                                };
                                console.log(command);
                                ws.send(JSON.stringify(command));
                                break;

                            case "answer":
                                break;

                            case "message":
                                alert("websocket on message (message)"+msg.data);
                                break;
                              
                            case "geticecandidate":
                                var candidates = JSON.parse(msg.data);
                                for (var i = 0; i < candidates.length; i++) {
                                    var elt = candidates[i];
                                    var candidate = new RTCIceCandidate({sdpMLineIndex: elt.sdpMLineIndex, candidate: elt.candidate});
                                    pc.addIceCandidate(candidate,
                                        function () {
                                            console.log("IceCandidate added: " + JSON.stringify(candidate));
                                        },
                                        function (error) {
                                            console.log("addIceCandidate error: " + error);
                                        }
                                    );
                                }
                                document.documentElement.style.cursor ='default';
                                break;
                            
                        }
                    };

                    ws.onclose = function (evt) {
                        if (pc) {
                            pc.close();
                            pc = null;
                        }
                       
                        document.documentElement.style.cursor ='default';
                    };

                    ws.onerror = function (evt) {
                        alert("An error has occurred!");
                        ws.close();
                    };

                } else {
                    alert("Sorry, this browser does not support WebSockets.");
                }
            }

            function stop() {

                if (pc) {
                    pc.close();
                    pc = null;
                }
                if (ws) {
                    ws.close();
                    ws = null;
                }
                 $("#start").fadeIn();
                    $("#stop").fadeOut();
               
                document.documentElement.style.cursor ='default';
            }


            window.onbeforeunload = function() {
                if (ws) {
                    ws.onclose = function () {}; // disable onclose handler first
                    stop();
                }
            };
              </script>

          



   
   
   
  </body>
</html>