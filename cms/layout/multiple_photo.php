<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  #sortable { border:1px dashed #CCC; background-color:#EFEFEF; padding:20px;}
  #sortable div { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; display:inline-block; width:150px; height:100px;}
  #sortable div span { position: absolute; margin-left: -1.3em; }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <?php /*  
  <script src="../js/dropzone.js"></script>
  <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">*/?>
  
</head>
<body>
<?php /*
<form action="../../photo" class="dropzone" style="border:1px dashed blue">
     <div class="fallback" id="sortable" style="border:1px dashed green">
          <input name="file" type="file" multiple style="border:1px dashed red"/>
     </div>
</form>
*/?>

<div id="sortable" class="col-lg-12">
  <div class="ui-state-default"><span class="glyphicon glyphicon-move"></span>Item 1</div>
  <div class="ui-state-default"><span class="glyphicon glyphicon-move"></span>Item 2</div>
  <div class="ui-state-default"><span class="glyphicon glyphicon-move"></span>Item 3</div>
  <div class="ui-state-default"><span class="glyphicon glyphicon-move"></span>Item 4</div>
  <div class="ui-state-default"><span class="glyphicon glyphicon-move"></span>Item 5</div>
  <div class="ui-state-default"><span class="glyphicon glyphicon-move"></span>Item 6</div>
  <div class="ui-state-default"><span class="glyphicon glyphicon-move"></span>Item 7</div>
</div>


<script>
$( function() {
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
	/*$( "#sortable" ).droppable({
      drop: function( event, ui ) {
      }
    });*/

});


var x = document.getElementById("sortable");
x.addEventListener("dragover",function(e){e.preventDefault();dropfile();},false);
x.addEventListener("drop",function(e){e.preventDefault();dropfile();},false);

function dropfile() {      	alert();

    return false;
};


/*
$( "#sortable" ).mouseover(function() {
     alert('adsdsdsad');
});*/
$("div#sortable").dropzone({ url: "../../photos" });
</script>

</body>
</html>