
	
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
              <h4><?php echo lang('reset_password_heading');?></h4>
            </div>
            <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open('auth/reset_password/' . $code, 'class="form-body row g-3"');?>
              <div class="col-12">
                <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
                <?php echo form_input($new_password, '', 'class="form-control"');?>
              </div>
              <div class="col-12">
                <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                <?php echo form_input($new_password_confirm, '', 'class="form-control"');?>
              </div>
              <?php echo form_input($user_id);?>
              <?php echo form_hidden($csrf); ?>
              <div class="col-12 col-lg-12">
                <div class="d-grid">
                  <?php echo form_submit('submit', lang('reset_password_submit_btn'), 'class="btn btn-primary"');?>
                </div>
              </div>
            <?php echo form_close();?>
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