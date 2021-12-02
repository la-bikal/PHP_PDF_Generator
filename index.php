<!DOCTYPE html>
<html>
<head>
    <title>Web form</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./webcam.min.js"></script>
    <script src="./cloud_mersive.js"></script>    
    <script src="./cloudmersive-validate-client.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style>
       /* #results { padding:20px; border:1px solid; background:#ccc; }*/
	.item1 { grid-area: header; }
	.item2 { grid-area: menu; }
	.item3 { grid-area: main; }
	.item4 { grid-area: right; }
	.item5 { grid-area: footer; }

	#parent{position:relative}

    .mascot
    {
      position: relative;
      top: 0;
      left: 0;
    }

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

   <script language="JavaScript">

   	function clear_face(){
   			window.onload = function() {
  		var c = document.getElementById("myCanvas");
  		var ctx = c.getContext("2d");
  		var img = document.getElementById("mascot");
  		ctx.drawImage(img, 10, 10);
	};
}
   		function dataURLtoBlob( dataUrl, callback )
		{
		    var req = new XMLHttpRequest;

		    req.open( 'GET', dataUrl );
		    req.responseType = 'blob';

		    req.onload = function fileLoaded(e)
		    {
		        callback(this.response);
		    };

		    req.send();
		}

		function apply_face(){
		  var canvas = document.getElementById('myCanvas');
      		var context = canvas.getContext('2d');
        	var image = document.getElementById('face');
        		console.log(image);
   		context.drawImage(image, 180, 120);
		}
    	  		
    	  function prepareImg() {
			   var canvas = document.getElementById('myCanvas');
			   document.getElementById('inp_img').value = canvas.toDataURL('image/jpeg');
			}		
											 
		clear_face()
    </script>
</head>
<body>
  
<div class = "grid-container">         
		<div class = "item2">         
        		
                <div id="my_camera" style = " width : 300, height:350, display: inline-block" class="center"></div>     
                Photo captured:
        	<div id="results" style = " width : 270, height:270, display: inline-block"; ></div> 
        	<br />                                        
                <br/>                              

				<img class="face" id="face" />

				<img src="image.jfif" style="display: none;" id = 'mascot'  />                 				  							          
        </div>

     


        <div class = "item3">
        	<!-- Please fill out the form below to generate pdf. Make sure you take a snapshot of your picture first. <br><br> -->
        		<h2 class="text-center">Report generator</h1>
        	<form method="POST" action="./form_cam.php"  onsubmit="prepareImg()">        		               
        		<label for = "name" > Name </label> <br>
        		<input type="text" name = "name">  </input> <br>
        		<label for = "vID" > VillanovaID </label> <br>
        		<input type="text" name = "vID">  </input>  <br>
        		<label for = "age" > Age </label> <br>
        		<input type="text" name = "age">  </input> <br>
        		<label for = "dept" > Department </label> <br>
        		<input type="text" name = "dept">  </input> <br>

        		<input type=button value="Take Snapshot" onClick="take_snapshot()">
                <!-- <input type="hidden" name="image" class="image-tag"> <br> <br>
                 -->

                 <input id="inp_img" name="image" type="hidden" value="">
        		<button class="btn btn-success">Generate PDF</button>


        	</form>
        			<button class="btn btn-success" onclick="apply_face()">Apply face</button>
        			<button class="btn btn-success" onclick="clear_face()">Clear</button>
        	<canvas id="myCanvas" width="300" height="500" >

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
            // $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';

            dataURLtoBlob(data_uri , function( blob )
				{		    		

				var data = new FormData();
				data.append("imageFile", blob, "file");
				 
				var xhr = new XMLHttpRequest();
				xhr.responseType = 'blob';
			
				xhr.withCredentials = false;

				xhr.addEventListener("readystatechange", function() {
				     if(this.readyState === 4) {		
				     // console.log(this.responseText);		     	
				    		console.log(this.response);
				           // document.getElementById("results").setAttribute('src', 'data:image/png;base64,' + btoa(String.fromCharCode.apply(null, new Uint8Array(this.responseText))));
				           var urlCreator = window.URL || window.webkitURL;
  						 var imageUrl = urlCreator.createObjectURL(this.response);
   						document.querySelector("#face").src = imageUrl;
				     }
				});

				xhr.open("POST", "https://api.cloudmersive.com/image/face/crop/first/round");

				xhr.setRequestHeader("Apikey", "fbdfda1c-1963-4b70-8963-dcb40d131a60");

				xhr.send(data);
			});  
        } );
    }
</script>
 
</body>
</html>