<?php

declare(strict_types=1);

/*|--------------------------------------------------------------------------
 | Router Engine Configuration
 |--------------------------------------------------------------------------
 |
 | پیکربندی موتور router — همهٔ کلیدهای مستندشده در `docs/03-engines/router.md` بخش «پیکربندی».
 |
 |@see https://github.com/Derogaramin/Tavaan-Doc/blob/main/docs/03-engines/router.md
 */

return [
    /*| پیش‌فرض موتور (driver/store یا حالت فعال) */
    'default' => env('ROUTER_DEFAULT', 'default'),

    /*| کلید کش (در صورت استفاده) */
    'prefix' => env('ROUTER_PREFIX', 'router:'),

    /*| تنظیمات لاگ */
    'log' => [
        'channel' => env('ROUTER_LOG_CHANNEL', 'router'),
    ],

    /*| Facade */
    'facade' => [
        'name' => 'Route',
        'accessor' => 'router',
    ],

    /*| سایر کلیدها (طبق مستندات) */
    'options' => [
        // TODO: کلیدهای اضافی طبق سند §۶ (پیکربندی)
    ],
];