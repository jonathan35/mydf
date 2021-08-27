<? 
$devs = sql_read("select * from developer where status=? order by position asc" , 'i', 1);

$n = $c = 0;
$developers = array();
foreach((array)$devs as $dev){
	if($n%4==0){
		$c++;
	}
	$developers[$c][$n] = $dev;
	$n++;
}
?>


<div class="row">
    <div class="col-10 offset-1 d-none d-md-block" style="font-size:14px;">
      <div class="bd-example" data-example-id="">
          <div id="carouselBlock" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox" style="padding:40px; height:220px;">                 
            <?php 
            $o = 0;
            foreach((array)$developers as $developer){?>
              <div class="carousel-item <? if($o==0){?>active<? }?>">
                <div class="row">
                    <? foreach((array)$developer as $n){?>
                    <div class="col-12 col-md-3" style="background-position: center; background-repeat: no-repeat; background-size: contain; height: 120px; background-image:url('<?php echo $n['developer_photo']?>')">
                    </div>	
                    <?php }?>
                </div>                     
              </div>
          <?php 
          $o++;
          }?>
              
            </div>

            <?php if($c>1){?>
            <a class="carousel-control-prev noedit" href="#carouselBlock" role="button" data-slide="prev" style="width:60px; ">
              <i class="fa fa-chevron-left" aria-hidden="true" style="color:rgba(0,0,0,.5); font-size:20px;"></i>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next noedit" href="#carouselBlock" role="button" data-slide="next" style="width:60px; ">
            <i class="fa fa-chevron-right" aria-hidden="true" style="color:rgba(0,0,0,.5); font-size:20px;"></i>
              <span class="sr-only">Next</span>
            </a>
            <?php }?>
          </div>
      </div>
    </div>
</div>



<div class="row d-md-none">
    <div class="col-12" style="font-size:14px;">
      <div class="bd-example" data-example-id="">
          <div id="carouselBlock2" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox" style="padding:40px; height:140px;">                 
            <?php 
            $o = 0;
            foreach((array)$developers as $developer){
              foreach((array)$developer as $n){?>
                <div class="carousel-item <? if($o==0){?>active<? }?>"  style="background-position: center; background-repeat: no-repeat; background-size: contain; height: 60px; background-image:url('<?php echo $n['developer_photo']?>')">
                </div>
              <?php 
              $o++;
              }
            }?>              
            </div>

            <?php if($o>1){?>
            <a class="carousel-control-prev noedit" href="#carouselBlock2" role="button" data-slide="prev" style="width:60px; ">
              <i class="fa fa-chevron-left" aria-hidden="true" style="color:rgba(0,0,0,.5); font-size:20px;"></i>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next noedit" href="#carouselBlock2" role="button" data-slide="next" style="width:60px; ">
            <i class="fa fa-chevron-right" aria-hidden="true" style="color:rgba(0,0,0,.5); font-size:20px;"></i>
              <span class="sr-only">Next</span>
            </a>
            <?php }?>
          </div>
      </div>
    </div>
</div>



