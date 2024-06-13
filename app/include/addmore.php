<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add More Items</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
</head>
<style>
    #myModal{
        padding-right: 0px !important;
    max-width: 600px;
    display: block;
    padding: 0px;
    height: auto;
    left: 450px;
    }
    @media only screen and (min-width: 470px) and (max-width : 500px) {
        #myModal{
        left: 100px;
        max-width: 300px;}
    }
    @media only screen and (min-width: 414px) and (max-width : 470px) {
        #myModal{
        left: 60px;
        max-width: 300px;}
    }
    @media only screen and (min-width: 380px) and (max-width : 414px) {
        #myModal{
        left: 50px;
        max-width: 285px;}
    }
    @media only screen and (min-width: 350px) and (max-width : 380px) {
        #myModal{
        left: 35px;
        max-width: 285px;}
    }
</style>
<body>
<div id="myModal" class="modal fade" style="padding-right: 0px !important">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">You’re Almost Finished!</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
				
                    <div >
                        <p>If you’re ordering food, some Mains are eligible for a Side, please return to the Sides category to add yours if not already done so.</p>
                        <!--<button type="button" name="category" style="float: right;position: relative; top: -40px;"><a href="https://mywebapp.co.in/project/food_ordering_system/cats.php?cid=6"> Snacks</a></button>-->
                    </div>
                    
                    
            
            </div>
        </div>
    </div>
</div>
</body>
</html>