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
                        Form Elements
                        <small>
                            <i class="icon-double-angle-right"></i>
                            Common form elements and layouts
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <!-- PAGE CONTENT BEGINS -->       
                        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]); ?>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'name')->label('课程名称'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'book_id')->label('所属图书')->dropDownList($bookArr); ?>
                            </div>        
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'page_num')->label('谱子页数'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'level')->label('级别')->dropDownList(array(
                                    '0'=>'请选择级别',
                                    '1'=>'1级',
                                    '2'=>'2级',
                                    '3'=>'3级',
                                    '4'=>'4级',
                                    '5'=>'5级',
                                    '6'=>'6级',
                                    '7'=>'7级',
                                    '8'=>'8级',
                                    '9'=>'9级',
                                    '10'=>'10级',
                                    '97'=>'基础级',
                                    '98'=>'启蒙级',
                                    '99'=>'演奏级'
                                )); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="lighter">
                                            谱子列表
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="icon-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body"><div class="widget-body-inner" style="display: block;">
                                            <div class="widget-main no-padding">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="thin-border-bottom">
                                                        <tr>
                                                            <th>
                                                                <i class="icon-caret-right blue"></i>
                                                                排序
                                                            </th>

                                                            <th>
                                                                <i class="icon-caret-right blue"></i>
                                                                预览
                                                            </th>

                                                            <th>
                                                                <i class="icon-caret-right blue"></i>
                                                                名称
                                                            </th>

                                                            <th class="hidden-480">
                                                                <i class="icon-caret-right blue"></i>
                                                                操作
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach ($musicScoreArr AS $v): ?>
                                                            <tr>
                                                                <td><?= Html::input('text', 'music_score['.$v["id"].']', $v['sort'], ['size' => '3']) ?></td>
                                                                <td><?= Html::img('http://' . $image_ip . '/' . $v['file_path'] . $v['file_name'], ['width' => '50', 'height' => '50']) ?></td>
                                                                <td>
                                                                    <a href="<?= 'http://' . $image_ip . '/' . $v['file_path'] . $v['file_name']; ?>" target="_blank"><?php echo $v['file_name']; ?></a>
                                                                </td>

                                                                <td>
                                                                    <a href="<?= \Yii::$app->urlManager->createUrl(['book/musicscore-delete','cid'=>$v["courses_id"],'id'=>$v["id"]])?>">
                                                                        <i class="icon-remove"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div><!-- /widget-main -->
                                        </div></div><!-- /widget-body -->
                                </div><!-- /widget-box -->
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4>谱子图片</h4>

                                        <span class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="icon-chevron-up"></i>
                                            </a>

                                            <!--                                            <a href="#" data-action="close">
                                                                                            <i class="icon-remove"></i>
                                                                                        </a>-->
                                        </span>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <!--<input type="file" id="id-input-file-2" />-->
                                            <input multiple="multiple" name="img[]" type="file" id="id-input-file-3" />
                                            <label>
                                                <input type="checkbox" name="file-format" id="id-file-format" class="ace" />
                                                <span class="lbl">仅图片</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="book-size_kb">音频文件</label>
                            <?= Html::fileInput('music'); ?>
                            <div class="help-block"></div>
                            <?= Html::a('试听', 'http://' . $image_ip . '/' . $model->music_file_path . $model->music_file_name,['target'=>'_blank'])?>
                        </div>


                        <div class="form-group">
                            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
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



