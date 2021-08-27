


function update_cart(uid){
    
    var pid = $('#a2cinput'+uid).attr('data-id');
    var qty = $('#a2cinput'+uid).val();

    if(qty>=0){        
        $.post('add_to_cart_button_qry.php', {u:pid, q:qty},function(data){
            $('#cart_summary').load('cart_summary.php');            
            
            //Only for shopping cart page -----------
            update_total_price(uid, qty);

            var summary_panel = $('#summary_panel').attr('data-exist');
            
            if(summary_panel == 'yes'){
                $('#right_column').load('cart_summary_panel.php');
            }
  
            
            if(qty==0){
                $("#item"+uid).fadeOut();
            }

            return true;
        })
    }

    if(qty>0){
        $('.added_label').fadeIn();
    }

    return false;
}


function update_total_price(uid, qty){
    var unitprice = $("#total_price"+uid).attr('data-unit-price');
    var new_total = unitprice*qty;
    $("#total_price"+uid).html('RM'+parseFloat(new_total).toFixed(2));
}




function remove_item(uid){
    $('#a2cinput'+uid).val('0');
    update_cart(uid);
}






$('.add_to_cart').click(function(){
    
    var uid = $(this).attr('data-uid');    
    $(this).css('display', 'none');
    $('#a2c'+uid).css('display', 'flex');
    $('#a2cinput'+uid).val('1');
    update_cart(uid);
    
    $('.overlay'+uid).css('opacity', '0.8');
    
    setTimeout(function() {
        $('.overlay'+uid).css('opacity', '0');
    }, 1000);
})

$('.a2c_left').click(function(){
    var uid = $(this).attr('data-uid'); 
    var qty = $('#a2cinput'+uid).val();    
    qty = Number(qty)-1;
    $('#a2cinput'+uid).val(qty);
    if(qty<=0){
        $('#a2c'+uid).css('display', 'none');
        $('#add_to_cart'+uid).css('display', 'block');
    }
    update_cart(uid);
})

$('.a2c_right').click(function(){
    var uid = $(this).attr('data-uid');    
    var qty = $('#a2cinput'+uid).val();   
    var max = $('#a2cinput'+uid).attr('max');
    qty = Number(qty)+1;    
    
    if(Number(qty)>Number(max)){
        $('#a2cinput'+uid).val(max);
    }else{
        $('#a2cinput'+uid).val(qty);        
    }
    update_cart(uid); 
})


$('.addtocart').keyup(function(){
    var uid = $(this).attr('data-uid');
    var qty = $(this).val();
    var max = $(this).attr('max');    
    
    if(Number(qty)<0){
        $(this).val(0);
    }else if(Number(qty)>Number(max)){
        $(this).val(max);
    }
    update_cart(uid);
})
