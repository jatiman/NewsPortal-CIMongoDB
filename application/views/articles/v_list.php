<?php
$this->load->view('template/header');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
  <style type="text/css">
    .warning {
      background:#fff8c4;
      border:1px solid #f2c779;
      padding: 24px;
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
        <?php //$this->load->view('template/breadcrumb');?>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <?php if($this->session->flashdata('message') != ""){ ?>  
              <h6 class="warning"><i class="fa fa-check"></i>&nbsp;<?php echo $this->session->flashdata('message'); ?></h6>
            <?php } ?>
            <div class="box-header">
              <a href="<?php echo base_url().'article/add_article';?>"><button type="button" class="btn btn-primary">
                Add New
              </button></a>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="dataTableArticles" class="table table-bordered table-striped" style="float:right;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Berita</th>
                    <th>Category</th>
                    <th>Tanggal Dipublikasi</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $no=0;foreach($article_list as $row){?>
                  <tr class="rowdata_<?php echo $row['_id']; ?>">
                    <td><?php echo ++$no;?></td>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['category'];?></td>
                    <td><?php echo $row['time_publish'];?></td>
                    <td>
                      <a href="<?php echo base_url().'article/edit_article/'.$row['_id'];?>" title="Edit"><i class="fa fa-pencil-square"></i></a>
                      <a href="javascript:;" onclick="deletedata('<?php echo $row['_id']; ?>')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
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
    $(function () {      
      $('#dataTableArticles').DataTable();
    });
    
    function deletedata(rowdata)
      {
        var okcancel = confirm("Are you sure to delete the data?");

        if (okcancel) {
          $.ajax({
            type: "post",
            url: "<?php echo base_url().'article/delete/'; ?>"+rowdata,
            success: function(response) {
              if (response) { 
                $(".rowdata_"+rowdata).fadeOut("fast");
                alert("Success delete data");
              } else {
                alert("Sory, failed delete your data.");
              };
            }
          });
        };
      };
</script>