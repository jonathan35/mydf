<div id="locationModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-black" aria-hidden="true">&times;</span>
                </button>
                <div class="col-12 text-center">
                    <p class="text-black region-title">Select Region<p>
                    <ul class="list-unstyled components">
                        
                        <?php                         
                        if(@count($regions)>0){
                     
                            $enc_ses_region_id = $defender->encrypt('encrypt', $_SESSION['region']);

                            foreach((array)$regions as $region){
                                $enc_region_id = $defender->encrypt('encrypt', $region['id']);?>
                                <a class="category-item change-region" data-href="<?php echo $enc_region_id?>" style="cursor:pointer;" >
                                    <li class="">
                                        <div class="location-list p-3">
                                            <?php echo $region['region'];?>
                                        </div>
                                    </li>
                                </a>
                        <?php }
                        }?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$('.change-region').click(function(){

    var count_item = $('.summary-item-count-inner').html();
    var new_region = $(this).attr('data-href');
    var old_region = '<?php echo $enc_ses_region_id;?>';    
    var url = '';

    if(count_item !== undefined && old_region !='' && old_region != new_region){
        
        url = 'empty_cart';

        $(this).attr('data-dismiss', 'modal');
        $(this).attr('data-toggle', 'modal');
        $(this).attr('data-target', '#alertModal');
                
        $('#change_region_btn').html('<a type="submit" value="submit" class="btn alert-btn btn-block p-2" href="'+url+'?r='+new_region+'">Yes</a>');
    }else{        
        url = window.location.href.split('?')[0];
        window.location.href = url+'?r='+new_region;
    }
})
</script>
