<?php
$this->load->view('template/header');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<style type="text/css">
    span.stars, span.stars span {
    display: block;
    background: url(<?php echo base_url()?>assets/dist/img/stars.png) 0 -16px repeat-x;
    width: 80px;
    height: 16px;
    }

    span.stars span {
        background-position: 0 0;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <?php echo $page_title;?>
        <small><?php //echo $page_subtitle?></small>
    </h1>
        <ol class="breadcrumb">
            <?php //$this->load->view('template/breadcrumb');?>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title"><?php echo $rank_title;?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            <?php $i=0;foreach($rank_data as $rank){?>
                            <li>
                                <span><?php echo ++$i;?>. </span>
                                    <span class="text"><?php echo $rank['title'];?></span>
                                    <span class="text"><?php //echo '(rated by '.$rank->tot_read.' people)';?></span>
                            </li>
                            <?php }?>
                        </ul>
                    </div><!-- /.box-body  -->
                </div>
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div>

<?php
$this->load->view('template/script');
$this->load->view('template/footer');
?>
<script type="text/javascript">
    $.fn.stars = function() {
        return $(this).each(function() {
            $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * 16));
        });
    }

    $(function() {
        $('span.stars').stars();
    });
</script>