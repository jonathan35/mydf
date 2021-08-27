<script src="js/jquery-3.5.0.js"></script>


<script>
function onSignIn(googleUser) {

    var profile = googleUser.getBasicProfile();
    var btnClicked = document.getElementById("btnClicked").value;
    /*console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    */    

    if(profile.getName() != '' && btnClicked == 'yes'){

        $.post( "api_login.php", {api:'signup', name:profile.getName(), email:profile.getEmail() })
		.done(function(msg){
			window.location.href = window.location.href;
		})
		.fail(function(xhr, status, error) {
			//alert('api_login'+xhr+status+error);
			document.getElementById('status').innerHTML ='Failed to login.';
		});
    }
}
</script>

<script src="https://apis.google.com/js/platform.js" async defer></script>


<meta name="google-signin-client_id" content="278749166183-ob7cf9lg2eint8kik16iohva29b3cblr.apps.googleusercontent.com">

<style>
.google_btn_width {
    max-width:133px;
    width:100%; margin:0 auto; box-shadow:2px 2px 2px rgba(0,0,0,.2); overflow:hidden; border-radius:4px; position:relative; left:-2px;
}
@media (max-width:602px){
.google_btn_width {
    max-width:128px;
    position:relative; left:-4px;
}
}
</style>

<div class="google_btn_width">
    <div class="g-signin2" data-onsuccess="onSignIn" onClick="imclick()" data-width="133px" data-height="40"></div>
</div>
<input type="hidden" id="btnClicked" value="no">


<script>

function imclick(){    
    document.getElementById("btnClicked").value = "yes";
}

function modifyStyle(){
    document.getElementsByClassName("abcRioButtonContents")[0].innerHTML = '<span style="font-size:16px; position:relative; left:-12px; top:2px;">Google</span>'
}

setTimeout(function() { modifyStyle(); }, 1000);




</script>

