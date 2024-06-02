<!doctype html>
<html lang="en" class="light-theme">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--plugins-->
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

    <!-- CSS Files -->
 
    <?php $this->load->view('dashboard/custom_styles'); ?>
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

    <title>LOGIN</title>
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
                <h4>Entrar</h4>
                <p>Faça login em sua conta</p>
              </div>
              <form class="form-body row g-3" method="POST">
                <div class="col-12">
                  <label for="inputEmail" class="form-label">E-mail</label>
                  <input type="email" name="identity" class="form-control" id="inputEmail">
                </div>
                <div class="col-12">
                  <label for="inputPassword" class="form-label">Senha</label>
                  <input type="password" class="form-control" name="password" id="inputPassword">
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="remember" role="switch" id="flexSwitchCheckRemember">
                    <label class="form-check-label" for="flexSwitchCheckRemember">Lembrar-me</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6 text-end">
                  <a href="<?= base_url("auth/forgot_password"); ?>">Esqueceu sua senha?</a>
                </div>
                <div class="col-12 col-lg-12">
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary" style="background-color:#00bc62 !important;border-color: white !important;">Entrar</button>
                  </div>
                </div>
                <!-- 
                <div class="col-12 col-lg-12">
                  <div class="position-relative border-bottom my-3">
                     <div class="position-absolute seperator translate-middle-y">or continue with</div>
                  </div>
                </div>
                <div class="col-12 col-lg-12">
                  <div class="social-login d-flex flex-row align-items-center justify-content-center gap-2 my-2">
                      <a href="javascript:;" class=""><img src="assets/images/icons/facebook.png" alt=""></a>
                      <a href="javascript:;" class=""><img src="assets/images/icons/apple-black-logo.png" alt=""></a>
                      <a href="javascript:;" class=""><img src="assets/images/icons/google.png" alt=""></a>  
                  </div>
                </div>
                 -->

                <div class="col-12 col-lg-12 text-center">
                  <p class="mb-0">Não tem uma conta? <a href="<?= base_url("auth/register"); ?>">Registre-se</a></p>
                </div>

              </form>
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