<div class="header-main">
	<div class="header-left">
			<div class="logo-name">
				<a href="index.php">
					<h2> Logotipo </h2>
				</a> 								
			</div>
		 </div>
		 <div class="header-right">
			


			<div class="profile_details">		
				<ul>
					<li class="dropdown profile_details_drop">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<div class="profile_img">	
								<span class="prfil-img"> </span> 
								<div class="user-name">
									<p>BIENVENIDO(A)</p>
								</div>
								<i class="fa fa-angle-up lnr"></i>
								<div class="clearfix"></div>	
							</div>	
						</a>
					</li>
				</ul>
			</div>

			<div class="clearfix"> </div>				
		</div>
     <div class="clearfix"> </div>	
</div>

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
<!-- /script-for sticky-nav -->