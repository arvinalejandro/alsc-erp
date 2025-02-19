<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>

<script src="/_jquery/jquery.js" type="text/javascript"></script>
<script src="js/jcarousel.js"></script>
  
  <script>
  $(document).ready(function() {
    	$(".anyClass").jCarouselLite({
			btnNext: ".next",
			btnPrev: ".prev",
			speed: 300,
			visible: 5,
			scroll: 1,
			circular: false,
			vertical: true

		});

  });
  </script>
  
<style type="text/css">
	.anyClass {
		margin-left:5px;
	}
	
	.anyClass ul li {
		margin-left:5px;
	}
</style>
</head>

<button class="prev"><<</button>
<button class="next">>></button>
        
<div class="anyClass">
    <ul>
        <li><img src="images/1.jpg" alt="" width="100" height="100" ></li>
        <li><img src="images/2.jpg" alt="" width="100" height="100" ></li>
        <li><img src="images/3.jpg" alt="" width="100" height="100" ></li>
        <li><img src="images/4.jpg" alt="" width="100" height="100" ></li>
        <li><img src="images/5.jpg" alt="" width="100" height="100" ></li>
        <li><img src="images/6.jpg" alt="" width="100" height="100" ></li>
        <li><img src="images/7.jpg" alt="" width="100" height="100" ></li>
        <li><img src="images/8.jpg" alt="" width="100" height="100" ></li>
    </ul>
</div>


</body>
</html>
