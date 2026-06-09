<?php
$uri = service('request')->getUri();
$segment = ($uri->getTotalSegments() > 0) ? $uri->getSegment(1) : '';
?>

<header class="w-100 header-asiu-floating">
    <nav class="navbar navbar-expand-lg bg-white shadow custom-navbar mx-auto px-4 py-2">
        <div class="container-fluid">

            <a class="navbar-brand" href="<?= site_url('/') ?>">
                <img src="<?= base_url('public/dist/img/ASIU.png') ?>" alt="G.A ASIU" height="50">
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-flex align-items-center justify-content-center">
                    <i class="fas fa-bars" style="color: #0052ff; font-size: 24px;"></i>
                </span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav align-items-center text-center py-3 py-lg-0">

                    <a class="nav-link-asiu <?= ($segment == '' || $segment == 'inicio') ? 'active-asiu' : '' ?>"
                        href="<?= site_url('inicio') ?>">Inicio</a>

                    <a class="nav-link-asiu <?= ($segment == 'quienes-somos') ? 'active-asiu' : '' ?>"
                        href="<?= site_url('quienes-somos') ?>">¿Quiénes Somos?</a>

                    <a class="nav-link-asiu <?= ($segment == 'servicios') ? 'active-asiu' : '' ?>"
                        href="<?= site_url('servicios') ?>">Servicios</a>

                    <a class="nav-link-asiu"
                        href="https://webmail.grupoasiu.com">Correo Corporativo</a>


                    <a class="btn-contact-asiu <?= ($segment == 'contacto') ? 'btn-contact-active' : '' ?> ml-lg-3 mt-2 mt-lg-0"
                        href="<?= site_url('contacto') ?>">Contáctanos</a>

                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    .header-asiu-floating {
        position: absolute;
        top: 25px;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: unset;
    }


    .custom-navbar {
        max-width: 1340px;
        border: none !important;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06) !important;
    }

    .nav-link-asiu {
        color: #444444 !important;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        padding: 12px 24px !important;
        text-decoration: none !important;
        display: inline-block;
        border-radius: 10px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-link-asiu:not(.active-asiu):hover {
        color: #0052ff !important;
        background-color: rgba(0, 82, 255, 0.06);
        transform: translateY(-2px);
    }

    .nav-link-asiu.active-asiu {
        background: linear-gradient(135deg, #0044ff 0%, #0077ff 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 6px 16px rgba(0, 68, 255, 0.25);
        position: relative;
    }

    .nav-link-asiu.active-asiu::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
        width: 16px;
        height: 3px;
        background-color: #ffffff;
        border-radius: 10px;
    }

    .btn-contact-asiu {
        background-color: #5a5a5c;
        color: #ffffff !important;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        padding: 12px 28px !important;
        border-radius: 8px;
        display: inline-block;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(26, 92, 255, 0.2);
        transition: all 0.3s ease;
    }

    .btn-contact-asiu:hover,
    .btn-contact-active {
        background: linear-gradient(135deg, #0044ff 0%, #0077ff 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 68, 255, 0.35);
    }

    @media (max-width: 991.98px) {
        .header-asiu-floating {
            top: 15px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .nav-link-asiu {
            width: 100%;
            margin-bottom: 4px;
        }
    }
</style>