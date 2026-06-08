<style>
   
    .asiu-footer {
        background: linear-gradient(115deg, #2B6BF3 0%, #2B6BF3 45%, #1243D3 45%, #1243D3 100%);
        color: #ffffff;
        padding: 50px 0 30px 0;
        position: relative;
        margin-top: 0;
    }

    .footer-contact-title {
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        opacity: 0.9;
        margin-bottom: 4px;
    }

    .footer-main-heading {
        font-size: 1.8rem;
        font-weight: 900;
        line-height: 1.2;
    }


    .footer-contact-btn {
        background-color: #ffffff;
        color: #0052ff;
        font-weight: 700;
        text-transform: uppercase;
        padding: 12px 32px;
        font-size: 0.85rem;
        letter-spacing: 0.8px;
        border-radius: 50px;
        transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        display: inline-block;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    
    .footer-contact-btn:hover {
        background-color: #f4f7ff;
        color: #003bc2;
        text-decoration: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
    }

    .footer-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.4);
        margin: 25px 0 30px 0;
    }

    .footer-logo {
        max-height: 120px;
        width: auto;
        margin-bottom: 18px;
        filter: brightness(0) invert(1);
    }

    @media (max-width: 1199.98px) {
        .footer-logo { max-height: 180px; }
    }

    @media (max-width: 991.98px) {
        .footer-logo { max-height: 140px; }
    }

    @media (max-width: 575.98px) {
        .footer-logo { max-height: 96px; }
        .footer-contact-btn { width: 100%; text-align: center; padding: 10px 20px; }
    }

    .footer-section-title {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .footer-link-info {
        color: #ffffff;
        font-size: 0.95rem;
        line-height: 1.6;
        opacity: 0.95;
        margin-bottom: 12px;
    }
    
    .footer-link-info a {
        color: #ffffff;
        text-decoration: none;
    }

    .footer-social-icons {
        display: flex;
        gap: 15px;
    }

    .footer-social-icon-btn {
        width: 40px;
        height: 40px;
        background-color: #ffffff;
        color: #0044ff !important;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .footer-social-icon-btn:hover {
        transform: translateY(-3px);
        background-color: #f0f0f0;
    }
</style>

<footer class="asiu-footer">
    <div class="custom-container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <span class="footer-contact-title d-block">Contacto y Consultas</span>
                <h2 class="footer-main-heading italic">Hablemos de tu próximo proyecto.</h2>
            </div>
            <div class="col-lg-5 d-flex justify-content-lg-end align-items-center">
                <a href="<?= base_url('contacto') ?>" class="footer-contact-btn">Contáctanos</a>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="<?= base_url('public/dist/img/logo_ASIU.png') ?>" alt="G.A ASIU" class="footer-logo">
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h4 class="footer-section-title fw-300">Acerca de proyectos</h4>
                <p class="footer-link-info italic fw-700">
                    ¿Tienes una propuesta de proyecto?<br>
                    <a href="mailto:dalban@grupoasiu.pe" class="fw-400 text-lowercase">dalban@grupoasiu.pe</a>
                </p>
                <h4 class="footer-section-title fw-300 mt-4">Dirección</h4>
                <p class="footer-link-info fw-700">
                    Carlos Castañeda N°255 P.J. Francisco Cabrera<br>
                    <span class="fw-400">José Leonardo Ortiz - Chiclayo - Lambayeque</span>
                </p>
            </div>

            <div class="col-lg-5 col-md-6 text-lg-right">
                <h4 class="footer-section-title fw-300">Teléfonos</h4>
                <p class="footer-link-info fw-900 mb-1" style="font-size: 1.15rem;">+51 975 678 920</p>
                <p class="footer-link-info fw-900" style="font-size: 1.15rem;">+51 978 179 210</p>
                
                <div class="mt-4 d-inline-block text-lg-right">
                    <h4 class="footer-section-title fw-300 mb-2">Redes Sociales</h4>
                    <div class="footer-social-icons justify-content-lg-end">
                        <a href="https://www.facebook.com/profile.php?id=61590757046336" target="_blank" class="footer-social-icon-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/grupoasiu/" target="_blank" class="footer-social-icon-btn"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>