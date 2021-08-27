<?php

$kyplaceholder = "";
$p = 1;
foreach((array)$keywordFields as $f){ 
    if($p != 1){
        $kyplaceholder .= ", ";
    }
    $p++; 
    $kyplaceholder .= $str_convert->to_eye($f);
}?>
<input 
    type="text" name="keyword" 
    value="<?php echo $_SESSION[$module_name.'-search-keyword']?>" 
    placeholder="<?php echo ucfirst(str_replace("_", " ", $kyplaceholder))?>" 
    id="keyword" 
    autocomplete="off"
    style="width:200px;" 
/>

<div id="auto_list">
    <?php 
    foreach((array)$keywordFields as $f){
        foreach((array)$rows as $row){
            echo '<div class="auto_suggest_item">'.$row[$f].'</div>';
        }
    }
    ?>
</div>


<script>
$("#keyword").on('keyup dblclick', function(){
    
    var keyw = $(this).val();

    if( keyw != ''){
        $('#auto_list').fadeIn();
    }
    $( ".auto_suggest_item" ).each(function( index ) {
        var auto_suggest_item = $(this).text();
        if(auto_suggest_item.toLowerCase().includes(keyw.toLowerCase()) === true){
            $(this).fadeIn();
        }else{
            $(this).fadeOut();
        }
    });
});

$(".auto_suggest_item").on('click', function(){
    var str = $(this).html();
    $('#keyword').val(str); 
    $('#auto_list').fadeOut(); 

});

$(function() {
    $("body").click(function(e) {
        if (e.target.id == "auto_list" || $(e.target).parents("#auto_list").length || e.target.id == "keyword" ) {
            //alert("Inside div");
        } else {
            $('#auto_list').fadeOut();
        }
    });
})

</script>

<style>
#auto_list {
    /**/display:none;
    position:absolute;
    top:32px;	
    z-index:4;
    background: rgba(255,255,255,.9);;
    border:1px solid #CCC;
    box-shadow:2px 2px 4px rgba(0,0,0,.4);
}
#auto_list > div {
    padding:4px 10px;
    cursor:pointer;
}
#auto_list > div:hover {
    background: #EFEFEF;
}
</style>




