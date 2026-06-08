<?= view('layouts/header', ['title' => 'Inicio']) ?>

<?= view('layouts/nav') ?>

<link rel="stylesheet" href="<?= base_url('public/css/inicio.css') ?>">

<?php
$heroSlides = [
    [
        'img'    => 'logo_icamar.png',
        'alt'    => 'Logo Icamar',
        'filter' => 'drop-shadow(0px 8px 10px rgba(0,0,0,0.15))',
        'label'  => 'Icamar',
        'photos' => [
            ['img' => 'empresas/icamar1.webp', 'label' => 'Repuestos Originales'],
            ['img' => 'empresas/icamar2.webp', 'label' => 'Precios Especiales'],
            ['img' => 'empresas/icamar3.webp', 'label' => 'Stock Disponible'],
        ],
        'active' => true,
    ],
    [
        'img'    => 'logo_zoe.png',
        'alt'    => 'Logo Zoe',
        'filter' => 'brightness(0) invert(1) drop-shadow(0px 8px 10px rgba(0,0,0,0.3))',
        'label'  => 'Zoe',
        'photos' => [
            ['img' => 'empresas/zoe1.webp', 'label' => 'Atención'],
            ['img' => 'empresas/zoe2.webp', 'label' => 'Instalaciones'],
            ['img' => 'empresas/zoe3.webp', 'label' => 'Operaciones'],
        ],
    ],
    [
        'img'    => 'logo_fox.png',
        'alt'    => 'Logo Fox',
        'filter' => 'brightness(0) invert(1) drop-shadow(0px 8px 10px rgba(0,0,0,0.3))',
        'label'  => 'Fox',
        'photos' => [
            ['img' => 'empresas/fox1.webp', 'label' => 'Carga'],
            ['img' => 'empresas/fox2.webp', 'label' => 'Rutas'],
            ['img' => 'empresas/fox3.webp', 'label' => 'Flota'],
        ],
    ],
    [
        'img'    => 'logo_asiuselva.png',
        'alt'    => 'Logo Asiu Selva',
        'filter' => 'brightness(0) invert(1) drop-shadow(0px 8px 10px rgba(0,0,0,0.3))',
        'label'  => 'Selva',
        'photos' => [
            ['img' => 'empresas/asiuselva1.webp', 'label' => 'Proyectos'],
            ['img' => 'empresas/asiuselva2.webp', 'label' => 'Equipo'],
            ['img' => 'empresas/asiuselva3.webp', 'label' => 'Servicios'],
        ],
    ],
    [
        'img'    => 'logo_chin.png',
        'alt'    => 'Logo GH Sachin',
        'filter' => 'brightness(0) invert(1) drop-shadow(0px 8px 10px rgba(0,0,0,0.3))',
        'label'  => 'Sachin',
        'photos' => [
            ['img' => 'empresas/sachin1.webp', 'label' => 'Rapidez'],
            ['img' => 'empresas/sachin2.webp', 'label' => 'Buen Acabado'],
            ['img' => 'empresas/sachin3.webp', 'label' => 'Eficiencia'],
        ],
    ],
];

$marqueeLogos = [
    ['src' => 'logo_zoe.png', 'alt' => 'Zoe Costa', 'class' => 'brand-logo'],
    ['src' => 'logo_asiuselva.png', 'alt' => 'Asiu Selva', 'class' => 'brand-logo'],
    ['src' => 'logo_fox.png', 'alt' => 'Fox Transportes', 'class' => 'brand-logo logo-fox'],
    ['src' => 'logo_icamar.png', 'alt' => 'Icamar', 'class' => 'brand-logo'],
    ['src' => 'logo_chin.png', 'alt' => 'GH Sachin', 'class' => 'brand-logo'],
    ['src' => 'logo_chas.png', 'alt' => 'CHAS', 'class' => 'brand-logo'],
];

$pilaresCards = [
    ['offset' => 'card-down', 'icon' => 'fa-chart-line', 'title' => 'Resultados tangibles', 'text' => 'Más que promesas, hechos.'],
    ['offset' => 'card-up', 'icon' => 'fa-award', 'title' => 'Solidez regional y visión nacional', 'text' => 'Creciendo contigo.'],
    ['offset' => 'card-down', 'icon' => 'fa-tasks', 'title' => 'Innovación constante', 'text' => 'Hacia soluciones que funcionan.'],
    ['offset' => 'card-up', 'icon' => 'fa-headset', 'title' => 'Servicio centrado en el cliente', 'text' => 'Tu éxito es nuestra prioridad.'],
];
?>

