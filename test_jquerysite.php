<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<link rel="stylesheet" style="text/css" href="jquerysite.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>


<script>

var itemid = 1;
var userName = "";
var uid = 0;
var friendslist = new Object();
var filteredlist = new Object();
var uidlist = new Array();
var flist = "";

function saveBids(str)
{
alert("We are storing your bid");

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","getuser.php?q="+str,true);
xmlhttp.send();
}


function showBids(str)
{
uidlist[0] = str;
flist = uidlist.join(',');


if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	document.getElementById("SearchHint").innerHTML=xmlhttp.responseText;

      //$("#searchpage").collapsible ();
    }
  }
xmlhttp.open("GET","search.php?q="+flist,true);
xmlhttp.send();
}





function getItemInfo(int)
{
if (int==null)
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	document.getElementById("ItemHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","iteminfo.php?q="+int,true);
xmlhttp.send();
}

</script>


    <title>jQuery Example</title>
    <script>
      $(document).ready(function() {
  	$.ajaxSetup({ cache: true });
  	$.getScript('//connect.facebook.net/en_UK/all.js', function(){
    		FB.init({
      			appId: '588618324507077',
      			channelUrl: 'liuzy.net/BorrowMe/Dev/channel.html',
      			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
   	 	});     
    		$('#loginbutton,#feedbutton').removeAttr('disabled');
    	//FB.getLoginStatus(updateStatusCallback);
  	});
  	});
  	
</script>


</head>

<body>
<!-- Start of first page: #one -->
<?php
    session_start();
?>
<div id="fb-root"></div>
<div data-role="page" id="frontpage">

	<div data-role="header">
		<h1 align="center">BorrowMe</h1>
	</div><!-- /header -->

	<div data-role="content" align="center">	
		<h1> Welcome to BorrowMe!</h1>
		<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '588618324507077', // App ID
    channelUrl : 'liuzy.net/BorrowMe/Dev/channel.html', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
      getFriends();
       
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
	function testAPI() {
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', function(response) 
		{
			console.log('Good to see you, ' + response.name + '.');
			userName = response.name;
      			uid = response.id;
      			document.getElementById('owner').value=response.name;
      			document.getElementById('item_owner').value=response.id;
      			
    		});
    		};
  
    
   function getFriends() {
   	FB.api('/me/friends?fields=installed,name', function(response) {
   		var counter = 1;
   		friendslist = response.data;
   		for (var i=0; i<friendslist.length; i++) 
   		{
   			if(friendslist[i].installed == true)
   			{
   				uidlist[counter] = friendslist[i].id;
   				counter++;
   			}
   		}
   	});
   	}; 
 
</script>
		
		<fb:login-button autologoutlink="true" show-faces="true" size="large" max-rows="4"></fb:login-button>
		
		
 		
		<img src="http://www.sl-designs.com/images/free-backgrounds/sm-face_sl-designs1024x768.jpg" align="center" width="100%">
	</div>
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#frontpage" data-icon="home">Home</a></li>
		<li><a href="#searchpage" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload an Item</a></li>
	  	</ul>
		</div>
	</div>
</div><!-- /page one -->

<div data-role="page" id="uppage">
	
	<div data-role="header">
		<h1>BorrowMe</h1>
	</div>
	
	<div data-role="content" align="center">	
		<form action="http://liuzy.net/BorrowMe/Dev/saveBid.php" method="post" data-ajax="false">
		<div data-role="fieldcontain">
			<label for="itemname">Item Name:</label>
			<input type="text" name="itemname" id="itemname"><br><br>
			
			<fieldset data-role="controlgroup" data-type="horizontal">
				<legend>Select category:</legend>
         			<input type="radio" name="radio-choice-1" id="radio-choice-1" value="1"  />
         			<label for="radio-choice-1">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Tools.jpg" width="100/3%">
         			<br>Tools</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-2" value="2"  />
         			<label for="radio-choice-2">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Electronics.jpg" width="100/3%">
         			<br>Electronics</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-3" value="3"  />
         			<label for="radio-choice-3">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Sports.jpg" width="100/3%">
         			<br>Sports</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-4" value="4"  />
         			<label for="radio-choice-4">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Entertainment.jpg" width="100/3%">
         			<br>Entertainment</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-5" value="5"  />
         			<label for="radio-choice-5">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Clothing.jpg" width="100/3%">
         			<br>Clothing</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-6" value="6"  />
         			<label for="radio-choice-6">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Transportation.jpg" width="100/3%">
         			<br>Transportation</label>
         		</fieldset>
         				
			<br><br>
			<label for="descrip">Description:</label>
			<input type="text" name="descrip" id="descrip" ><br><br>
			<label for="image">Upload Image</label>
			<input type=file accept="image/*" name="image" id="image"><br><br>
			<input type="hidden" name="owner" id="owner" value = "">
			<input type="hidden" name="item_owner" id="item_owner" value = 0>
			<label for="contactemail">Email:</label>
			<input type="text" name="contactemail" id="contactemail"><br><br>
			<label for="contactphone">Phone Number:</label>
			<input type="text" name="contactphone" id="contactphone"><br><br>
			
			<input type="submit" value = "Submit" >
		</div>
		</form>
	</div>
		
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#frontpage" data-icon="home">Home</a></li>
		<li><a href="#searchpage" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
	
