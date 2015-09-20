<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="css/custom.css" rel="stylesheet">
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"> </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
        <script src="js/jsfunctions.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> LOGIN </h3>
        </div>
        <div calss="panel-body">
   <form class="form-horizontal">

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
        </div>
      </div> 
      <!--form-group end-->

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
      </div>
     <!--form-group end-->

      <div class="form-group sign-in">
        <div class="col-sm-offset-2 col-sm-8">
          <button type="submit" class="btn btn-primary" id="form-submit">Sign in</button>
        </div>
      </div>
      <!--form-group end-->
      <div class="form-group new-user">
        <div class="col-sm-offset-2 col-sm-8">
          <button type="button" class="btn btn-success" id="form-new">New User</button>
        </div>
      </div>
      <!--form-group end-->
      <div class="form-group register">
        <div class="col-sm-offset-2 col-sm-8">
          <button type="submit" class="btn btn-info" id="form-register">Register</button>
        </div>
      </div>
      <!--form-group end-->

    </form>
    <!--form-horizontal end-->

    </div>
    <!--panel-body end-->
    </div>
     <!--panel end-->
   </div>
    <!--container end-->
   
  </body>
</html>