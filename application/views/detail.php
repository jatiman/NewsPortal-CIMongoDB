<!-- Content -->
        <div class="container">
          <div class="row">
            <div class="col-md-8">
                  <?php //var_dump($detail);?>
                  <h2><?php echo $detail[0]['title'];?></h2>

                  <div class="form-group" id="picDiv" style="display:<?php echo empty($detail[0]['image_metadata']) ? 'none' : 'block'; ?>">
                        <label for="video" class="col-sm-2 control-label"></label>
                        <div class="col-md-10">
                          <ul class="enlarge" id="selUl">
                            <?php 
                            if (is_array($detail[0]['image_metadata']) && count($detail[0]['image_metadata']) > 0) {
                            ?>
                            <li>
                              <a href="<?php echo base_url('blog/show_image?filename=').$detail[0]['image_metadata']['filename'] ?>" target="_blank" data-mediabox="Selected Pictures" data-title="<?php echo $detail[0]['image_metadata']['filename']?>">
                                <img src="<?php echo base_url('blog/show_image?filename=').$detail[0]['image_metadata']['filename'] ?>" alt="<?php echo $detail[0]['image_metadata']['filename']?>" style="max-height:200px" />                        
                              </a>
                            <li>
                            <?php
                            }
                            ?>
                          </ul>
                        </div>
                  </div>
                  <hr>
                  <p align="justify">
                        <?php echo $detail[0]['content'];?>
                  </p>
                  <br><br>

                  <h2>Komentar</h2>
                        <?php if(validation_errors()==TRUE){?>
                              <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aira-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong><?php echo validation_errors();?>
                              </div>
                        <?php }; ?>


                  <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $detail[0]['_id'];?>">
                              <label>Nama</label>
                              <input class = "form-control" type="text" name="nama">
                              <label>Email</label>
                              <input class = "form-control" type="text" name="email">
                              <label>Komentar</label>
                              <textarea class="form-control" name="komentar"></textarea>
                        <br>
                        <input class="btn btn-primary" type="submit" value="Kirim" name="kirim"></input>
                  </form>

                  <br><br>
                  <h4>List Komentar</h4>
                  <hr>
                        <?php foreach ($komentar as $kmt) { ?>
                        
                              <label><?php echo $kmt['nickname'];?><i style="font-size: 70%"><?php echo ' komentar tanggal : '.$kmt['date'];?></i></label><br>
                              <p><i><?php echo $kmt['comment'];?></i></p>


                        <?php }; ?>
            </div>
<!-- Content -->
