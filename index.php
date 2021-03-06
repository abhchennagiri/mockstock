<?//ini_set('display_errors', 'On');?>
<!doctype html>
<html>
<head>
<?include('config.php');?>
<?include('includes/bootstrap.inc.php');?>
<?include('scripts/php/basic_functions.php');?>
<link rel="stylesheet" href="css/style.css"/>
<meta http-equiv="Content-Type" content="application/xhtml+xm; charset=utf-8" />
<title>Mock stock</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<script type="text/javascript" src="scripts/js/misc.js"></script>
<style type="text/css">
      body {
      	padding:15px;
      }
</style>
</head>
<body>


<div class="navbar navbar-fixed-top shadow">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?echo $config['base_url'];?>">Mockstock</a>
          <ul class="nav pull-right">
	  		<? if(!isLogin()){?>
                    <form class="navbar-search pull-left" method="post" action="scripts/php/accounts.php?action=login">
			<input type="text" name="email" placeholder="email" style="font-size:11pt;height:18px;">
			<input type="password" name="password" placeholder="Password" style="font-size:11pt;height:18px;">
			<button type="submit" style="margin-top:-3px;" class='btn btn-success'>Login</button>
		  </form>
        <button class='btn btn-primary' onclick='load_form_modal("Quick Signup","scripts/php/accounts.php?action=signup","<input name=\"first_name\" type=\"text\" placeholder=\"First Name\"/> eg: John<br><input name=\"last_name\" type=\"text\" placeholder=\"Last Name\"/> eg: Smith<br><input name=\"email\" type=\"text\" placeholder=\"email\"/> eg: john@example.com<br><input name=\"password\"type=\"password\" placeholder=\"password\"/> Password should have a minimum of 6 characters<br><input name=\"confirm_password\"type=\"password\" placeholder=\"confirm password\"/><br><input type=\"text\" placeholder=\"age\"/ name=\"age\"><br> Note that your age is only for our statistcs and will not be shared with others<br><br><input name=\"terms\" value=\"1\" type=\"checkbox\"/> &nbsp;&nbsp;&nbsp;I agree to terms and conditions","Signup");'>Signup</button>

		  <?}else{?>
		<!--<li><a href="'.$this->config->base_url().index_page().'/welcome/logout"><i class="icon-off"></i> Logout</a></li>';-->
		<!-- show this only when logged in -->
            <li class="divider-vertical"></li>
		<li class='dropdown'><a>Welcome <?echo get_username();?></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Account settings</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="scripts/php/accounts.php?action=logout">Logout</a></li>
              </ul>
            </li>
	    <?}?>
          </ul>


        </div>
      </div>
    </div>
    <!-- Navigation bar done -->

<br><br>
<div class="container" >
<?if((!isLogin())||(!game_started())){
    $time_status=get_time_status();
?>
    <center>
        <h1 style='font-size:10em; line-height:2em;'>
            <?echo $time_status['game_status'];?>
            <?if($time_status['game_status']!="Game Over"){
                echo '<a id="timer">'.$time_status['time'].'</a>';
                echo '<script>setTimeout("update_timer()",0);</script>';
            }?>
        </h1>
    </center>
<?}else{?>
<!-- everything should be here -->
<div class="board">
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav">
            <li class="active" id="dashboard_button"><a href="#">Dashboard</a></li>
            <li><a href="#">Ranking</a></li>
            <li><a href="#">Transactions</a></li>
            </ul>
        </div>
    </div>
<!-- make this async-->
    <?include("includes/dashboard.inc.php");?>
</div>
</div>
    <?include("includes/footer.inc.php");?>
<!-- container closed -->
<?}?>
<!-- this is the modal for everything without a form-->
<div class="modal hide fade" id="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" onclick="toggle_mode();">×</button>
    <h3 id='modal_header'>Default Header</h3>
  </div>
  <div class="modal-body" id='modal_body' >
  Default body
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" >Close</a>
  </div>
</div>
<script type='text/javascript'>
	function load_modal(header,body){
		$('#modal').modal('show');
		document.getElementById("modal_header").innerHTML=header;
		document.getElementById("modal_body").innerHTML=body;
	}
	function close_modal(){
		$('#modal').modal('hide');
	}
</script>

<!-- this is a modal for everything with a form -->
<div class="modal hide fade" id="form_modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" onclick="toggle_mode();">×</button>
    <h3 id='form_modal_header'>Default Header</h3>
  </div>
  <form method='post' action='' id='form_modal_action'>
  	<div class="modal-body" id='form_modal_body' >
  	Default body
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
	<input type='submit' class='btn btn-primary' value='Submit' id='form_modal_submit'>
  	</div>
   </form>
</div>
<script type='text/javascript'>
	function load_form_modal(header,action,body,submit){
		$('#form_modal').modal('show');
		document.getElementById("form_modal_header").innerHTML=header;
		document.getElementById("form_modal_action").action=action;
		document.getElementById("form_modal_body").innerHTML=body;
		document.getElementById("form_modal_submit").value=submit;
	}
	function close_form_modal(){
		$('#form_modal').modal('hide');
	}
</script>


<script type="text/javascript">
	function alerts(){
		if("<?echo $_GET["error"]; ?>")
			load_modal("Error!!!","<?echo $_GET['error'];?>");
		else if("<?echo $_GET["message"]; ?>")
			load_modal("<?echo $_GET['message_head'];?>","<?echo $_GET['message'];?>");
	}
	setTimeout("alerts();","0");
</script>
</body>
</html>
