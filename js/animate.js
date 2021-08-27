$(window).ready(function () {
    /*
    1. Find .scroll_animate targeted sub element by ani-sub=".sub_element"
    2. Add class like '.animate_pos1' to those sub element
    3. Hide all element in */    
    
    var pos = numItems = gpos = 0;
    var ani_sub = null;

    var target = '.animate_pos' + (gpos++);    
    
    $( ".scroll_animate" ).each(function() {
        $(this).addClass('animate_pos' + (pos++));
        var ani_sub = $(target).attr('ani-sub');
        $(ani_sub).css('visibility', 'hidden');

    });
})

function elementScrolled(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top + 200;
    return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
}

$(window).scroll(function(){
    // This is then function used to detect if the element is scrolled into view
    
    var gpos = 0;
    var numItems = 0;
    
    $( ".scroll_animate" ).each(function() {
        var target = '.animate_pos'+(gpos++);
        if(elementScrolled(target)) {
            
            var ani_sub = $(target).attr('ani-sub');
            var ani_class = $(target).attr('ani-class');

            if (ani_class == undefined || ani_class == null) {
                ani_class = 'fadeInUp';
            }
                      
            if (ani_sub !== undefined && ani_sub !== null) {
                target = ani_sub;
                numItems = $(target).length;
            }

            if (numItems > 1) {
                for (i = 0; i < numItems; i++) {
                    delay_animate(target, i, ani_class);
                }
            } else {
                $(target).addClass(ani_class);
            }
        }
    });

    function delay_animate(target, i, ani_class) {
        setTimeout(function () {
            $(target + ':eq(' + i + ')').css('visibility', 'visible');
            $(target + ':eq(' + i + ')').addClass(ani_class);
        }, (Number(i)+1)*400);
    }
});

