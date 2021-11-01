<!DOCTYPE html>
<html>
<head>
    <title>Web form</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style>
       /* #results { padding:20px; border:1px solid; background:#ccc; }*/
	.item1 { grid-area: header; }
	.item2 { grid-area: menu; }
	.item3 { grid-area: main; }
	.item4 { grid-area: right; }
	.item5 { grid-area: footer; }

	.grid-container {
	  display: grid;
	  grid-template-areas:
	    'header header header header header header'
	    'menu main main main right right'
	    'menu footer footer footer footer footer';
	  grid-gap: 10px;
	  background-color: rgba(255, 255, 255, 1);
	  padding: 10px;
	}

	.grid-container > div {
	  background-color: rgba(255, 255, 255, 1);
	  text-align: center;
	  padding: 20px 0;
	  font-size: 30px;
	}

	.center {
	  margin: auto;
	  width: 50%;	 
	  padding: 10px;
	}

	input[type=text], select {
	  width: 100%;
	  padding: 12px 20px;
	  margin: 8px 0;
	  display: inline-block;
	  border: 1px solid #ccc;
	  border-radius: 4px;
	  box-sizing: border-box;
	}

	input[type=submit] {
	  width: 100%;
	  background-color: #4CAF50;
	  color: white;
	  padding: 14px 20px;
	  margin: 8px 0;
	  border: none;
	  border-radius: 4px;
	  cursor: pointer;
	}

input[type=submit]:hover {
  background-color: #45a049;
}

    </style>
</head>
<body>
  
<div class = "grid-container">         
		<div class = "item1">         
        		<h2 class="text-center">Report generator</h1>
                <div id="my_camera" style = " width : 300, height:350, display: inline-block" class="center"></div>                                                                  
                <br/>                              
        </div>

        <div class = "item4">
        	Photo captured:
        	<div id="results" style = " width : 270, height:270, display: inline-block"; ></div> 
    	</div>

        <div class = "item3">
        	<!-- Please fill out the form below to generate pdf. Make sure you take a snapshot of your picture first. <br><br> -->

        	<form method="POST" action="./form_cam.php">        		               
        		<label for = "name" > Name </label> <br>
        		<input type="text" name = "name">  </input> <br>
        		<label for = "vID" > VillanovaID </label> <br>
        		<input type="text" name = "vID">  </input>  <br>
        		<label for = "age" > Age </label> <br>
        		<input type="text" name = "age">  </input> <br>
        		<label for = "dept" > Department </label> <br>
        		<input type="text" name = "dept">  </input> <br>

        		<input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag"> <br> <br>

        		<button class="btn btn-success">Generate PDF</button>
        	</form>
        </div>
            
    </form>
</div>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 270,
        height: 270,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
 
</body>
</html>