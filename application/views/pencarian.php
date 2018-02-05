<!-- Content -->
        <div class="container">
          <div class="row">
            <div class="col-md-8">

            <?php if(count($search)>=1):?>


                <?php foreach ($search as $brt):?>
                <div class="row">
                    <div class="col-md-6"><img src="<?php //echo base_url();?>assets/img/<?php //echo $brt->image; ?>" class = "img-thumbnail"></div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url().'/blog/detail/'.$brt['_id']; ?>"><h3><?php echo $brt['title'];?></h3></a>
                        
                        <p>
                          <?php echo word_limiter($brt['content'],50);?>
                        </p>
                    </div>
                </div>

                <?php endforeach; ?> 
        <?php else: ?>
                <label>Tidak Ada Hasil !</label>
            <?php endif; ?>
              </div>
<!-- Content -->