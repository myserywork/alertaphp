<?php

function getRoutes()
{
    return array(
        'dashboard' => array(
            'title' => 'Dashboard',
            'icon' => 'home-outline',
            'subtitle' => 'Dashboard',
            'submenu' => array(
                'dashboard' => array(
                    'title' => 'Dashboard',
                    'icon' => 'home-outline',
                    'route' => 'dashboard'
                )
            )
        ),
        'products' => array(
            'title' => 'Produtos',
            'icon' => 'storefront-outline',
            'subtitle' => 'Produtos a venda',
            'submenu' => array(
                'products' => array(
                    'title' => 'produtos',
                    'icon' => 'storefront-outline',
                    'route' => 'products'
                )
            )
        ),
        'orders' => array(
            'title' => 'Pedidos',
            'icon' => 'wallet-outline',
            'subtitle' => 'Pedidos',
            'submenu' => array(
                'orders' => array(
                    'title' => 'Pedidos',
                    'icon' => 'wallet-outline',
                    'route' => 'orders'
                )
            )
        ),
        'customers' => array(
            'title' => 'Clientes',
            'icon' => 'people-outline',
            'subtitle' => 'Clientes',
            'submenu' => array(
                'clients' => array(
                    'title' => 'Clientes',
                    'icon' => 'people-outline',
                    'route' => 'clients'
                )
            )
        ),
        'fisco_ai' => array(
            'title' => 'Inteligência Artificial',
            'icon' => 'radio-outline',
            'subtitle' => 'Robôs Inteligentes Fisco',
            'submenu' => array(
                'monitoramento_personalizado' => array(
                    'title' => 'Monitoramento Inteligente',
                    'icon' => 'pie-chart-outline',
                    'route' => 'administration/users'
                ),
                'analise_prediticia' => array(
                    'title' => 'Analise Prediticia',
                    'icon' => 'hardware-chip-outline',
                    'route' => 'administration/system'
                ),
            )
        ),
        'administration' => array(
            'title' => 'Administração',
            'icon' => 'construct-outline',
            'subtitle' => 'Administração',
            'submenu' => array(
                'usuarios' => array(
                    'title' => 'Usuários',
                    'icon' => 'person-outline',
                    'route' => 'administration/users'
                ),
                'permissoes' => array(
                    'title' => 'Permissões',
                    'icon' => 'key-outline',
                    'route' => 'administration/permissions'
                ),
                'sistema' => array(
                    'title' => 'Sistema',
                    'icon' => 'hardware-chip-outline',
                    'route' => 'administration/system'
                ),
            )
        )
    );
}