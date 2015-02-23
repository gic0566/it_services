<?php

use yii\helpers\Html;

$rStr = Yii::$app->request->get('r');
if (strpos($rStr, '/')) {
    $rArr = explode('/', $rStr);
    $rArr0 = $rArr['0'];
    $rArr1 = $rArr['1'];
}
?>

<div class="sidebar" id="sidebar">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="icon-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="icon-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="icon-group"></i>
            </button>

            <button class="btn btn-danger">
                <i class="icon-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- #sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li>
            <a href="#">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> 控制台 </span>
            </a>
        </li>

        <!--        <li>
                    <a href="typography.html">
                        <i class="icon-text-width"></i>
                        <span class="menu-text"> 文字排版 </span>
                    </a>
                </li>-->

        <li class="<?php echo $rArr0 == 'user' ? 'active open' : ''; ?>" >
            <a href="#" class="dropdown-toggle">
                <i class="icon-user"></i>
                <span class="menu-text"> 用户管理 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu" style="display:<?php echo $rArr0 == 'user' ? 'block' : 'none'; ?>">
                <li <?php echo $rArr1 == 'student-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('user/student-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        学生列表
                    </a>
                </li>

                <li <?php echo $rArr1 == 'teacher-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('user/teacher-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        老师列表
                    </a>
                </li>

                <li <?php echo $rArr1 == 'teacher-student-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('user/teacher-student-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        师生关系列表
                    </a>
                </li>

                <li <?php echo $rArr1 == 'admin-user-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('user/admin-user-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        管理员列表
                    </a>
                </li>

                <!--                <li>
                                    <a href="treeview.html">
                                        <i class="icon-double-angle-right"></i>
                                        树菜单
                                    </a>
                                </li>
                
                                <li>
                                    <a href="jquery-ui.html">
                                        <i class="icon-double-angle-right"></i>
                                        jQuery UI
                                    </a>
                                </li>
                
                                <li>
                                    <a href="nestable-list.html">
                                        <i class="icon-double-angle-right"></i>
                                        可拖拽列表
                                    </a>
                                </li>
                
                                <li>
                                    <a href="#" class="dropdown-toggle">
                                        <i class="icon-double-angle-right"></i>
                
                                        三级菜单
                                        <b class="arrow icon-angle-down"></b>
                                    </a>
                
                                    <ul class="submenu">
                                        <li>
                                            <a href="#">
                                                <i class="icon-leaf"></i>
                                                第一级
                                            </a>
                                        </li>
                
                                        <li>
                                            <a href="#" class="dropdown-toggle">
                                                <i class="icon-pencil"></i>
                
                                                第四级
                                                <b class="arrow icon-angle-down"></b>
                                            </a>
                
                                            <ul class="submenu">
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-plus"></i>
                                                        添加产品
                                                    </a>
                                                </li>
                
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-eye-open"></i>
                                                        查看商品
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>-->
            </ul>
        </li>


        <!--        <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-list"></i>
                        <span class="menu-text"> 表格 </span>
        
                        <b class="arrow icon-angle-down"></b>
                    </a>
        
                    <ul class="submenu">
                        <li>
                            <a href="tables.html">
                                <i class="icon-double-angle-right"></i>
                                简单 &amp; 动态
                            </a>
                        </li>
        
                        <li>
                            <a href="jqgrid.html">
                                <i class="icon-double-angle-right"></i>
                                jqGrid plugin
                            </a>
                        </li>
                    </ul>
                </li>-->

        <li class="<?php echo $rArr0 == 'book' ? 'active open' : ''; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="icon-book"></i>
                <span class="menu-text"> 教材管理 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu" style="display:<?php echo $rArr0 == 'book' ? 'block' : 'none'; ?>">
                <li <?php echo $rArr1 == 'book-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('book/book-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        图书列表
                    </a>
                </li>
                <li <?php echo $rArr1 == 'courses-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('book/courses-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        课程列表
                    </a>
                </li>

                <!--                <li>
                                    <a href="form-wizard.html">
                                        <i class="icon-double-angle-right"></i>
                                        向导提示 &amp; 验证
                                    </a>
                                </li>
                
                                <li>
                                    <a href="wysiwyg.html">
                                        <i class="icon-double-angle-right"></i>
                                        编辑器
                                    </a>
                                </li>
                
                                <li>
                                    <a href="dropzone.html">
                                        <i class="icon-double-angle-right"></i>
                                        文件上传
                                    </a>
                                </li>-->
            </ul>
        </li>

        <li class="<?php echo $rArr0 == 'question' ? 'active open' : ''; ?>" >
            <a href="#" class="dropdown-toggle">
                <i class="icon-question-sign"></i>
                <span class="menu-text"> 问答管理 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu" style="display:<?php echo $rArr0 == 'question' ? 'block' : 'none'; ?>">
                <li <?php echo $rArr1 == 'question-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('question/question-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        问题列表
                    </a>
                </li>


                <!--                <li>
                                    <a href="treeview.html">
                                        <i class="icon-double-angle-right"></i>
                                        树菜单
                                    </a>
                                </li>
                
                                <li>
                                    <a href="jquery-ui.html">
                                        <i class="icon-double-angle-right"></i>
                                        jQuery UI
                                    </a>
                                </li>
                
                                <li>
                                    <a href="nestable-list.html">
                                        <i class="icon-double-angle-right"></i>
                                        可拖拽列表
                                    </a>
                                </li>
                
                                <li>
                                    <a href="#" class="dropdown-toggle">
                                        <i class="icon-double-angle-right"></i>
                
                                        三级菜单
                                        <b class="arrow icon-angle-down"></b>
                                    </a>
                
                                    <ul class="submenu">
                                        <li>
                                            <a href="#">
                                                <i class="icon-leaf"></i>
                                                第一级
                                            </a>
                                        </li>
                
                                        <li>
                                            <a href="#" class="dropdown-toggle">
                                                <i class="icon-pencil"></i>
                
                                                第四级
                                                <b class="arrow icon-angle-down"></b>
                                            </a>
                
                                            <ul class="submenu">
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-plus"></i>
                                                        添加产品
                                                    </a>
                                                </li>
                
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-eye-open"></i>
                                                        查看商品
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>-->
            </ul>
        </li>

        <li class="<?php echo $rArr0 == 'message' ? 'active open' : ''; ?>" >
            <a href="#" class="dropdown-toggle">
                <i class="icon-volume-up"></i>
                <span class="menu-text"> 信息管理 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu" style="display:<?php echo $rArr0 == 'message' ? 'block' : 'none'; ?>">
                <li <?php echo $rArr1 == 'notice-list' ? 'class="active"' : ''; ?>>
                    <a href="<?php echo Yii::$app->urlManager->createUrl('message/notice-list'); ?>">
                        <i class="icon-double-angle-right"></i>
                        通知列表
                    </a>
                </li>


                <!--                <li>
                                    <a href="treeview.html">
                                        <i class="icon-double-angle-right"></i>
                                        树菜单
                                    </a>
                                </li>
                
                                <li>
                                    <a href="jquery-ui.html">
                                        <i class="icon-double-angle-right"></i>
                                        jQuery UI
                                    </a>
                                </li>
                
                                <li>
                                    <a href="nestable-list.html">
                                        <i class="icon-double-angle-right"></i>
                                        可拖拽列表
                                    </a>
                                </li>
                
                                <li>
                                    <a href="#" class="dropdown-toggle">
                                        <i class="icon-double-angle-right"></i>
                
                                        三级菜单
                                        <b class="arrow icon-angle-down"></b>
                                    </a>
                
                                    <ul class="submenu">
                                        <li>
                                            <a href="#">
                                                <i class="icon-leaf"></i>
                                                第一级
                                            </a>
                                        </li>
                
                                        <li>
                                            <a href="#" class="dropdown-toggle">
                                                <i class="icon-pencil"></i>
                
                                                第四级
                                                <b class="arrow icon-angle-down"></b>
                                            </a>
                
                                            <ul class="submenu">
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-plus"></i>
                                                        添加产品
                                                    </a>
                                                </li>
                
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-eye-open"></i>
                                                        查看商品
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>-->
            </ul>
        </li>

        <!--        <li>
                    <a href="widgets.html">
                        <i class="icon-list-alt"></i>
                        <span class="menu-text"> 插件 </span>
                    </a>
                </li>-->

        <!--        <li>
                    <a href="calendar.html">
                        <i class="icon-calendar"></i>
        
                        <span class="menu-text">
                            日历
                            <span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
                                <i class="icon-warning-sign red bigger-130"></i>
                            </span>
                        </span>
                    </a>
                </li>
        
                <li>
                    <a href="gallery.html">
                        <i class="icon-picture"></i>
                        <span class="menu-text"> 相册 </span>
                    </a>
                </li>
        
                <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-tag"></i>
                        <span class="menu-text"> 更多页面 </span>
        
                        <b class="arrow icon-angle-down"></b>
                    </a>
        
                    <ul class="submenu">
                        <li>
                            <a href="profile.html">
                                <i class="icon-double-angle-right"></i>
                                用户信息
                            </a>
                        </li>
        
                        <li>
                            <a href="inbox.html">
                                <i class="icon-double-angle-right"></i>
                                收件箱
                            </a>
                        </li>
        
                        <li>
                            <a href="pricing.html">
                                <i class="icon-double-angle-right"></i>
                                售价单
                            </a>
                        </li>
        
                        <li>
                            <a href="invoice.html">
                                <i class="icon-double-angle-right"></i>
                                购物车
                            </a>
                        </li>
        
                        <li>
                            <a href="timeline.html">
                                <i class="icon-double-angle-right"></i>
                                时间轴
                            </a>
                        </li>
        
                        <li>
                            <a href="login.html">
                                <i class="icon-double-angle-right"></i>
                                登录 &amp; 注册
                            </a>
                        </li>
                    </ul>
                </li>-->

        <!--        <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-file-alt"></i>
        
                        <span class="menu-text">
                            其他页面
                            <span class="badge badge-primary ">5</span>
                        </span>
        
                        <b class="arrow icon-angle-down"></b>
                    </a>
        
                    <ul class="submenu">
                        <li>
                            <a href="faq.html">
                                <i class="icon-double-angle-right"></i>
                                帮助
                            </a>
                        </li>
        
                        <li>
                            <a href="error-404.html">
                                <i class="icon-double-angle-right"></i>
                                404错误页面
                            </a>
                        </li>
        
                        <li>
                            <a href="error-500.html">
                                <i class="icon-double-angle-right"></i>
                                500错误页面
                            </a>
                        </li>
        
                        <li>
                            <a href="grid.html">
                                <i class="icon-double-angle-right"></i>
                                网格
                            </a>
                        </li>
        
                        <li>
                            <a href="blank.html">
                                <i class="icon-double-angle-right"></i>
                                空白页面
                            </a>
                        </li>
                    </ul>
                </li>-->
    </ul><!-- /.nav-list -->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>

    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>
</div>