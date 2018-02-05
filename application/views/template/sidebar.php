<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- 
        <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

        Sidebar user panel -->
        
        <div class="user-panel" >

            <div class="pull-left image">
              <!-- <a href="<?php echo base_url().'profile/info/'.$this->session->userdata('user_id'); ?>"> -->
                <img src="<?php if(!$this->session->userdata('user_pic')){echo base_url('assets/dist/img/stars.png');}else{echo base_url()."uploads/user_pic/".$this->session->userdata('user_pic');} ?>" class="img-circle" alt="User Image" />
              <!-- </a> -->
            </div>
            
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('realname');?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- search form <a href=">Profile</a> -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <li>
                <a href="<?php echo base_url().'dashboard';?>" title="Dashboard">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url().'article';?>" title="Berita">
                    <i class="fa fa-book"></i>
                    <span>Berita</span>
                </a>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<div class="control-sidebar-bg"></div>
<!-- =============================================== -->