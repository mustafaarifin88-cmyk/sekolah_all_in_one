<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;
use App\Filters\AdminFilter;
use App\Filters\GuruFilter;
use App\Filters\WalikelasFilter;
use App\Filters\SiswaFilter;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => AuthFilter::class,
        'admin'         => AdminFilter::class,
        'guru'          => GuruFilter::class,
        'walikelas'     => WalikelasFilter::class,
        'siswa'         => SiswaFilter::class,
    ];

    public array $globals = [
        'before' => [],
        'after'  => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}