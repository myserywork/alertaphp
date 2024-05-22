<?php
$currentRoute = $this->uri->segment(1);

$routes = array(
    'dashboard' => array(
        'title' => 'Dashboard',
        'icon' => 'speedometer-outline', // Changed to represent speed and analytics
        'subtitle' => 'Dashboard',
        'submenu' => array(
            'dashboard' => array(
                'title' => 'Dashboard',
                'icon' => 'speedometer-outline', // Consistency within the submenu
                'route' => 'dash'
            ),
            'relatorios' => array(
                'title' => 'Relatórios',
                'icon' => 'alert-circle-outline', // Changed to a warning icon for clarity
                'route' => 'robo/dashboard'
            )
        )
    ),
    /*
    'users' => array(
        'title' => 'Usuários',
        'icon' => 'person-circle-outline', // Changed to a single person icon for clarity
        'subtitle' => 'Usuários',
        'submenu' => array(
            'users' => array(
                'title' => 'Usuários',
                'icon' => 'person-circle-outline',
                'route' => 'users'
            ),
            'roles' => array(
                'title' => 'Funções',
                'icon' => 'key-outline', // New icon to represent access or roles
                'route' => 'roles'
            )
        )
    ),
    */
    'pacientes' => array(
        'title' => 'Pacientes',
        'icon' => 'heart-half-outline', // Changed to a medical related icon
        'subtitle' => 'Pacientes',
        'submenu' => array(
            'pacientes' => array(
                'title' => 'Pacientes',
                'icon' => 'heart-half-outline',
                'route' => 'paciente'
            ),
        )
    ),
    'doencas-croicas' => array(
        'title' => 'Doenças Crônicas',
        'icon' => 'bandage-outline', // Changed to reflect health conditions
        'subtitle' => 'Doenças Crônicas',
        'submenu' => array(
            'doencas-croicas' => array(
                'title' => 'Doenças Crônicas',
                'icon' => 'bandage-outline',
                'route' => 'doencas'
            ),
            'roles' => array(
                'title' => 'Sintomas',
                'icon' => 'heart-half-outline', // Maintaining consistency across the interface
                'route' => 'doencas/sintomas'
            )
        )
    ),
);
?>

<div class="mini-sidebar-wrapper">
    <div class="mini-sidebar-header">
        <img src="<?= base_url("assets/images/logo-icon-2.png"); ?>" alt="" class="logo-icon">
    </div>
    <div class="mini-sidebar-navigation d-flex align-items-center justify-content-center">
        <ul class="nav nav-pills flex-column">
            <?php
            foreach ($routes as $route => $routeData) {
                echo '<li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="' . $routeData['title'] . '">';
                echo '<a href="' . base_url($route) . '" class="nav-link" data-bs-toggle="pill" data-bs-target="#' . $route . '"><ion-icon name="' . $routeData['icon'] . '"></ion-icon></a>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>

    <div class="toggle-menu-wrapper">
        <div class="toggle-menu-button">
            <ion-icon name="chevron-back-sharp"></ion-icon>
        </div>
    </div>
</div>

<!--start submenu wrapper-->
<div class="sidebar-submenu-wrapper">
    <div class="tab-content">
        <?php foreach ($routes as $route => $routeData): ?>
            <div class="tab-pane fade <?= ($route == $currentRoute) ? "active show" : "" ?>" id="<?= $route ?>">
                <div class="list-group list-group-flush">
                    <?php foreach ($routeData['submenu'] as $submenuItem): ?>
                        <a href="<?= base_url($submenuItem['route']) ?>" class="list-group-item">
                            <ion-icon name="<?= $submenuItem['icon'] ?>"></ion-icon>
                            <?= $submenuItem['title'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!--end submenu wrapper-->
<!--end sidebar wrapper-->

<style>
    .sidebar-submenu-wrapper {
    background-color: #f3f4f6; /* Cor de fundo mais neutra */
    border: none; /* Remover bordas */
}

.tab-content {
    border: none;
}

.tab-pane {
    border: none;
}

.list-group-item {
    background-color: transparent; /* Fundo transparente */
    border: none; /* Remover bordas */
    color: #6b7280; /* Cor do texto mais escura para melhor leitura */
}

.list-group-item .d-flex {
    align-items: center;
    padding: 8px 16px; /* Ajuste no padding para mais espaço */
}

ion-icon {
    font-size: 22px; /* Tamanho dos ícones */
    color: #6b7280; /* Cor dos ícones */
  
}




.list-group-item:hover {
    color: #333 !important  ; /* Cor do texto ao passar o mouse */
}

.list-group-item {
    color: black !important  ; /* Cor do texto ao passar o mouse */
}

.list-group-item ion-icon {
    color: #4c4e4f !important  ; /* Cor do texto ao passar o mouse */
    margin-bottom: 5px;

}



/* xpath put black  /html/body/div[1]/div[1]/div[3]/div/ion-icon//div */

.toggle-menu-button {
    color: black !important;
}

    </style>

<script>
    /*
                                            let menuClicked = false;
                                        
                                            $(".mobile-menu-button").click(function() {
                                                $("body").toggleClass("mini-toggled");
                                                $(".wrapper").toggleClass("toggled2");
                                                $(".overlay").toggleClass("d-block");
                                                $(".sidebar-submenu-wrapper").toggleClass("ps");
                                                $(".tab-pane").toggleClass("fade");
                                                menuClicked = !menuClicked;
                                            });
                                        
                                            $(document).click(function(event) {
                                                const menu = $(".mobile-menu-button");
                                                const overlay = $(".overlay");
                                        
                                                if (!menu.is(event.target) && menu.has(event.target).length === 0) {
                                                    $("body").removeClass("mini-toggled");
                                                    $(".wrapper").removeClass("toggled2");
                                                    $(".overlay").removeClass("d-block");
                                                    $(".sidebar-submenu-wrapper").removeClass("ps");
                                                    $(".tab-pane").removeClass("fade");
                                                    menuClicked = false;
                                                }
                                            });
                                            */
</script>