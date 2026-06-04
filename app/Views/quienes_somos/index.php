<?= view('layouts/header', ['title' => '¿Quiénes Somos?']) ?>

<?= view('layouts/nav') ?>

<link rel="stylesheet" href="<?= base_url('public/css/quienes_somos.css') ?>">

<?php
$historiaSlides = [
    [
        'active' => true,
        'paragraphs' => [
            'Grupo ASIU nace en Lambayeque como el resultado de una visión emprendedora clara: construir negocios sólidos que respondan a necesidades reales del mercado.<br><br>Fundado por Segundo Chambergo y Magali Asiu, el grupo inició sus operaciones con un taller de tapicería, demostrando desde el primer día compromiso con la calidad, el trabajo constante y la mejora continua.',
        ],
    ],
    [
        'paragraphs' => [
            'Con el tiempo, esa base operativa se transformó en algo más grande. La empresa comenzó a expandirse hacia nuevas oportunidades, incursionando en la venta y ensamblaje de motos, el transporte de carga, el marketing digital y la construcción.',
        ],
    ],
    [
        'paragraphs' => [
            'Lo que empezó como un emprendimiento local se convirtió en un grupo empresarial diversificado, reconocido en la región por su capacidad de adaptación, innovación y ejecución eficiente.',
            'Hoy, Grupo ASIU integra distintas unidades de negocio que operan de manera estratégica y complementaria. Cada empresa dentro del grupo comparte un mismo propósito: generar crecimiento sostenible, oportunidades económicas y valor real para sus clientes.',
        ],
    ],
    [
        'paragraphs' => [
            'Nuestra evolución no ha sido casualidad. Ha sido el resultado de decisiones estratégicas, aprendizaje constante y una cultura empresarial basada en la responsabilidad y el compromiso.',
        ],
        'textClass' => 'qs-text font-weight-bold',
        'textStyle' => 'font-size: 1.1rem;',
    ],
];

$mvCards = [
    [
        'label' => 'Misión',
        'text'  => 'Desarrollar negocios sólidos, innovadores y eficientes que brinden soluciones reales al mercado, garantizando calidad operativa y generando un impacto positivo en la región.',
    ],
    [
        'label' => 'Visión',
        'text'  => 'Consolidarnos como un referente empresarial en el norte del Perú, expandiendo nuestra presencia a nivel nacional e internacional, manteniendo siempre innovación, excelencia operativa y desarrollo sostenible.',
    ],
];

$hexValues = [
    ['icon' => 'fas fa-handshake', 'text' => 'Compromiso<br>con la<br>excelencia', 'tooltip' => 'Buscamos hacer las cosas bien desde el inicio. Nos enfocamos en la calidad operativa, el cumplimiento de objetivos y la mejora constante en cada una de nuestras unidades de negocio.'],
    ['icon' => 'far fa-lightbulb', 'text' => 'Innovación<br>estratégica', 'tooltip' => 'Fomentamos la creatividad y la implementación de nuevas tecnologías para optimizar nuestros procesos y servicios.'],
    ['icon' => 'fas fa-shield-alt', 'text' => 'Responsabilidad<br>empresarial', 'tooltip' => 'Actuamos de forma ética, cuidando el impacto social y económico de nuestras operaciones en la región.'],
    ['icon' => 'fas fa-hands-helping', 'text' => 'Orientación<br>al cliente', 'tooltip' => 'El cliente es el centro de nuestras decisiones. Nos adaptamos para superar sus expectativas diarias.'],
    ['icon' => 'fas fa-users-cog', 'text' => 'Trabajo en<br>equipo', 'tooltip' => 'Valoramos el aporte de cada colaborador, creando sinergias para lograr metas en común.'],
    ['icon' => 'fas fa-globe-americas', 'text' => 'Desarrollo<br>sostenible', 'tooltip' => 'Promovemos prácticas sostenibles que aseguran el cuidado del medio ambiente para futuras generaciones.'],
];

$mapCities = ['Sullana', 'Chiclayo', 'Tarapoto', 'Pucallpa', 'Lima'];

$mapPins = [
    ['city' => 'Sullana', 'region' => 'PEPIU', 'top' => '27%', 'left' => '21.5%'],
    ['city' => 'Chiclayo', 'region' => 'PELAM', 'top' => '35.2%', 'left' => '27%'],
    ['city' => 'Tarapoto', 'region' => 'PESAM', 'top' => '39.4%', 'left' => '41%'],
    ['city' => 'Pucallpa', 'region' => 'PEUCA', 'top' => '54.4%', 'left' => '59.6%'],
    ['city' => 'Lima', 'region' => 'PELIM', 'top' => '66%', 'left' => '44.6%', 'capital' => true],
];

$westCityTags = ['Sullana', 'Chiclayo', 'Lima'];
$eastCityTags = ['Tarapoto', 'Pucallpa'];

$metrics = [
    ['key' => 'north', 'target' => 1, 'value' => '01', 'label' => 'grupo', 'desc' => 'Estructura corporativa'],
    ['key' => 'reach', 'target' => 6, 'value' => '06', 'label' => 'empresas', 'desc' => 'Cobertura operativa'],
    ['key' => 'capital', 'target' => 50, 'value' => '+50', 'label' => 'colaboradores', 'desc' => 'Talento en crecimiento'],
];
?>

