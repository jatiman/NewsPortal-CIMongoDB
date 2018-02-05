<!-- Content -->
        <div class="container">
          <div class="row">
            <div class="col-md-8">
                  <?php //var_dump($detail);?>
                  <h2><?php echo $detail[0]['title'];?></h2>

                  <img src="<?php //echo base_url().'assets/img/'.$detail[0]['image'];?>" class="img-thumbnail">
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
