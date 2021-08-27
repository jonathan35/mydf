<script src="js/jquery-3.5.0.js"></script>

<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      apiRespond();
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '719532005488373',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v7.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      //I don't want check when page load, only check after click facebook login button.
	  //statusChangeCallback(response);        // Returns the login status.
    });
  };

  
  (function(d, s, id) {                      // Load the SDK asynchronously
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

 
  function apiRespond() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');

    FB.api('/me', { locale: 'en_US', fields: 'name, email' }, function(response) {
      console.log('Successful login for: ' + response.name);

		/* Unhide this to display result of facebook login
		document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name  + '!';*/
		
		local_login(response.name, response.email);

    });
  }


  function local_login(name, email){

	$.post( "api_login.php", {api:'signup', name:name, email:email })
		.done(function(msg){
			window.location.href = window.location.href;
		})
		.fail(function(xhr, status, error) {
			//alert('api_login'+xhr+status+error);
			document.getElementById('status').innerHTML ='Failed to login.';
		});
  }


</script>


<div style="max-width:136px; width:100%; margin:0 auto;"><!--  box-shadow:2px 2px 2px rgba(0,0,0,.2)-->
	<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""> Facebook
	</fb:login-button>
</div>
<!-- Unhide this to display result of facebook login
<div id="status">
</div>-->



<style>
.fb-login-button, .fb-login-button > span, .fb-login-button > span > iframe, .pluginLoginButton, ._29o8  {	
	width:100% !important;
	max-width:100% !important;
}
._5h0d > ._5h0i, ._5h0c {
  width:136px !important;
}
._5h0c._5h0d {
  min-width: 136px !important;;
  width:136px !important;
}
</style>

<script>
$(document).ready(function(){
  $('._5h0c').css('width', '136px !important');
  $('._5h0c').css('minwidth', '136px !important');
})
</script>







