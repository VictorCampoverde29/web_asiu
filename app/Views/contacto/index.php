<?= view('layouts/header', ['title' => 'Contáctanos - G.A ASIU']) ?>

<?= view('layouts/nav') ?>

<link rel="stylesheet" href="<?= base_url('public/css/contacto.css') ?>">

<?php
$formFields = [
    [
        'name'  => 'name',
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
        'name'       => 'message',
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

                    <form id="contact-form" action="<?= base_url('contacto/enviar') ?>" method="POST" novalidate>
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

                        <!-- Cloudflare Turnstile Widget -->
                        <div class="text-center mb-4">
                            <div class="cf-turnstile" data-sitekey="<?= env('TURNSTILE_SITE_KEY') ?>"></div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-send-asiu">Enviar</button>
                        </div>
                    </form>

                    <!-- Mensaje de estado -->
                    <div id="form-message" class="mt-4 text-center" style="display:none;"></div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Cloudflare Turnstile API -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const messageDiv = document.getElementById('form-message');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Verificar que Turnstile se haya completado
        const turnstileResponse = document.querySelector('[name="cf-turnstile-response"]');
        if (!turnstileResponse || !turnstileResponse.value) {
            messageDiv.style.display = 'block';
            messageDiv.innerHTML = '<div class="alert alert-warning">Por favor, completa la verificación de seguridad (Turnstile).</div>';
            return;
        }

        // Deshabilitar botón para evitar doble envío
        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Enviando...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            messageDiv.style.display = 'block';
            if (data.success) {
                messageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                form.reset();
                // Reiniciar Turnstile
                if (typeof turnstile !== 'undefined') {
                    turnstile.reset();
                }
            } else {
                messageDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                // Reiniciar Turnstile para reintentar
                if (typeof turnstile !== 'undefined') {
                    turnstile.reset();
                }
            }
        })
        .catch(error => {
            messageDiv.style.display = 'block';
            messageDiv.innerHTML = '<div class="alert alert-danger">Ocurrió un error al enviar el formulario. Intenta de nuevo.</div>';
            if (typeof turnstile !== 'undefined') {
                turnstile.reset();
            }
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = 'Enviar';
            // Scroll al mensaje
            messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });
});
</script>

<?= view('layouts/footer') ?>
