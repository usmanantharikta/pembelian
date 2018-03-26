<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>MajuBersama | Login - Login to Portal Purchasing</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php $this->load->view('include/css');?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url().'assets/global/plugins/select2/select2.css'?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url().'assets/admin/pages/css/login3.css'?>" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<style>
.login {
  background-color: #e9e9e9 !important;
}
</style>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img src="<?php echo base_url().'/logo.png'?>" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form id="login-form"  method="post" action="#">
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Invalid Username or Password </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
      <span class="help-block"></span>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
      <span class="help-block"></span>
		</div>
		<div class="form-actions">
      <button type="submit" class="btn green-haze pull-right">
      Login <i class="m-icon-swapright m-icon-white"></i>
      </button>
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me </label>
		</div>
	</form>
	<!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2017 &copy; MAJU BERSAMA. ALL RIGHTS RESERVED.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- <script src="<?php echo base_url().'assets/admin/pages/scripts/login.js'?>" type="text/javascript"></script> -->
<?php $this->load->view('include/js');?>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  // Login.init();
  Demo.init();

  $('[name="password"]').keypress(function (e) {
  if (e.which == 13) {
    e.preventDefault();
    ajax_save();
    return false;    //<---- Add this line
  }
});

  Metronic.stopPageLoading();
$("#login-form").submit(function(event)
     {
       event.preventDefault();
       ajax_save();
     }); //end ajax save
});
</script>
<script>
Metronic.startPageLoading({animate: true});

function ajax_save()
{
  Metronic.startPageLoading({animate: true});
 $('.form-group').removeClass('has-error'); // clear error class
 $('.help-block').empty(); // clear error string
    $.ajax({
        url : '<?php echo site_url('/login/access') ?>',
        type: "POST",
        data: $('#login-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          Metronic.stopPageLoading();
          if(data.status) //if success close modal and reload ajax table
           {
             // alert('sucsess login');
             if(data.division=='purchasing'){
               window.location.href = '<?php echo site_url().'pr/'?>';
             }else{
               window.location.href = '<?php echo site_url().'keuangan/'?>';
             }
           }
           else
           {
             $('.display-hide').removeClass('display-hide');
               for (var i = 0; i < data.inputerror.length; i++)
               {
                   $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                   // $('[name="'+data.inputerror[i]+'"]').parent().next().text(data.error_string[i]); //select span help-block class set text error string
               }
           }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          Metronic.stopPageLoading();
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
