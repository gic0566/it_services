<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php echo \Yii::$app->view->renderFile('@app/views/inc/header.php'); ?>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <?php echo \Yii::$app->view->renderFile('@app/views/inc/left.php'); ?>

        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Forms</a>
                    </li>
                    <li class="active">Form Elements</li>
                </ul><!-- .breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                            <i class="icon-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- #nav-search -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        公司详情
                        <small>
                            <i class="icon-double-angle-right"></i>

                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <!-- PAGE CONTENT BEGINS -->       

                        <form class="form-horizontal" role="form">

                            <div class="space-5"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ID </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['id'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>
                            
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> logo </label>

                                <div class="col-sm-9">
                                    <img src="<?php echo $data['logo']?>" width="100" height="100">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户名 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['name'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 简称 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['short_name'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司名字 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['company_name'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 联系人 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['contacts'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 蓝币 </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['amount'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 手机号 </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['mobile'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> email </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['email'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>


                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 地址 </label>
                                <div class="col-sm-9">

                                    <textarea class="form-control" id="form-field-8" readonly="readonly"><?php echo $data['city'] ?> <?php echo $data['district'] ?> <?php echo $data['address'] ?></textarea>
                                </div>                            
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司简介 </label>
                                <div class="col-sm-9">

                                    <textarea class="form-control" id="form-field-8" readonly="readonly"><?php echo $data['summary'] ?></textarea>
                                </div>                            
                            </div>


                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 注册时间 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo date('Y-m-d', $data['add_time']) ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                        </form>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div><!-- /.main-content -->
    </div><!-- /.main-container-inner -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->





<?php echo \Yii::$app->view->renderFile('@app/views/inc/footer.php'); ?>