<section class="historia-section">
    <div class="custom-container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 pr-lg-5">
                <div class="qs-title-block">
                    <h1 class="qs-title">¿Quiénes<br>Somos?<span class="title-underline"></span></h1>
                </div>

                <div class="qs-carousel">
                    <?php foreach ($historiaSlides as $slide): ?>
                    <div class="qs-slide<?= !empty($slide['active']) ? ' active' : '' ?>">
                        <?php foreach ($slide['paragraphs'] as $paragraph): ?>
                        <p class="<?= esc($slide['textClass'] ?? 'qs-text') ?>"<?= !empty($slide['textStyle']) ? ' style="' . esc($slide['textStyle']) . '"' : '' ?>><?= $paragraph ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="qs-indicators mt-4">
                    <?php foreach ($historiaSlides as $index => $slide): ?>
                    <div class="qs-indicator<?= !empty($slide['active']) ? ' active' : '' ?>" data-slide="<?= $index ?>" role="button" tabindex="0" aria-label="Ir al slide <?= $index + 1 ?>"></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="team-image-container">
                    <img src="<?= base_url('public/dist/img/grupo_asiu.png') ?>" alt="Equipo G.A ASIU" class="team-image">
                    <div class="floating-white-box"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="valores-section">
    <div class="custom-container">

        <div class="mv-cards-wrapper">
            <div class="mv-cards-stage">
                <div class="mv-deco-lines mv-deco-lines--backdrop" aria-hidden="true">
                    <span class="mv-line mv-line--white"></span>
                    <span class="mv-line mv-line--blue"></span>
                </div>

                <div class="mv-deco-bridge" aria-hidden="true">
                    <span class="mv-line mv-line--white"></span>
                    <span class="mv-line mv-line--blue"></span>
                </div>

                <?php foreach ($mvCards as $card): ?>
                <article class="mv-card" tabindex="0">
                    <div class="mv-card-inner">
                        <div class="mv-card-panel-wrap">
                            <div class="mv-card-panel">
                                <div class="mv-card-panel-body">
                                    <p class="mv-card-text"><?= esc($card['text']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="mv-card-footer">
                            <h2 class="mv-card-label"><?= esc($card['label']) ?></h2>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="hex-wrapper">
            <?php foreach ($hexValues as $hex): ?>
            <div class="hex-container">
                <div class="hex-tooltip"><?= esc($hex['tooltip']) ?></div>
                <div class="hex-shadow">
                    <div class="hexagon">
                        <i class="<?= esc($hex['icon']) ?> hex-icon"></i>
                        <span class="hex-text"><?= $hex['text'] ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="custom-container">
        <div class="map-stats-stage">
            <svg class="map-presence-svg" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <?php foreach ($mapCities as $city): ?>
                <path class="map-presence-svg__path map-presence-svg__path--city" data-path="city" data-city="<?= esc($city) ?>"></path>
                <circle class="map-presence-svg__dot" data-dot="city" data-city="<?= esc($city) ?>" r="3"></circle>
                <?php endforeach; ?>
                <?php foreach ($metrics as $metric): ?>
                <path class="map-presence-svg__path map-presence-svg__path--metric" data-path="metric" data-metric="<?= esc($metric['key']) ?>"></path>
                <circle class="map-presence-svg__dot" data-dot="metric" data-metric="<?= esc($metric['key']) ?>" r="3.5"></circle>
                <?php endforeach; ?>
            </svg>

            <div class="map-presence-core">
                <aside class="map-city-lane" aria-hidden="true">
                    <?php foreach ($westCityTags as $city): ?>
                    <div class="map-city-tag" data-city="<?= esc($city) ?>">
                        <span class="map-city-tag__name"><?= esc($city) ?></span>
                        <span class="map-city-tag__node"></span>
                    </div>
                    <?php endforeach; ?>
                </aside>

                <div class="map-stats-map text-center">
                    <div class="peru-map-container">
                        <?= file_get_contents(FCPATH . 'public/dist/img/pe.svg') ?>

                        <?php foreach ($mapPins as $pin): ?>
                        <div class="map-pin map-pin--labeled<?= !empty($pin['capital']) ? ' map-pin--capital' : '' ?>" style="top: <?= esc($pin['top']) ?>; left: <?= esc($pin['left']) ?>;" data-city="<?= esc($pin['city']) ?>" data-region="<?= esc($pin['region']) ?>" tabindex="0">
                            <span class="map-pin-pulse" aria-hidden="true"></span>
                            <span class="map-pin-core"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></span>
                            <span class="pin-tooltip"><?= esc($pin['city']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <aside class="map-city-lane" aria-hidden="true">
                    <?php foreach ($eastCityTags as $city): ?>
                    <div class="map-city-tag" data-city="<?= esc($city) ?>">
                        <span class="map-city-tag__name"><?= esc($city) ?></span>
                        <span class="map-city-tag__node"></span>
                    </div>
                    <?php endforeach; ?>
                </aside>
            </div>

            <aside class="map-metrics" aria-label="Indicadores de presencia">
                <?php foreach ($metrics as $metric): ?>
                <div class="metric-card" data-metric="<?= esc($metric['key']) ?>">
                    <span class="metric-card__value stat-number" data-target="<?= (int) $metric['target'] ?>"><?= esc($metric['value']) ?></span>
                    <span class="metric-card__label"><?= esc($metric['label']) ?></span>
                    <span class="metric-card__desc"><?= esc($metric['desc']) ?></span>
                </div>
                <?php endforeach; ?>
            </aside>
        </div>
    </div>
</section>

<?= view('layouts/footer') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="<?= base_url('public/js/quienes_somos.js') ?>"></script>
