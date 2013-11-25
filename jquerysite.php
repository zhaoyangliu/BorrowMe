<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="jquerysite.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<!-- <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script> -->
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

<script>


var itemid = 1;
var userName = "";
var uid = 0;
var friendslist = new Object();
var filteredlist = new Object();
var uidlist = new Array();
var flist = "";

// function validateForm()
// {
// var x=document.forms["upload_form"]["radio-choice-1"].value;
// if (x==null || x=="")
//   {
//   alert("Please select one category, Thank you~");
//   return false;
//   }
// }
 

function refresh_searchpage(){
  document.getElementById("search_form").reset();
  document.getElementById('SearchHint').innerHTML = "Search Results:";
}

$(document).ready(function(){ 
  $("#search-radio-choice-1").click(function(){
    showBids("1");
    window.location.replace("#itemlist");
  });
  $("#search-radio-choice-2").click(function(){
    showBids("2");
    window.location.replace("#itemlist");
  });
  $("#search-radio-choice-3").click(function(){
    showBids("3");
    window.location.replace("#itemlist");
  });
  $("#search-radio-choice-4").click(function(){
    showBids("4");
    window.location.replace("#itemlist");
  });
  $("#search-radio-choice-5").click(function(){
    showBids("5");
    window.location.replace("#itemlist");
  });
  $("#search-radio-choice-6").click(function(){
    showBids("6");
    window.location.replace("#itemlist");
  });

});


function delete_item(item_id)
{

if (item_id=="")
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
      document.getElementById("DeleteHint").innerHTML=xmlhttp.responseText + "<br>" + "<br>" + "<br>";
      var x =document.getElementById('user_post_listview');
      var y =document.getElementById(item_id);
      x.removeChild(y)
      $("#profilepage").trigger ("create");
    }
  }
xmlhttp.open("GET","delete_item.php?q="+item_id,true);
xmlhttp.send();
}









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

      $("#itemlist").trigger ("create");
    }
  }
xmlhttp.open("GET","search.php?q="+flist,true);
xmlhttp.send();
}

// function getUserInfo(user_id)

// **********   by lzy: I have moved this part of function to other place  

// {

// if (user_id == 1){
//   user_id = uid;
// }

// if (user_id != 0){
  
//   if (window.XMLHttpRequest)
//   {// code for IE7+, Firefox, Chrome, Opera, Safari
//   xmlhttp=new XMLHttpRequest();
//   }
// else
//   {
// xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
// xmlhttp.onreadystatechange=function()
// {
//   if (xmlhttp.readyState==4 && xmlhttp.status==200)
//     {
//       document.getElementById("UserItems").innerHTML=xmlhttp.responseText;
//       if (user_id == uid) {
//         document.getElementById("profile_name").innerHTML = "Hello " + userName +  " , here is your posted items:" + "<br>" + "<br>" + "<br>" + "<br>" ;
//       }
//       $("#profilepage").trigger ("create");
//     } 
//   }

// xmlhttp.open("GET","usersearch.php?q="+user_id,true);
// xmlhttp.send();

// }


//}





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





<script>
//       $(document).ready(function() {
//   	$.ajaxSetup({ cache: true });
//   	$.getScript('//connect.facebook.net/en_UK/all.js', function(){
//     		FB.init({
//       			appId: '588618324507077',
//       			channelUrl: 'liuzy.net/BorrowMe/Dev/channel.html',
//       			status     : true, // check login status
// 			cookie     : true, // enable cookies to allow the server to access the session
//    	 	});     
//     		$('#loginbutton,#feedbutton').removeAttr('disabled');
//     	<!--FB.getLoginStatus(updateStatusCallback);-->
//   	});
//   	});
  	
  	
 function Logout() {
 	FB.logout(function(response){});
 	}

function refreshfront () {
	$("#frontpage").trigger ("create");
}


</script>

</head>

<body>
<!-- Start of first page: #one -->

