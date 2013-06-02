<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<title>Anacaraka Online Advertising - Promosikan Barang dan Jasa Anda Disini Secara Gratis, Mudah dan Aman</title>
	<meta name="description" content="">
	<meta name="author" content="cuongv">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
	<!-- CSS styles -->
	<link rel='stylesheet' type='text/css' href='http://localhost/advertising/asset/theme/blue_strap/css/bootstrap.min.css'>
	<link rel='stylesheet' type='text/css' href='http://localhost/advertising/asset/theme/blue_strap/css/bootstrap-responsive.min.css'>
	<link rel='stylesheet' type='text/css' href='http://localhost/advertising/asset/theme/blue_strap/css/main.css'>
	
	<!-- JS Libs -->
	<script src="http://localhost/advertising/asset/theme/blue_strap/js/jquery.js"></script>
	<script src="http://localhost/advertising/asset/theme/blue_strap/js/bootstrap.min.js"></script>
	<script src="http://localhost/advertising/asset/theme/blue_strap/js/bootstrap-carousel.js"></script>
<script src="http://localhost/advertising/asset/theme/blue_strap/js/redactor/jquery-1.7.min.js" type="text/javascript"></script>
	<link href="http://localhost/advertising/asset/theme/blue_strap/js/redactor/redactor.css" rel="stylesheet" type="text/css" />
	<script src="http://localhost/advertising/asset/theme/blue_strap/js/redactor/redactor.min.js" type="text/javascript"></script>
	<style type="text/css">
      /* Override some defaults */
      html, body {
	  	padding:50px;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 400px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }

    </style>
	</head>
	<body>
	<div class="container">
    <div class="content">
      <div class="row">
        <div class="login-form">
          <h2>Login Superadmin</h2>
          <?php echo form_open("superadmin/superadmin/login"); ?>
		  <?php echo $this->session->flashdata("result"); ?>
            <fieldset>
              <div class="clearfix">
                <input type="text" name="username" placeholder="Username" required>
              </div>
              <div class="clearfix">
                <input type="password" name="password" placeholder="Password" required>
              </div>
              <div class="clearfix">
			  	<p><?php echo $captcha; ?></p>
                <input type="text" name="captcha" placeholder="Captcha" required>
              </div>
              <button class="btn btn-info" type="submit">Sign in</button>
              <button class="btn btn-warning" type="reset">Reset</button>
            </fieldset>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div> <!-- /container -->
	</body>
	</html>