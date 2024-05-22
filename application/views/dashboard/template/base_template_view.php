<!doctype html>
<html lang="en" class="light-theme color-sidebar ">
<link rel="manifest" href="<?= base_url("assets/manifest.json"); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    $this->load->view('dashboard/custom_styles');
    // $this->load->view('service_worker.php');
    

    includeJS('assets/js/jquery.min.js');
    $baseCSS = array(
        'assets/ionicons/css/ionicons.min.css',
        'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
        'assets/css/bootstrap.min.css',
        'assets/css/bootstrap-extended.css',
        'assets/css/style.css',
        'assets/css/icons.css',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap',
        'assets/css/dark-theme.css',
        'assets/css/header-colors.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
    );

    if (!isset($cssFiles)) {
        $cssFiles = $baseCSS;
    } else {
        $cssFiles = array_merge($baseCSS, $cssFiles);
    }

    foreach ($cssFiles as $cssFile) {
        includeCSS($cssFile);
    }
    ?>

    <title>
        <?= (isset($title)) ? $title : "Bem vindo"; ?>
    </title>
</head>

<?php if (!isset($noBody)) { ?>

    <body>
        <!--start wrapper-->
        <div class="wrapper">
            <!--start sidebar wrapper-->

            <!--start submenu wrapper-->
            <?php $this->load->view('dashboard/template/menu/base_menu_view.php'); ?>
            <!--end submenu wrapper-->

            <!--end sidebar wrapper-->

            <!--start top header-->
            <?php $this->load->view('dashboard/template/top_header/header_view.php'); ?>
            <!--end top header-->


            <!-- start page content wrapper-->
            <div class="page-content-wrapper">
                <!-- start page content-->
                <div class="page-content">

                    <style>
                        .page-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
                            font-size: 12px !important;
                            color: #000 !important;
                            font-weight: bold;
                            padding-top: 5px;
                        }

                        .first-one {
                            padding-bottom: 5px;
                        }
                        
                    </style>
                    <!--start breadcrumb-->
                    <?= (isset($breadcumbs)) ? $breadcumbs : ''; ?>
                    <!--end breadcrumb-->

                    <div class="card radius-10">
                        <div class="card-body">
                            <?= $content; ?>
                        </div>
                    </div>

                </div>
                <!-- end page content-->
            </div>



            <!--Start Back To Top Button-->
            <a href="<?= base_url(); ?>javaScript:;" class="back-to-top">
                <ion-icon name="arrow-up-outline"></ion-icon>
            </a>
            <!--End Back To Top Button-->


            <!--start overlay-->
            <div class="overlay"></div>
            <!--end overlay-->

        </div>
        <!--end wrapper-->
        <!-- JS Files-->


    <?php } else { ?>
        <style>
            .nobody {
                margin: 10px !important;
            }
        </style>
        <div class="card radius-10 nobody">
            <div class="card-body ">
                <?= $content; ?>
            </div>
        </div>
    <?php } ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <?php $this->load->view('components/alert_view'); ?>
    <?php $this->load->view('components/modal_view'); ?>
    <!-- JS Files-->
    <?php

    if (!isset($jsFiles)) {
        $jsFiles = array(
            'assets/js/jquery.min.js',
            'assets/js/bootstrap.bundle.min.js',
            'assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js',
            'assets/js/main.js',
            'assets/plugins/datatable/js/jquery.dataTables.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js'
        );
    } else {
        $filesToAdd = array(
            'assets/js/jquery.min.js',
            'assets/js/bootstrap.bundle.min.js',
            'assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js',
            'assets/js/main.js',
            'assets/plugins/datatable/js/jquery.dataTables.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js'
        );

        foreach ($filesToAdd as $file) {
            if (!in_array($file, $jsFiles)) {
                $jsFiles[] = $file;
            }
        }
    }


    foreach ($jsFiles as $jsFile) {
        includeJS($jsFile);
    }


    ?>


    <?= includeJS('assets/plugins/datatable/js/jquery.dataTables.min.js'); ?>


    <script>
        /*
                                                        $(".mobile-menu-button").click(function(){
                                                            $("body").toggleClass("mini-toggled");
                                                            $(".wrapper").toggleClass("toggled2");
                                                            $(".overlay").toggleClass("d-block");
                                                            $(".sidebar-submenu-wrapper").toggleClass("ps");
                                                            $(".tab-pane").toggleClass("fade");
                                                        });
                                                        */
</script>




</body>

</html>