<div data-role="page" id="frontpage">

	 

	<div data-role="content" align="center">
	<div>	
		<fb:login-button autologoutlink="true" show-faces="true" size="large" max-rows="4"></fb:login-button>
	</div>
		<img src="Category_Images/LNDR_LOGO.png" width=100% height=100% alt="">

	</div> 
		
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


      FB.Event.subscribe('auth.login', function() {
      	window.location = "#profilepage"; });
      FB.Event.subscribe("auth.logout", function() { 
        window.location = "#frontpage";
        window.location.reload();
           });
      FB.Event.subscribe('auth.authResponseChange', function(response) {
        // Here we specify what we do with the response anytime this event occurs. 
        if (response.status === 'connected') {
          // The response object is returned with a status field that lets the app know the current
          // login status of the person. In this case, we're handling the situation where they 
          // have logged in to the app.
          
          testAPI();
          getFriends();
          getUserInfo(1);
          window.location = "#profilepage";


        } else if (response.status === 'not_authorized') {
          // In this case, the person is logged into Facebook, but not into the app, so we call
          // FB.login() to prompt them to do so. 
          // In real-life usage, you wouldn't want to immediately prompt someone to login 
          // like this, for two reasons:
          // (1) JavaScript created popup windows are blocked by most browsers unless they 
          // result from direct interaction from people using the app (such as a mouse click)
          // (2) it is a bad experience to be continually prompted to login upon page load.
          FB.login();
        }// else {
          // In this case, the person is not logged into Facebook, so we call the login() 
          // function to prompt them to do so. Note that at this stage there is no indication
          // of whether they are logged into the app. If they aren't then they'll see the Login
          // dialog right after they log in to Facebook. 
          // The same caveats as above apply to the FB.login() call here.
          //FB.login();
        //}
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
    			console.log('Good to see you, ' + response.name + ':' + response.id + '.');
    			userName = response.name;
          			uid = response.id;
          			document.getElementById('owner').value=response.name;
          			document.getElementById('item_owner').value=response.id;
          			
        		});
        		};
      
      function getUserInfo(user_id)
      {

      FB.api('/me', function(response) 
        {
          if (user_id == 1){
            user_id = response.id;
          }          
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("UserItems").innerHTML=xmlhttp.responseText;
            if (user_id == uid) {
              //document.getElementById("profile_name").innerHTML = "Hello " + userName +  " , here is your posted items:" + "<br>" + "<br>" + "<br>" + "<br>" + "<fb:login-button autologoutlink=\"true\" show-faces=\"true\" size=\"large\" max-rows=\"4\"></fb:login-button> ";
              document.getElementById("profile_name").innerHTML = "Hello " + userName +  " , here is your posted items:" + "<br>" + "<br>";
              
              // for (i=0;i < y.length;i++){
              //     var z = document.createElement("a");
              //     var txtnode = document.createTextNode("delete");
              //     z.href = "#profilepage";
              //     z.data-rel = "dialog";

              //     //z.data-transaction = "slideup";
              //     z.appendChild(txtnode);
              //     y[i].appendChild(z);
              //   }
            }            
            $("#profilepage").trigger ("create");
          } 
        }

      if (user_id == uid) {
        xmlhttp.open("GET","usersearch.php?q="+user_id+"&p=1",true);
        xmlhttp.send();
      }
      else{
        xmlhttp.open("GET","usersearch.php?q="+user_id+"&p=0",true);
        xmlhttp.send();  
      }
      
      

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



 
  
  


  
  
  </div>
</div><!-- /page one -->




<div data-role="page" id="profilepage">

	<div data-role="header">
	  <h1>Profile</h1>
	  <a href="#" data-rel ="back" data-icon="back">Back</a>
	</div>
	
	<div data-role="content" align="center">
		<fb:login-button autologoutlink="true" class="fb-logout-button" size="large" max-rows="4"></fb:login-button>
		
		<script>
		// 	document.write("<h2>", response.name, "</h2>");
		</script>				
		<div id="UserItems"> Placeholder Text </div>
	</div>
	  


	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#profilepage" onclick="getUserInfo(1)" data-icon="home">My Profile</a></li>
		<li><a href="#searchpage" onclick = "refresh_searchpage()" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
</div>


<div data-role="page" id="uppage">
	
	<div data-role="header">
		<h1>Upload an Item</h1>
		<a href="#" data-rel ="back" data-icon="back">Back</a>
	</div>
	
	<div data-role="content" align="center">	
		<form name = "upload_form" action="http://liuzy.net/BorrowMe/Dev/saveBid.php" method="post" data-ajax="false" enctype="multipart/form-data">
<!-- 		<form name = "upload_form" action="http://liuzy.net/BorrowMe/Dev/saveBid.php" onsubmit="return validateForm()" method="post" data-ajax="false"> -->
    <div data-role="fieldcontain">
			<label for="itemname">Item Name:</label>
			<input type="text" name="itemname" id="itemname" class="input-text"><br><br>
			
			<fieldset data-role="controlgroup" data-type="horizontal">
				<legend>Select category:</legend>
         			<input type="radio" name="radio-choice-1" id="radio-choice-1" value="1"  />
         			<label for="radio-choice-1">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Tools.png" width="100/3%">
         			<br>Tools</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-2" value="2"  />
         			<label for="radio-choice-2">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Electronics.png" width="100/3%">
         			<br>Electronics</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-3" value="3"  />
         			<label for="radio-choice-3">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Sports.png" width="100/3%">
         			<br>Sports</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-4" value="4"  />
         			<label for="radio-choice-4">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Entertainment.png" width="100/3%">
         			<br>Entertainment</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-5" value="5"  />
         			<label for="radio-choice-5">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Clothing.png" width="100/3%">
         			<br>Clothing</label>
         			
         			<input type="radio" name="radio-choice-1" id="radio-choice-6" value="6"  />
         			<label for="radio-choice-6">
         			<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Transportation.png" width="100/3%">
         			<br>Transportation</label>
         		</fieldset>
         				
			<br><br>
			<label for="descrip">Description:</label>
			<input type="text" name="descrip" id="descrip" class="input-text" ><br><br>
			<label for="image">Upload Image</label>
			<input type=file accept="image/*" name="file" id="image" class="input-text" ><br><br>
			<input type="hidden" name="owner" id="owner" value = "">
			<input type="hidden" name="item_owner" id="item_owner" value = 0>
			<label for="contactemail">Email:</label>
			<input type="text" name="contactemail" id="contactemail" class="input-text"><br><br>
			<label for="contactphone">Phone Number:</label>
			<input type="text" name="contactphone" id="contactphone" class="input-text"><br><br>
			
			<input type="submit" value = "Submit" >
		</div>
		</form>
	</div>
		
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#profilepage" onclick="getUserInfo(1)" data-icon="home">My Profile</a></li>
		<li><a href="#searchpage" onclick = "refresh_searchpage()" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
	
</div>

<div data-role="page" id="searchpage">

	<div data-role="header">
	  <h1>Search for Items</h1>
	  <a href="#" data-rel ="back" data-icon="back">Back</a>
	</div>

	<div data-role="content">
		<!-- <div data-role="fieldcontain"> -->
			<!--<ul data-role="listview" data-inset="true" data-filter="true">-->
			
    <form name = "search_form" id = "search_form">  
	<fieldset data-role="controlgroup" data-type="horizontal" align="center">
			<!-- <legend>Select category:</legend> -->
         		<input type="radio" name="radio-choice-1" id="search-radio-choice-1" value="1" />
         		<label for="search-radio-choice-1" size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Tools.png" width="100/2%" >
         		<br>Tools</label>
         		
         		<input type="radio" name="radio-choice-1" id="search-radio-choice-2" value="2" >
         		<label for="search-radio-choice-2"  size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Electronics.png" width="100/2%"/>
         		<br>Electronics</label>
         		

          </fieldset>
          
          <fieldset data-role="controlgroup" data-type="horizontal" align="center">
         		<input type="radio" name="radio-choice-1" id="search-radio-choice-3" value="3"  />
         		<label for="search-radio-choice-3"  size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Sports.png" width="100/2%">
         		<br>Sports</label>
         		
         		<input type="radio" name="radio-choice-1" id="search-radio-choice-4" value="4" />
         		<label for="search-radio-choice-4"  size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Entertainment.png" width="100/2%" >
         		<br>Entertainment</label>
          </fieldset>

      <fieldset data-role="controlgroup" data-type="horizontal" align="center">

         		
         			
         		<input type="radio" name="radio-choice-1" id="search-radio-choice-5" value="5" >
         		<label for="search-radio-choice-5"  size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Clothing.png" width="100/2%"/>
         		<br>Clothing</label>
         		
         		<input type="radio" name="radio-choice-1" id="search-radio-choice-6" value="6"  />
         		<label for="search-radio-choice-6"  size = "width: 25%">
         		<img src="http://www.liuzy.net/BorrowMe/Dev/Category_Images/Transportation.png" width="100/2%" >
         		<br>Transportation</label>
      </fieldset>
      
      


    </form>

           


	<div data-role="footer" data-position="fixed">
	  <div data-role="navbar">
		<ul>
		<li><a href="#profilepage" onclick="getUserInfo(1)" data-icon="home">My Profile</a></li>
		<li><a href="#searchpage" onclick = "refresh_searchpage()" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
	  </div>
	</div>
</div>
</div>


<div data-role="page" id="itemlist">

	<div data-role="header">
	  <h1>Search results</h1>
	  <a href="#" data-rel ="back" data-icon="back">Back</a>
	</div>

	<div data-role="content">
		<div id="SearchHint">Search Results</div>
	</div>
	
	
	<div data-role="footer" data-position="fixed">
	  <div data-role="navbar">
		<ul>
		<li><a href="#profilepage" onclick="getUserInfo(1)" data-icon="home">My Profile</a></li>
		<li><a href="#searchpage" onclick = "refresh_searchpage()" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
	  </div>
	</div>
</div>

	
<div data-role="page" id="confirmed">

	<div data-role="header">
	  <h1>Item Uploaded!</h1>
	  <a href="#" data-rel ="back" data-icon="back">Back</a>
	</div>
	
	<div data-role="content" align="center">
		<b>Your item has been successfully uploaded!</b>
	</div>
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#profilepage" onclick="getUserInfo(1)" data-icon="home">My Profile</a></li>
		<li><a href="#searchpage" onclick = "refresh_searchpage()" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
</div>

<div data-role="page" id="failed">

	<div data-role="header">
	  <h1>Upload Failure!</h1>
	  <a href="#" data-rel ="back" data-icon="back">Back</a>
	</div>
	
	<div data-role="content" align="center">
		<b>Something exploded!  Please summon the devs!</b><br>
	</div>
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#profilepage" onclick="getUserInfo(1)" data-icon="home">My Profile</a></li>
		<li><a href="#searchpage" onclick = "refresh_searchpage()" data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
</div>

<div data-role="page" id="iteminfo">

	<div data-role="header">
		<h1>Item Information</h1>
		<a href="#" data-rel ="back" data-icon="back">Back</a>
	</div>
	
	<div data-role="content">
		<div id="ItemHint">Full Item Information Loading...</div>
	</div>
	
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
		<li><a href="#profilepage" onclick="getUserInfo(1)" data-icon="home">My Profile</a></li>
		<li><a href="#searchpage"  data-icon="search">Search Items</a></li>
		<li><a href="#uppage" data-icon="arror-r">Upload Item</a></li>
	  	</ul>
		</div>
	</div>
</div>



</body>

</html>