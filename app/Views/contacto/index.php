<?= view('layouts/header', ['title' => 'Contáctanos - G.A ASIU']) ?>

<?= view('layouts/nav') ?>

<link rel="stylesheet" href="<?= base_url('public/css/contacto.css') ?>">

<?php
$formFields = [
    [
        'name'  => 'nombre',
        'label' => 'Nombre',
        'type'  => 'text',
    ],
    [
        'name'  => 'celular',
        'label' => 'Celular',
        'type'  => 'tel',
    ],
    [
        'name'  => 'email',
        'label' => 'Email',
        'type'  => 'email',
    ],
    [
        'name'       => 'mensaje',
        'label'      => '¿En qué te podemos ayudar?',
        'type'       => 'textarea',
        'rows'       => 4,
        'groupClass' => 'mb-5',
    ],
];
?>

<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">

                <div class="contact-card">
                    <div class="contact-section-title">
                        <span class="title-side-line blue-gradient" aria-hidden="true"></span>
                        <h2 class="contact-title">Formulario de contacto</h2>
                        <span class="title-side-line blue-gradient" aria-hidden="true"></span>
                    </div>

                    <form action="#" method="POST" novalidate>
                        <?php foreach ($formFields as $field): ?>
                        <div class="form-group <?= esc($field['groupClass'] ?? 'mb-4') ?>">
                            <label class="contact-label" for="contact-<?= esc($field['name']) ?>"><?= esc($field['label']) ?></label>
                            <?php if (($field['type'] ?? '') === 'textarea'): ?>
                            <textarea
                                id="contact-<?= esc($field['name']) ?>"
                                name="<?= esc($field['name']) ?>"
                                rows="<?= (int) ($field['rows'] ?? 4) ?>"
                                class="form-control contact-input contact-textarea"
                                required
                            ></textarea>
                            <?php else: ?>
                            <input
                                type="<?= esc($field['type']) ?>"
                                id="contact-<?= esc($field['name']) ?>"
                                name="<?= esc($field['name']) ?>"
                                class="form-control contact-input"
                                required
                                autocomplete="off"
                            >
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>

                        <div class="text-center">
                            <button type="submit" class="btn btn-send-asiu">Enviar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<?= view('layouts/footer') ?>
