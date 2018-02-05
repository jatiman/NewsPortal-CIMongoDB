<?php
$this->load->view('template/header');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
  <link href="<?php echo base_url('assets/plugins/treeview/treeview_styles.css') ?>" rel="stylesheet" type="text/css" />
  <!-- wa-mediabox -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/wa-mediabox/wa-mediabox.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/wa-mediabox/wa-mediabox.min.css" />

  <style type="text/css">
    .warning {
      background:#fff8c4;
      border:1px solid #f2c779;
      padding: 24px;
    }

    ul.enlarge{
    list-style-type:none; /*remove the bullet point*/
    margin-left:0;
    white-space: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    }

    ul.enlarge li {
    position: relative;
    display: inline-block;
    margin-right: 15px;
    margin-left: 15px;

    }
    ul.enlarge li img{
    background-color:#eae9d4;
    padding: 6px;
    -webkit-box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    -moz-box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    }
    /**IE Hacks - see http://css3pie.com/ for more info on how to use CS3Pie and to download the latest version**/
    ul.enlarge img{
    behavior: url(pie/PIE.htc);
    }
    ul.enlarge a i{
      position:absolute; top:0; right:0; 
    }

    .video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px; height: 0; overflow: hidden;
    }
     
    .video-container iframe,
    .video-container object,
    .video-container embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title;?>
        <small><?php echo $page_subtitle?></small>
      </h1>
      <ol class="breadcrumb">
        <?php $this->load->view('template/breadcrumb');?>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- <div class="box-header"> -->
              <!-- <h3 class="box-title">Bootstrap WYSIHTML5 <small>Simple and fast</small></h3> -->
              <!-- tools box -->
              <!-- <div class="pull-right box-tools">
              </div> --><!-- /. tools -->
            <!-- </div> --><!-- /.box-header -->
            <div class="box-body pad">
              <?php foreach($article_list as $row){ ?>
              <form action="" class="form-horizontal">
                <div class="form-group">
                  <label for="video" class="col-sm-12 control-label" style="text-align:left"><h3><?php echo $row->pbArticleTitle;?></h3></label>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="video" class="col-sm-3 control-label">Point</label>
                    <div class="col-md-6">
                      <input name="articlePoint" type="text" class="form-control" placeholder="Article's Point" onkeypress="return isNumberKey(event)" value="<?php echo $row->pbArticlePoint;?>" required disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="video" class="col-sm-3 control-label">Time</label>
                    <div class="col-md-6">
                      <input name="articleTime" type="text" class="form-control" placeholder="In minutes" value="<?php echo $row->pbArticleTimeShow;?> min" disabled />
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="video" class="col-sm-4 control-label">Publish Date</label>
                    <div class="col-md-6">
                      <input name="startPub" id="startPub" type="text" class="form-control" placeholder="dd-mm-yyyy" disabled value="<?php echo date('d-m-Y',strtotime($row->pbArticleStartPublishDate));?>" />
                    </div>
                  </div>                
                  <div class="form-group">
                    <label for="video" class="col-sm-4 control-label">Unpublish Date</label>
                    <div class="col-md-6">
                      <input name="endPub" type="text" id="endPub" class="form-control" placeholder="dd-mm-yyyy" disabled value="<?php echo date('d-m-Y',strtotime($row->pbArticleEndPublishDate));?>" />
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="video" class="col-sm-3 control-label">Status</label>
                    <div class="col-md-8">
                      <?php if($row->pbArticleStatusPublish=='0'){echo '<input type="text" id="endPub" class="form-control" placeholder="dd-mm-yyyy" disabled value="Not published" />';}else{echo '<input type="text" id="endPub" class="form-control" placeholder="dd-mm-yyyy" disabled value="Published" />';}?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="video" class="col-sm-12 control-label"></label>
                  <div class="col-md-12">
                    <span style="text-align:justify"><?php echo $row->pbArticleDescription;?></span>
                  </div>
                </div>

                <div class="form-group">                  
                  <div class="col-md-12">
                    <ul class="enlarge">
                      <?php foreach ($image_list as $img) { ?>
                        <li class="rowdata_<?php echo $img->pbArticleImageId; ?>">
                        <a href="<?php echo base_url().'uploads/article_pic/'.$img->pbArticleImagePicture;?>" data-mediabox="Uploaded Pictures" data-title="<?php echo $img->pbArticleImagePicture;?>"><img src="<?php echo base_url().'uploads/article_pic/'.$img->pbArticleImagePicture;?>" style="max-height:200px" alt="<?php echo $img->pbArticleImagePicture;?>" /></a><a href="javascript:;" onclick="deletepicture('<?php echo $img->pbArticleImageId; ?>')" title="Delete"><i class="fa fa-times-circle fa-2x"></i></a>
                        </li>
                      <?php }?>
                    </ul>
                  </div>
                </div>

                <?php if(count($video_list) > 0){
                  $i = 0;
                  foreach ($video_list as $vid) {?>
                  <div class="form-group" style="text-align:center;">                    
                    <div class="col-sm-12">
                      <div class="video-container">
                        <iframe width="16" height="9" src="<?php echo $vid->pbArticleVideoContent;?>" allowfullscreen align="middle">
                        </iframe>
                      </div>
                    </div>
                  </div>
                <?php $i++;}}else{?>
                <div class="form-group">
                  <label for="video" class="col-sm-2 control-label"></label>                
                </div>
                <?php }?>
                <div class="form-group">
                  <div class="col-md-12">
                    <a href="<?php echo base_url().'articles';?>"><button class="btn btn-primary" id="button_save" type="button" style="float:right;">Back</button></a>
                  </div>
                </div>
              </form>
              <?php }?>
            </div>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<?php $this->load->view('template/footer');?>
<?php $this->load->view('template/script');?>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js';?>"></script>

<script type="text/javascript">
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
</script>