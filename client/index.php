<html>
<head>
    <meta charset="utf-8">
    <title>User system - SOAP - Michal Krauter</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="utils.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sendForm').submit(function(event){
                event.preventDefault();
                $("div").remove(".err");
                $("div").remove(".box");
            
                var formData = {
                    'name'   : $('input[name=name]').val(),
                    'password' : $('input[name=password]').val(),
                    'email' : $('input[name=email]').val(),
                    'authority' : $('input[name=authority]').val()
                };
    
                $.ajax({
                    type     : 'POST',
                    url      : 'ajax-form-send.php',  
                    data     : formData, 
                    dataType : 'json',
                    encode   : true
                })
                .done(function(data){  
                    if(data.success == true){
                        u.remoteLogAddRecord('register_user', '200', 'User request OK');
                        $('#sendForm').after('<div class="box">' + data.message + '</div>'); 
                        $('#sendForm').trigger("reset");
                    } 
                    else {
                        u.remoteLogAddRecord('register_user', '1001', 'User request error:', data.message);
                        $('#sendForm').after('<div class="box error">' + data.message + '</div>');
                        $.each(data.errors, function(index, value){ 
                            $('#sendForm [name="'+index+'"]').after('<div class="err">'+value+'</div>');
                        });
                    }
                });
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="client.css" />
</head>

<body>
    <h1>User system - SOAP</h1>
    <h2>Michal Krauter</h2>
    <h3>[ Registrace u??ivatele ]</h3>
    <form action="" method="post" id="sendForm" enctype="multipart/form-data">
        <table>
	        <tr><td>Jm??no:</td><td><input type="text" name="name"></td></tr>
	        <tr><td>Heslo:</td><td><input type="password" name="password"></td></tr>
	        <tr><td>E-mail:</td><td><input type="text" name="email"></td></tr>
	        <tr><td>Typ ????tu:</td><td><input type="radio" name="authority" checked="checked" value="user"> U??ivatel<br/><input type="radio" name="authority" value="admin"> Administrator</td></tr>
	        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	        <tr><td><input name="form" type="submit" value="Ulo??it"></td><td>&nbsp;</td></tr>
        </table>
    </form>
    <a href="user-list.php">Seznam registrovan??ch</a>
</body>
</html>