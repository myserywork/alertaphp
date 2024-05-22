
<!doctype html>
<html lang="en" class="light-theme">
  <head>
  <?php $this->load->view('dashboard/custom_styles'); ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--plugins-->
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

    <!-- CSS Files -->


    <?php

        includeJS('assets/js/jquery.min.js');
        $baseCSS = array(
            'assets/ionicons/css/ionicons.min.css',
            'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
            'assets/css/bootstrap.min.css', 'assets/css/bootstrap-extended.css',
            'assets/css/style.css', 
            'assets/css/icons.css',
            'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap', 
            'assets/css/dark-theme.css', 
            'assets/css/header-colors.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
        );

        foreach($baseCSS as $cssFile) {
            includeCSS($cssFile);
        }

    ?>

    <title>Recuperar senha</title>
  </head>
  <body class="bg-white">
    
 <!--start wrapper-->
    <div class="wrapper">
      <div class="">
        <div class="row g-0 m-0">
        <div class="col-xl-6 col-lg-12">
      <div class="login-cover-wrapper">
        <div class="card shadow-none">
          <div class="card-body">
            <div class="text-center">
              <h4>Recuperar senha</h4>
              <p>Digite seu E-mail</p>
            </div>
            <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open("auth/forgot_password", 'class="form-body row g-3"');?>
              <div class="col-12">
                <label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
                <?php echo form_input($identity, '', 'class="form-control"');?>
              </div>
              <div class="col-12 col-lg-12">
                <div class="d-grid">
                  <?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary"');?>
                </div>
              </div>
            <?php echo form_close();?>     
             <div class="col-12 col-lg-12 text-center">
                  <p class="mb-0">Lembrou sua senha? <a href="<?= base_url("auth/login"); ?>">Voltar</a></p>
                </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-xl-6 col-lg-12">
          <div class="position-fixed top-0 h-100 d-xl-block d-none login-cover-img">
          </div>
        </div>
      </div><!--end row-->
    </div>
     </div>
  <!--end wrapper-->
    <?php $this->load->view('components/alert_view.php'); ?>

  </body>
</html>