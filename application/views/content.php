<!-- Content -->
        <div class="container">
          <div class="row">
            <div class="col-md-8">
                <?php foreach ($berita as $brt){?>
                <div class="row">
                    <div class="col-md-6"><img src="<?php //echo base_url().'assets/img/'.$brt['img']; ?>" class = "img-thumbnail"></div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url().'blog/detail/'.$brt['_id']; ?>"><h3><?php echo $brt['title'];?></h3></a>
                        <a href=""><i class="fa fa-user-circle-o" aria-hidden="true"></i>DOTcom | <?php echo $brt['date_published'];?></a>
                        <p>
                          <?php echo word_limiter($brt['content'],35);?>
                        </p>
                    </div>
                </div>
                <?php };  ?>
            </div>
<!-- Content -->  
