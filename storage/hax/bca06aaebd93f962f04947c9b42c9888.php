<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Auth Test</title>
</head>
<body>
    <form action="<?php echo  route('user.login.test') ; ?>" method="post" class="test-ajax">
        <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>">
        <div>
            Username: <input type="text" name="login_username" placeholder="Username">
            <?php echo  ($errors->has('login_username'))?$errors->first('login_username'):'' ; ?>
        </div>

        <div>
            Password: <input type="password" name="login_password" placeholder="Password">
            <?php echo  ($errors->has('login_password'))?$errors->first('login_password'):'' ; ?>
        </div>
        
        <div>
            <input type="submit">
        </div>
        <div class="errors">Errors:</div>
   </form> 
   <script src="<?php echo  assets('css/plugins/jQuery/jquery-2.2.3.min.js') ; ?>"></script>
   <script>
    $(function(){
        $(".test-ajax").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: $(this).serialize(),
                //dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.status == 100) 
                        $(".errors").html(data.respnseText);
                    else
                        window.location = data.resposeText;
                }
            });
        });
    });
   </script>
</body>
</html>