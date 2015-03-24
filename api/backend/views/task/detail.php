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
                        需求详情
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司名 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['company_name'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>
                            
                            <div class="space-5"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司名 </label>

                                <div class="col-sm-9">
                                    <img src="<?php echo $data['clogo']?>" height="100" width="100"/>
                                </div>
                            </div>

                            <div class="space-5"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 标题 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['title'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 内容 </label>
                                <div class="col-sm-9">


                                    <textarea class="form-control" id="form-field-8" readonly="readonly"><?php echo $data['content'] ?></textarea>
                                </div>                            
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 对专家的要求 </label>
                                <div class="col-sm-9">


                                    <textarea class="form-control" id="form-field-8" readonly="readonly"><?php echo $data['tips'] ?></textarea>
                                </div>                            
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 分类 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['cat_name'] ?>" class="col-xs-10 col-sm-5" readonly="readonly">
                                </div>
                            </div>                            

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 赏金 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['reward'] ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 状态 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo empty($data['status']) ? '已发布' : ($data['status'] == '1' ? '进行中' : '已完成') ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>
                            <?php if($data['expert_id']):?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 承接人 </label>

                                <div class="col-sm-9">
                                    <input type="button" value="查看" onclick="location.href='<?php echo \Yii::$app->urlManager->createUrl(['/user/expert-detail', 'id' => $data['expert_id']]); ?>'">
                                </div>
                            </div>
                            

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 承接时间 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['begin_time'] ? date('Y-m-d', $data['begin_time']) : '暂无' ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>
                            <?php endif;?>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 完成时间 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['finish_time'] ? date('Y-m-d', $data['finish_time']) : '暂无' ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 专家对公司的评价等级 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['clevel'] ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 专家对公司的评价 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['c_comment'] ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 专家对公司的评价时间 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['c_comment_time'] ? date('Y-m-d', $data['c_comment_time']) : '暂无' ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司对专家的评价等级 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['e_comment_level'] ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司对专家的评价 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['e_comment'] ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司对专家的评价时间 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" value="<?php echo $data['e_comment_time'] ? date('Y-m-d', $data['e_comment_time']) : '暂无' ?>" readonly="" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 添加时间 </label>

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

