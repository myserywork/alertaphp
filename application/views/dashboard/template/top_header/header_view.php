<header class="top-header">
    <nav class="navbar navbar-expand gap-3">
        <div class="mobile-menu-button">
            <ion-icon name="menu-sharp"></ion-icon>
        </div>
        <form class="searchbar">
            <div class="position-absolute top-50 translate-middle-y search-icon ms-3">
                <ion-icon name="search-sharp"></ion-icon>
            </div>
            <input class="form-control" type="text" placeholder="tente, pacientes, relatórios, retaguarda">
            <div class="position-absolute top-50 translate-middle-y search-close-icon">
                <ion-icon name="close-sharp"></ion-icon>
            </div>
        </form>
        <div class="top-navbar-right ms-auto">
            <ul class="navbar-nav align-items-center">
                <?php $this->load->view('dashboard/template/top_header/search_view.php'); ?>
                <?php $this->load->view('dashboard/template/top_header/color_toggle_view.php'); ?>
                <?php $this->load->view('dashboard/template/top_header/hotmenu_dropdown_view'); ?>
                <?php $this->load->view('dashboard/template/top_header/notifications_dropdown_view'); ?>
                <?php $this->load->view('dashboard/template/top_header/user_dropdown_view'); ?>
            </ul>
        </div>
    </nav>
</header>