<!-- SideBar -->
            <div class="col-md-4">
              <h2>Populer</h2>
                <hr>
	            <?php foreach ($side as $sd) {?>
                <div class = "mp">
                    <a href="<?php echo base_url().'/blog/detail/'.$sd['_id']?>" ><h4><?php echo $sd['title'];?></h4></a>
                    <p>
                        <?php echo word_limiter($sd['content'],10);?>
                    </p>

                </div>
                <?php };?>
            </div>
        </div>
      </div>

<!-- SideBar -->