</div>

<div data-role="page" id="searchpage">

	<div data-role="header">
	  <h1>BorrowMe</h1>
	</div>

	<div data-role="content">
		<!-- <div data-role="fieldcontain"> -->
			<!--<ul data-role="listview" data-inset="true" data-filter="true">-->
      <button>show the result</button>

			<fieldset data-role="controlgroup" data-type="horizontal" align="center">
			<!-- <legend>Select category:</legend> -->
         		<input type="radio" name="radio-choice-1" id="radio-choice-1" value="1" />
         		<label class="radio_choice" for="radio-choice-1" size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Tools.jpg" width="100/3%" >
         		<br>Tools</label>
         		
         		<input type="radio" name="radio-choice-1" id="radio-choice-2" value="2" >
         		<label for="radio-choice-2" onclick = showBids('2') size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Electronics.jpg" width="100/3%"/>
         		<br>Electronics</label>
         		
         		<input type="radio" name="radio-choice-1" id="radio-choice-3" value="3"  />
         		<label for="radio-choice-3" onclick = showBids('3') size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Sports.jpg" width="100/3%">
         		<br>Sports</label>
          </fieldset>

      <fieldset data-role="controlgroup" data-type="horizontal" align="center">

         		<input type="radio" name="radio-choice-1" id="radio-choice-4" value="4" />
         		<label for="radio-choice-4" onclick = showBids('4') size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Entertainment.jpg" width="100/3%" >
         		<br>Entertainment</label>
         			
         		<input type="radio" name="radio-choice-1" id="radio-choice-5" value="5" >
         		<label for="radio-choice-5" onclick = showBids('5') size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Clothing.jpg" width="100/3%"/>
         		<br>Clothing</label>
         		
         		<input type="radio" name="radio-choice-1" id="radio-choice-6" value="6"  />
         		<label for="radio-choice-6" onclick = showBids('6') size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Transportation.jpg" width="100/3%" >
         		<br>Transportation</label>
      </fieldset>


           
          <div id="SearchHint">Search Results
          





          </div>
      




<!--         <div id="ResultListview" data-role="collapsible" >
          <h3>Section 1</h3>
            <p>I am the collapsible set content for section 1.</p> 
        </div> -->

	 

<!--
<li>
<div data-role="collapsible"  >
<h3  onclick = "showBids('Tools')" >Tools</h3>
  <div id="ToolsHint" data-role="collapsible" ><b>Loading...</b></div>
</div>
</li>

<li>
<div data-role="collapsible"  >
  <h3 onclick = "showBids('Electronics')" >Electronics</h3>
  <div id="ElectronicsHint"><b>Loading...</b></div>
</div>
</li>


<li>
<div data-role="collapsible"  >
  <h3 onclick = "showBids('Sports')" >Sports</h3>
  <div id="SportsHint"><b>Loading...</b></div>
</div>
</li>

<li>
<div data-role="collapsible"  >
  <h3 onclick = "showBids('Entertainment')" >Entertainment</h3>
  <div id="EntertainmentHint"><b>Loading...</b></div>
</div>
</li>

<li>
<div data-role="collapsible"  >
  <h3 onclick = "showBids('Clothing')" >Clothing</h3>
  <div id="ClothingHint"><b>Loading...</b></div>
</div>
</li>


<li>
<div data-role="collapsible"  >
  <h3 onclick = "showBids('Transportation')" >Transportation</h3>
  <div id="TransportationHint"><b>Loading...</b></div>
</div>
</li>
</ul>
-->
</div>

	<div data-role="footer" data-position="fixed">
	  <div data-role="navbar">
		<ul>
		<li><a href="#frontpage" data-icon="home">Home</a></li>
		<li><a href="#searchpage" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
	  </div>
	</div>

</div>

<div data-role="page" id="confirmed">

	<div data-role="header">
	  <h1>BorrowMe</h1>
	</div>
	
	<div data-role="content" align="center">
		<b>Your item has been successfully uploaded!</b>
	</div>
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#frontpage" data-icon="home">Home</a></li>
		<li><a href="#searchpage" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
</div>

<div data-role="page" id="failed">

	<div data-role="header">
	  <h1>BorrowMe</h1>
	</div>
	
	<div data-role="content" align="center">
		<b>Something exploded!  Please summon the devs!</b><br>
	</div>
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#frontpage" data-icon="home">Home</a></li>
		<li><a href="#searchpage" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
</div>

<div data-role="page" id="iteminfo">

	<div data-role="header">
		<h1>BorrowMe</h1>
		<a href="#searchpage" data-icon="back">Back</a>
	</div>
	
	<div data-role="content">
		<div id="ItemHint">Full Item Information Loading...</div>
	</div>
	
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#frontpage" data-icon="home">Home</a></li>
		<li><a href="#searchpage" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
</div>


</body>

</html>
<script>
$(document).ready(function(){
  $(".radio_choice").click(function(){
    $.ajax({
      type:"GET",
      url:"search.php",
      data:{ q:"1"},
      success:function(result){
        $("#SearchHint").html(result);
        $('#id2').collapsible();
      }
    });
  });
});

</script>




