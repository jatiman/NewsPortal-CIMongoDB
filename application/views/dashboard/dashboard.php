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
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $total_articles;?></h3>
                        <p>Total Articles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="<?php echo base_url().'article'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <!-- <div class="col-lg-3 col-xs-6"> -->
                <!-- small box -->
                <!-- <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Article Read</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> --><!-- ./col -->
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $total_comments;?></h3>
                        <p>Total Comments</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <!-- <div class="col-lg-3 col-xs-6"> -->
                <!-- small box -->
                <!-- <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Total Visitors Today</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> --><!-- ./col -->
        </div><!-- /.row -->

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