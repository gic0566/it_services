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
                        添加专长
                        <small>
                            <i class="icon-double-angle-right"></i>

                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <!-- PAGE CONTENT BEGINS -->       

                        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]); ?>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'name')->label('分类名称'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'parent_id')->label('父级')->dropDownList($data); ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
                            <?= Html::Button('返回列表', ['class' => 'btn btn-primary', 'onclick' => 'history.go(-1)']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

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

