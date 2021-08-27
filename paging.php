<?php 
/*
$itemCount & $maxPerPage is define before item list start, sample code as below:
	
	$itemCount=1;
	$maxPerPage=3;
	<div class="page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>"></div>	
	
	$itemCount++;
*/



if($itemCount>$maxPerPage){?>
<!---------------------------Paging-start------------------------------>
<div class="col-12 text-center" style="display:flex;">
<div></div>
<nav id="Pagination" style="margin:auto;">
<ul class="pagination">

    <?php 
    $btnGroup = 1;
    $iCount = $itemCount-1;
    $numOfPage=$iCount/$maxPerPage;
    if(($iCount%$maxPerPage)>0){$numOfPage+=1;}

    $maxBtnGroup = 6;
    $totalGroup = ceil($numOfPage/$maxBtnGroup);

    if($numOfPage>$maxBtnGroup){?>
        <li class="page-item" onClick="return prevBtnGroup();">
            <a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a>
        </li>
    <?php }

	
    for($p=1;$p<=$numOfPage;$p++){
        $cbtnGroup = ceil($p/$maxBtnGroup);
        ?>
        <li class="page-item cbtnGroup cbtnGroup<?php echo $cbtnGroup?>" style="<?php if($p>$maxBtnGroup){?> display:none;<?php }?>" onClick="return openPage('<?php echo $p?>');">
            <a href="#" class="page-link"><?php echo $p?></a>
        </li>
    <?php }
    
    
    if($numOfPage>$maxBtnGroup){?>
        <li class="page-item" onClick="return nextBtnGroup();">
            <a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a>
        </li>
    <?php }?>

</ul>
</nav>
<div></div>
</div>

<input id="currentGroup" value="1" type="hidden">
<input id="currentPage" value="1" type="hidden">


<script>

function prevBtnGroup(){
   
    var currentGroup = Number($('#currentGroup').val());
    var totalGroup = Number('<?php echo $totalGroup?>');
    var newGroup;

    if(currentGroup>1){
        newGroup = currentGroup-1;
        $('#currentGroup').val(newGroup);        
        $('.cbtnGroup').css('display','none');        
        $('.cbtnGroup'+newGroup).css('display','block');
    }
    
    return false;
}
function nextBtnGroup(){
    
    var currentGroup = Number($('#currentGroup').val());
    var totalGroup = Number('<?php echo $totalGroup?>');
    var newGroup;

    if(currentGroup<totalGroup){
        newGroup = currentGroup+1;
        $('#currentGroup').val(newGroup);
        $('.cbtnGroup').css('display','none');
        $('.cbtnGroup'+newGroup).css('display','block');
    }
    return false;
}

function openPage(page){
  
    $('#currentPage').val(page);
    var to = Number(page)*Number(<?php echo $maxPerPage?>);
    var from = Number(to)-<?php echo $maxPerPage?>+1;
    $(".page").hide();
    
    for (var i = from; i <= to; i++) {
        //$(".page"+i).css("display", "");
        $(".page"+i).fadeIn();
    }
    
    hideBannerScrollTop();
    rearrangeNum();
    return false;
}

function hideBannerScrollTop(){
    $('.homeBanner').hide();
    $("html, body").stop().animate({scrollTop:0}, 200, 'swing', function() { 
        //alert("Finished animating");
    });
}

function firstPageOnly(){
    
    $('.page').each(function(e){
        $(e).fadeOut();
    })
}

firstPageOnly();


function rearrangeNum(){
    var num = 0;
    $('#project_listing  > tbody > tr').each(function(a) {
		//if($(this).css('display') == 'table-row'){
			
			$(this).find('td:first').text((num+=1)+'.');
		//}
    })    
}
</script>

<script>
$('.page-link').click(function(){                
    $('.page-link').removeClass('page-link-active');
    $(this).addClass('page-link-active');
})
</script>
<!---------------------------Paging-end------------------------------>
<?php }?>
                  

