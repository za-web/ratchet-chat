<!DOCTYPE HTML>
<html class="no-js">
<head>
    <!-- Basic Page Needs
      ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ZaWeb Chat</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Optional theme -->
    <!--     <link rel="stylesheet" href="/css/bootstrap-theme.min.css">  -->

    <!-- Font awesome-->
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Styles-->
    <link rel="stylesheet" href="/build/css/all.css">
</head>
<body>

<!-- TOP-BAR -->
<!-- end top-bar -->

<header>

</header>


<!-- main content area -->
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                                    Away</a></li>
                            <li class="divider"></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                                    Sign Out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle"/>
                        </span>

                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong>
                                    <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago
                                    </small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>

                        <script id="entry-template" type="text/x-handlebars-template">
                            <li class="{{side}} clearfix chatMsg" style="display: none;">
                                <span class="chat-img pull-{{side}}">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar"
                                 class="img-circle"/>
                        </span>

                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">{{title}}</strong>
                                    </div>
                                    <p>
                                        {{body}}
                                    </p>
                                </div>
                            </li>
                        </script>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm"
                               placeholder="Type your message here..."/>
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-sm" id="btn-chat" onclick="sendMsg()">
                                Send
                            </button>
                            <button class="btn btn-info btn-sm" onclick="WebSocketTest()"
                                    id="btn-chat-test"> Test
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end main content area -->

<!-- footer -->
<!-- end footer -->


<!-- Latest compiled and minified JavaScript -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/handlebars.min.js"></script>
<script src="/js/main.js"></script>


<script>
    var source = $("#entry-template").html();
    var template = Handlebars.compile(source);

    function add(title, body, side) {
        var context = {
            title: title,
            body: body,
            side: side
        };
        var html = template(context);
        $('.chat').append(html);
        $('.chatMsg').slideDown('slide');
    }

    function sendMsg(){
        var ws = new WebSocket("ws://localhost:8080");
        ws.onopen = function () {
            // Web Socket is connected, send data using send()
            var msg = $('#btn-input').val();
            ws.send(msg);
            $('#btn-input').val('');
        };

        ws.onmessage = function (evt) {
            var received_msg = evt.data;
            add('Server', received_msg,'left');
            console.log(received_msg);
        };

       // $
    }

    function WebSocketTest() {
        if ("WebSocket" in window) {

            add('Ws test', 'WebSocket is supported by your Browser!','right');
            // Let us open a web socket
            var ws = new WebSocket("ws://localhost:8080");
           /* ws.onopen = function () {
                // Web Socket is connected, send data using send()
                ws.send("Message to send");
                console.log("Message is sent...");
            };*/
            ws.onmessage = function (evt) {
                var received_msg = evt.data;
                add('Server', received_msg,'left');
                console.log(received_msg);
            };
            ws.onclose = function () {
                // websocket is closed.
                alert("Connection is closed...");
            };
            $('#btn-chat-test').prop('disabled',true);

        }
        else {
            // The browser doesn't support WebSocket
            alert("WebSocket NOT supported by your Browser!");
        }
    }

</script>
</body>
</html>
