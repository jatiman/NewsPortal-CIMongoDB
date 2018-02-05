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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popUp">
                Add New
              </button>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Real Name</th>
                    <th>Username</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $no=0;foreach($user_list as $row){?>
                  <tr class="rowdata_<?php echo $row['_id']; ?>">
                    <td><?php echo ++$no;?></td>
                    <td><?php echo $row['realname'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td>
                      <a href="javascript:;" onclick="editUser('<?php echo $row['_id']; ?>')" title="Edit"><i class="fa fa-pencil-square" data-toggle="modal" data-target="#popUp"></i></a>
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

<div class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" id="popUp" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" onclick="close_popup()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_popup">Add User</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          
            <form class="form-horizontal" id="form-add" method="POST" action="<?php echo base_url().'management_user/insert_user'; ?>" enctype="multipart/form-data">
              <input name="userId" type="hidden">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Real Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="realName" id="realname" placeholder="Real Name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Username</label>
                <div class="col-sm-8" id="unameInput">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" onkeyup="check()" required>
                  <span id="usernameAvailResult"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                  <span id="noticePassword" style="color:#3C8DBC;"></span>
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Confirm Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                </div>
              </div> -->
            </form>
          
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="button_save" disabled="" onclick="$('#form-add').submit()">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js';?>"></script>

<script type="text/javascript">
    $(function () {      
      $('#example1').DataTable();
    });

    function editUser(id){
      $.getJSON("<?php echo base_url().'management_user/edit_user/';?>"+id, function(json){
        $('input[name="realName"]').val(json['0'].realname);
        $('input[name="username"]').val(json['0'].username);
        $('input[name="email"]').val(json['0'].email);
        $('input[name="userId"]').val(json['0']._id);
        $('#noticePassword').val('Keep password blank to keep the old password');
        
        $('#title_popup').text(' Edit User');
        $('#form-add').attr('action', "<?php echo base_url().'management_user/update_user'; ?>");
        $("#button_save").removeAttr("disabled");
        $("#active-label").css("display",'block');
        
        $('<input type="hidden" class="form-control" id="usernameOld" name="usernameOld" placeholder="Username" value="'+json['0'].username+'">').appendTo('#unameInput');
        $('#noticePassword').text('*Leave blank to keep password');
        $('#noticePic').text('*Leave blank to keep picture');
      });
    };

    function close_popup(){
      $('#title_popup').text(' Add User');
      $('#form-add')[0].reset();
      $('#form-add').attr('action', "<?php echo base_url().'management_user/insert_user'; ?>");
      $("#button_save").attr("disabled",'disabled');
      $("#active").remove();
      $('#usernameOld').remove();
      $("#active-label").css("display",'none');
    }

    function check(){      
      var username = $('#username').val(); 
      var usernameOld = $('#usernameOld').val();
      var usernameAvailResult = $("#usernameAvailResult");

      if(username.length != "") { 
        if(usernameOld == username){
          usernameAvailResult.html('');
          $("#button_save").removeAttr("disabled");
        }else{
          usernameAvailResult.html('Loading..');
          $.ajax({ 
            type : 'GET',
            //data : username,
            url  : '<?php echo base_url(); ?>management_user/checkUsername/'+username,

            success: function(response){ 
              if(response == 0){
                usernameAvailResult.html('');
                $("#button_save").removeAttr("disabled");

              }
              else if(response > 0){
                usernameAvailResult.html('Username is exist');
                $("#button_save").attr("disabled","disabled");
              }
              else{
                usernameAvailResult.html('Error Query');
              }
            }
          });
        }
      }else{
        usernameAvailResult.html('');
        $("#button_save").removeAttr("disabled");
        $("#button_save").attr("disabled","disabled");
      }
    }

    function deletedata(rowdata)
      {
        var okcancel = confirm("Are you sure to delete the data?");

        if (okcancel) {
          $.ajax({
            type: "post",
            url: "<?php echo base_url().'management_user/delete/'; ?>"+rowdata,
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