<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
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
                        <a href="#">Tables</a>
                    </li>
                    <li class="active">Simple &amp; Dynamic</li>
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
                        专家列表
                        <small>
                            <i class="icon-double-angle-right"></i>
                            <!--Static &amp; Dynamic Tables-->
                        </small>
                    </h1>

                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <!--                            <div class="col-xs-12">
                                                            <p><button class="btn btn-white" onclick="location.href = '<?php echo \Yii::$app->urlManager->createUrl('book/create') ?>'">添加图书</button></p>
                                                        </div>-->

                        </div>
                        <div class="row">
                            <!--                            <div class="col-xs-12">
                                                            <p><button class="btn btn-white" onclick="location.href = '<?php echo \Yii::$app->urlManager->createUrl('book/courses-create') ?>'">添加课程</button></p>
                                                        </div>-->

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>用户名</th>
                                                <th>头像</th>
                                                <th>真名</th>                                                
                                                <th>电话</th>
                                                <th>注册时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php foreach ($expertArr as $k => $v): ?>
                                                <tr>

                                                    <th><?php echo $v['id']; ?></th>
                                                    <th><a href="<?php echo \Yii::$app->urlManager->createUrl(['/user/expert-detail', 'id' => $v['id']]); ?>"><?php echo $v['name']; ?></a></th>
                                                    <th><img src="<?php echo $v['logo']; ?>" width="50" height="50"></th>
                                                    <td>
                                                        <?php echo $v['true_name']; ?>
                                                    </td>
                                                    <th><?php echo $v['mobile']; ?></th>
                                                    <td>
                                                        <?php echo date('Y-m-d H:i', $v['add_time']); ?>
                                                    </td>
                                                    <td>
                                                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                                            <a class="green" href="<?php echo \Yii::$app->urlManager->createUrl(['user/expert-detail', 'id' => $v['id']]); ?>">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>
                                                            <a class="green" href="<?php echo \Yii::$app->urlManager->createUrl(['task/list', 'expert_id' => $v['id']]); ?>">
                                                                <i class="icon-tasks bigger-130"></i>
                                                            </a>
                                                        </div>

                                                        <!--                                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                                                                                <div class="inline position-relative">
                                                                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                                                                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                                                                                                    </button>
                                                        
                                                                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                                                                                        <li>
                                                                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                                                                <span class="blue">
                                                                                                                                    <i class="icon-zoom-in bigger-120"></i>
                                                                                                                                </span>
                                                                                                                            </a>
                                                                                                                        </li>
                                                        
                                                                                                                        <li>
                                                                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                                                                <span class="green">
                                                                                                                                    <i class="icon-edit bigger-120"></i>
                                                                                                                                </span>
                                                                                                                            </a>
                                                                                                                        </li>
                                                        
                                                                                                                        <li>
                                                                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                                                                <span class="red">
                                                                                                                                    <i class="icon-trash bigger-120"></i>
                                                                                                                                </span>
                                                                                                                            </a>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>-->
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal-footer no-margin-top">


                                    <?= LinkPager::widget(['pagination' => $pages]); ?>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->

    <div class="ace-settings-container" id="ace-settings-container">
        <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
            <i class="icon-cog bigger-150"></i>
        </div>

        <div class="ace-settings-box" id="ace-settings-box">
            <div>
                <div class="pull-left">
                    <select id="skin-colorpicker" class="hide">
                        <option data-skin="default" value="#438EB9">#438EB9</option>
                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                    </select>
                </div>
                <span>&nbsp; Choose Skin</span>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                <label class="lbl" for="ace-settings-add-container">
                    Inside
                    <b>.container</b>
                </label>
            </div>
        </div>
    </div><!-- /#ace-settings-container -->
</div><!-- /.main-container-inner -->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->


<?php echo \Yii::$app->view->renderFile('@app/views/inc/footer.php'); ?>