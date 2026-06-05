<?= view('layouts/header', ['title' => 'Servicios - G.A ASIU']) ?>

<?= view('layouts/nav') ?>

<link rel="stylesheet" href="<?= base_url('public/css/servicios.css') ?>">

<?php
$serviceCards = [
    [
        'logo'  => 'logo_fox.png',
        'alt'   => 'Fox Transportes',
        'title' => 'Transporte de Carga',
        'desc'  => 'Un servicio seguro y eficiente para llevar tus productos donde deben llegar, con tecnología y logística de primera.',
    ],
    [
        'logo'  => 'logo_icamar.png',
        'alt'   => 'ICAMAR',
        'title' => 'Comercialización de Motocicletas',
        'desc'  => 'Venta y ensamblaje de motos, mototaxis y movilidad ligera de marcas confiables, con atención personalizada y respaldo.',
    ],
    [
        'logo'  => 'logo_zoe.png',
        'alt'   => 'ZOE Costa',
        'title' => 'Construcción y Estructuras Metálicas',
        'desc'  => 'Proyectos estructurales ejecutados con precisión, calidad técnica y visión de largo plazo.',
    ],
    [
        'logo'  => 'logo_chas.png',
        'alt'   => 'Agencia de Marketing Digital',
        'title' => 'Servicios Digitales e Innovación',
        'desc'  => 'Estrategias creativas con resultados medibles para que tu marca no solo exista, sino que domine su mercado.',
    ],
    [
        'logo'  => 'logo_asiuselva.png',
        'alt'   => 'ASIU SELVA',
        'title' => 'Ensamblaje y Venta de Motos',
        'desc'  => 'Presencia estratégica en Tarapoto, Iquitos y Pucallpa ofreciendo vehículos menores ideales para el transporte, logística interna y trabajo de la región oriente.',
    ],
];
?>

<section class="services-hero">
    <div class="custom-container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="services-title-block">
                    <h1 class="services-title">Soluciones que<br>impulsan tu<br>negocio</h1>
                    <span class="services-title-underline" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-hero-img-container">
                    <img src="<?= base_url('public/dist/img/equipo.png') ?>" alt="Soluciones ASIU" class="services-hero-img">
                    <div class="floating-accent-bar"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services-body-section">
    <div class="custom-container text-center">

        <div class="services-section-title">
            <div class="title-side-line" aria-hidden="true"></div>
            <h2 class="services-section-heading">¿Qué ofrecemos?</h2>
            <div class="title-side-line blue-gradient" aria-hidden="true"></div>
        </div>

        <p class="section-subtitle">
            Brindamos servicios integrales diseñados para cubrir necesidades reales de empresas y emprendedores. Cada unidad de negocio responde a un objetivo claro: ayudarte a crecer.
        </p>

        <div class="row justify-content-center">
            <?php foreach ($serviceCards as $card): ?>
            <div class="col-sm-10 col-md-6 col-lg-4 service-card-wrapper">
                <div class="service-card-inner">
                    <div class="service-card-front">
                        <img src="<?= base_url('public/dist/img/' . $card['logo']) ?>" alt="<?= esc($card['alt']) ?>" class="service-brand-logo">
                    </div>
                    <div class="service-card-back">
                        <div class="service-card-content">
                            <h3 class="service-title-back"><?= esc($card['title']) ?></h3>
                            <p class="service-desc-back"><?= esc($card['desc']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= view('layouts/footer') ?>
