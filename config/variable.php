<?php
return [
    'root_pass' => env('DEFAULT_ROOT_PASS', 'root1234'),
    'admin_pass' => env('DEFAULT_ADMIN_PASS', 'admin1234'),
    'staff_pass' => env('DEFAULT_STAFF_PASS', 'staff1234'),

    'navigation' => [
        'root' => [
            [
                "name" => 'Dashboard',
                "icon" => 'mdi-view-dashboard',
                "url" => '/root/dashboard/',
                "breadcrumb" => ['root', 'dashboard'],
            ],
            [
                "name" => 'Orders',
                "icon" => 'mdi-library-books',
                "url" => '/root/orders/',
                "breadcrumb" => ['root', 'orders'],
            ],
            [
                "name" => 'Vehicles',
                "icon" => 'mdi-car',
                "url" => '/root/vehicles/',
                "breadcrumb" => ['root', 'vehicles'],
            ],
            [
                "name" => 'Drivers',
                "icon" => 'mdi-account-card-details',
                "url" => '/root/drivers/',
                "breadcrumb" => ['root', 'drivers'],
            ],
            [
                "name" => 'Users',
                "icon" => 'mdi-account-multiple',
                "url" => '/root/users/',
                "breadcrumb" => ['root', 'users'],
            ],
            [
                "name" => 'Logs',
                "icon" => 'mdi-code-braces',
                "url" => '/root/logs/',
                "breadcrumb" => ['root', 'logs'],
            ],
        ],
        'admin' => [
            [
                "name" => 'Dashboard',
                "icon" => 'mdi-view-dashboard',
                "url" => '/admin/dashboard/',
                "breadcrumb" => ['admin', 'dashboard'],
            ],
            [
                "name" => 'Orders',
                "icon" => 'mdi-library-books',
                "url" => '/admin/orders/',
                "breadcrumb" => ['admin', 'orders'],
            ],
            [
                "name" => 'Vehicles',
                "icon" => 'mdi-car',
                "url" => '/admin/vehicles/',
                "breadcrumb" => ['admin', 'vehicles'],
            ],
            [
                "name" => 'Drivers',
                "icon" => 'mdi-account-card-details',
                "url" => '/admin/drivers/',
                "breadcrumb" => ['admin', 'drivers'],
            ],
            [
                "name" => 'Staffs',
                "icon" => 'mdi-account-multiple',
                "url" => '/admin/staffs/',
                "breadcrumb" => ['admin', 'staffs'],
            ],
        ],
        'staff' => [
            [
                "name" => 'Dashboard',
                "icon" => 'mdi-view-dashboard',
                "url" => '/staff/dashboard/',
                "breadcrumb" => ['staff', 'dashboard'],
            ]
        ]
    ]
];