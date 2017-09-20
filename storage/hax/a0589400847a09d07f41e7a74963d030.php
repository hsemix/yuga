<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Submition</title>
</head>
<body>
   <form action="<?php echo  route('validate') ; ?>" method="post">
    <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>">
    <div>
        Email: <input type="text" name="email" placeholder="Email" value="<?php echo  $request->old('email') ?:'' ; ?>">
        <?php echo  ($errors->has('email'))?$errors->first('email'):'' ; ?>
    </div>
    <div>
        Username: <input type="text" name="username" placeholder="Username">
    </div>

    <div>
        Password: <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        Repeat Password: <input type="password" name="password_again" placeholder="Password">
    </div>

    <div>
        <input type="submit">
    </div>
   </form> 

   <pre><?php echo  print_r($errors->all()) ; ?></pre>
</body>
</htm 