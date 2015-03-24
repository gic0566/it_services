<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>后台管理系统</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- basic styles -->
        <link href="/it/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/it/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="/it/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="/it/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="/it/css/chosen.css" />
        <link rel="stylesheet" href="/it/css/datepicker.css" />
        <link rel="stylesheet" href="/it/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="/it/css/daterangepicker.css" />
        <link rel="stylesheet" href="/it/css/colorpicker.css" />

        <!-- fonts -->

        <!-- ace styles -->

        <link rel="stylesheet" href="/it/css/ace.min.css"/>
        <link rel="stylesheet" href="/it/css/ace-rtl.min.css"/>
        <link rel="stylesheet" href="/it/css/ace-skins.min.css"/>

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="/it/css/ace-ie.min.css" />
        <![endif]-->

        <script src="/it/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/it/js/html5shiv.js"></script>
        <script src="/it/js/respond.min.js"></script>
        <![endif]-->

        <!--[if IE]>
<script src="/it/js/jquery-1.10.2.min.js"></script>
<![endif]-->       

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="/it/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/it/js/html5shiv.js"></script>
        <script src="/it/js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">


                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="icon-coffee green"></i>
                                                登录
                                            </h4>

                                            <div class="space-6"></div>

                                            <form method="post" action="<?php echo \Yii::$app->urlManager->createUrl(['/user/login']); ?>" enctype="mutltipart/form-data">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name="name" class="form-control" placeholder="Username" />
                                                            <i class="icon-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="password" class="form-control" placeholder="Password" />
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space"></div>

                                                    <div class="clearfix">
                                                        <!--                                                        <label class="inline">
                                                                                                                    <input type="checkbox" class="ace" />
                                                                                                                    <span class="lbl"> Remember Me</span>
                                                                                                                </label>-->


                                                        <?= Html::submitButton('提交', ['class' => 'width-35 pull-right btn btn-sm btn-primary']) ?>
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>


                                        </div><!-- /widget-main -->


                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->

                            </div><!-- /position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='/it/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]-->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='/it/js/jquery-1.10.2.min.js'>" + "<" + "/script>");
        </script>
        <!--[endif]-->

        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='/it/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="/it/js/bootstrap.min.js"></script>
        <script src="/it/js/typeahead-bs2.min.js"></script>

        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            function show_box(id) {
                jQuery('.widget-box.visible').removeClass('visible');
                jQuery('#' + id).addClass('visible');
            }
        </script>
    </body>
</html>
