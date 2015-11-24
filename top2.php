 <div class="header-home">
	<div class="fixed-header">
		<div class="logo wow bounceInDown" data-wow-delay="0.4s">
			<a href="mainprocess.php">
	          <span class="secondary">a popular name search engine </span>
	          <span class="main">babynames</span>
	        </a>
		</div>
				<div class="top-nav wow bounce" data-wow-delay="0.4s">
				    <span class="menu"> </span>
					<ul>
						<li class="active"><a href="mainprocess.php">Home</a></li>
					  	<li><a href="analyse.php">Analysis</a></li>
					  							
					</ul>
				<!-- script-nav -->
			<script>
			$("span.menu").click(function(){
				$(".top-nav ul").slideToggle(500, function(){
				});
			});
			</script>
			<!-- //script-nav -->
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
        <!--script-->
		<script>
			$(document).ready(function(){
				$(".top-nav li a").click(function(){
					$(this).parent().addClass("active");
					$(this).parent().siblings().removeClass("active");
				});
			});
		</script>
			<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-home").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-home").addClass("fixed");
				}else{
					$(".header-home").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
	<!--//header-->
    </div>
