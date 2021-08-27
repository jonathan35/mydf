/*--------------------------------------------------------------------
F001. Click a trigger to post a php file with parameters to target area
F002 Click a trigger to load a php file to target area
F003. Parent select to filter child select's option
--------------------------------------------------------------------*/

/* --------------F001. Click a trigger to post a php file with parameters to target area  ---------- 
Apply class="navigator" nav-target="#target_area" nav-link="your_php_page.php" nav-post='{"post_name":"post_value"}' in where u want click (trigger)
-------------------------------------------------------------------- */
function post_into(e) {
  
  var target = $(e).attr("nav-target");
  var link = $(e).attr("nav-link");
  var post = $(e).attr("nav-post");
  var post_obj = JSON.parse(post);

  $.post(link, post_obj).done(function (data) {
    $(target).html(data);
  });
}

$(".navigator").click(function () {
  post_into(this);
  /*window.scrollTo(0, 0);*/
});

/* --------------F002. Click a trigger to load a php file to target area  ----------------- 
1. Apply class="nav-fade" in where u want click (trigger)
2. Apply nav-target="#target_area" nav-link="your_php_page.php"
--------------------------------------------------------------------*/
$(".nav-fade").click(function () {
  event.preventDefault();

  var target = $(this).attr("nav-target");
  var link = $(this).attr("nav-link");

  $(target).load(link);
  $(target).css("display", "none");
  $(target).fadeIn();
});


/* --------------F003 Parent select to filter child select's option ----------------- 
1. Apply class="parent-filter-child" in parent's select
2. Apply parent-name="parent_name" parent-value="parent_value" in child's option
--------------------------------------------------------------------*/
$(".parent-filter-child").on('change', function () {
  var parent_value = $(this).children("option:selected").val();
  var parent_name = $(this).attr("name");
  $("[parent-name=" + parent_name + "]").css("display", "none");
  var child_name = $("[parent-name=" + parent_name + "]").parent().attr("name");
  $("[name=" + child_name + "]").val('first value');
  

  $("[parent-name=" + parent_name + "][parent-value=" + parent_value + "]").css(
    "display",
    "block"
  );
});


/* --------------F004. Post a php file with to targeted area ---------- 
1. Apply class="ajax_form" in form
2. Apply action="php_file_to_post.php" in form
3. Apply target="#result_target" in form 
4. id="result_target" in targeted result place
-------------------------------------------------------------------- */
$(".ajax_form").submit(function () {
  event.preventDefault();
  alert();
  var $form = $(this),
    php_file_to_post = $form.attr("action"),
    result_target = $form.attr("target"),
    data = $form.serialize();

  $.post(php_file_to_post, data).done(function (result) {
    $(result_target).html(result);
  });
});


/* --------------F005. real time (keyup) validate for unique ---------- 
1. Apply class="keyup-validate" in input
2. Apply validate-input="table_column_name_to_validate"
3. Apply validate-result="#validate_result"
4. Apply <div id="validate_result"></div> to where you want display result.
5. Copy keyup_validate.php
-------------------------------------------------------------------- */
$(".keyup-validate").keyup(function () {
  $.post('config/keyup_validate.php', data).done(function (result) {
    $(result_target).html(result);
  });
  
});


/* --------------F006. Toggle input between password & text ---------- 
1. Required css (.password_text_toggle), png, jquery
2. <div class="password_text_toggle" for="#password_input_id"></div> after password input
3. Apply id="password_input_id" in password field
-------------------------------------------------------------------- */
$('.password_text_toggle').click(function () {

  var id = $(this).attr('for');
  var input_type = $(id).attr('type');

  if (input_type == 'password') {
    $(id).attr('type', 'text');
  } else {
    $(id).attr('type', 'password');
  }

})