<section class="hero-asiu">
    <div class="custom-container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-left mb-5 mb-lg-0">
                <div class="hero-title-block">
                    <h1 class="hero-title">
                        <span class="hero-line--emphasis">Creamos</span>
                        <span class="hero-line--body hero-line--italic">empresas que</span>
                        <span class="hero-line--body">impulsan el</span>
                        <span class="hero-line--body hero-line--body-bold">progreso de</span>
                        <span class="hero-line--emphasis">tu región.</span>
                    </h1>
                    <div class="hero-title-accent"></div>
                </div>
                <div class="slider-progress-track">
                    <div class="slider-progress-thumb" id="heroProgressThumb"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="2500">
                    <div class="carousel-inner">
                        <?php foreach ($heroSlides as $slide): ?>
                        <div class="carousel-item<?= !empty($slide['active']) ? ' active' : '' ?>">
                            <div class="icamar-container mb-4">
                                <img src="<?= base_url('public/dist/img/' . $slide['img']) ?>" alt="<?= esc($slide['alt']) ?>" class="img-fluid carousel-logo" style="filter: <?= esc($slide['filter']) ?>;">
                            </div>
                            <div class="row px-3">
                                <?php foreach ($slide['photos'] as $photo): ?>
                                <div class="col-4 px-2">
                                    <div class="photo-box">
                                <img src="<?= base_url('public/dist/img/' . $photo['img']) ?>" alt="<?= esc($photo['label']) ?>" class="photo-box-img">
                                <span><?= esc($photo['label']) ?></span>
                            </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="dark-content-wrapper">
<section class="empresas-section">
    <div class="custom-container text-center">

        <p class="welcome-text mx-auto">
            Bienvenidos a Grupo ASIU, somos un grupo empresarial peruano con presencia en sectores clave como transporte, comercialización, servicios digitales y construcción. Nuestra fuerza está en transformar ideas en negocios rentables, sostenibles y en constante crecimiento.
        </p>

        <div class="mb-5">
            <a href="#" class="btn-conocenos">CONÓCENOS AQUÍ</a>
        </div>

        <div class="section-title-container">
            <div class="title-side-line"></div>
            <div class="empresas-heading">
                <span class="top-text">Nuestras</span>
                <span class="main-text">Empresas</span>
            </div>
            <div class="title-side-line blue-gradient"></div>
        </div>

        <div class="logo-marquee-container">
            <div class="logo-marquee-content">
                <?php for ($set = 0; $set < 2; $set++): ?>
                    <?php foreach ($marqueeLogos as $logo): ?>
                <img src="<?= base_url('public/dist/img/' . $logo['src']) ?>" alt="<?= esc($logo['alt']) ?>" class="<?= esc($logo['class']) ?>">
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<section class="pilares-section">
    <div class="custom-container">
        <div class="row align-items-center">

            <div class="col-xl-3 col-lg-4 mb-4 mb-lg-0 text-center pilares-header">
                <h2 class="pilares-heading">
                    <span class="pilares-heading__line">Nuestros</span>
                    <span class="pilares-heading__line pilares-heading__line--main">Pilares</span>
                </h2>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="row">
                    <?php foreach ($pilaresCards as $pilar): ?>
                    <div class="col-md-3 col-6 mb-4 mb-md-0 px-2">
                        <div class="flip-card <?= esc($pilar['offset']) ?>">
                            <div class="flip-card-inner">
                                <div class="flip-card-front card-pilar-blue">
                                    <div class="pilar-icon-wrap" aria-hidden="true">
                                        <span class="pilar-icon-ring"></span>
                                        <span class="pilar-icon-glow"></span>
                                        <i class="fas <?= esc($pilar['icon']) ?> pilar-icon"></i>
                                    </div>
                                </div>
                                <div class="flip-card-back">
                                    <h3><?= esc($pilar['title']) ?></h3>
                                    <p><?= esc($pilar['text']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>
</div>

<?= view('layouts/footer') ?>

<script src="<?= base_url('public/js/inicio.js') ?>"></script>
