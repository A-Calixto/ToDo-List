<!DOCTYPE HTML>
<html>
  <head>
    <title>To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="libraries/css/bootstrap.css" media="all">
    <link rel="stylesheet" type="text/css" href="libraries/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="libraries/css/responsive.bootstrap2.1.1.min.css">
    <link rel="stylesheet" type="text/css" href="libraries/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="libraries/sweetalert2/dist/sweetalert2.min.css">
    <!-- Custom Theme files -->
    <link rel="stylesheet" type="text/css" href="libraries/css/style.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="libraries/css/font-awesome.css"> 
    <link rel="stylesheet" type="text/css" href="libraries/css/style_elements.css">
    <!-- <link rel="stylesheet" type="text/css" href="libraries/css/bootstrap_datepicker.min.css"> -->
    <link href='//fonts.googleapis.com/css?family=Work+Sans:300,400,3500' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="libraries/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="libraries/js/datatables.min.js"></script>
    <script type="text/javascript" src="libraries/js/dataTables.buttons1-2-4.min.js"></script>
    <script type="text/javascript" src="libraries/js/bootstrap.js"></script>
    <script type="text/javascript" src="libraries/js/dataTables2.1.1.responsive.min.js"></script>
    <script type="text/javascript" src="libraries/js/responsive.bootstrap2.1.1.min.js"></script>
    <script type="text/javascript" src="libraries/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="libraries/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="libraries/js/functions.js<?php echo '?'.rand(1,500); ?>"></script>
    <script type="text/javascript" src="libraries/js/homework.js<?php echo '?'.rand(1,500); ?>"></script>
  </head>
  <body>  
    <div id="contenedor" class="page-container">	
      <div class="left-content">
        <div class="mother-grid-inner">
          <?php
          include("views/header.php");
          ?>

    			<div id="block" class="inner-block">
            <div id="templateContainer" class="blank"></div>
    			</div>

    			<?php
    			include("views/footer.php");
    			?>
    		</div>
    	</div>

    	<?php
    	include("views/sidebar_menu.php");
    	?>


    	<div class="clearfix"> </div>
    </div>
    <script>
      var toggle = true;           
      $(".sidebar-icon").click(function() { 
        if (toggle)
        {
          $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
          $("#menu span").css({"position":"absolute"});
        }
        else
        {
          $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
          setTimeout(function() {
            $("#menu span").css({"position":"relative"});
          }, 400);
        }               
          toggle = !toggle;
      });
    </script>


  </body>
</html> 
