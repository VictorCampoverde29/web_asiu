<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('public/dist/img/favicon.ico') ?>">

    <title><?php if (isset($title)): ?><?= $title ?><?php endif; ?></title>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;0,900;1,700&display=swap" rel="stylesheet">

    <style>
    body {
        background-color: #ffffff;
        color: #333333;
    }
        .bg-asiu-blue { 
            background: linear-gradient(135deg, #0052ff 0%, #00d4ff 100%) !important; 
        }

        .text-asiu-blue { 
            color: #0052ff !important; 
        }
        
        .fw-300 { font-weight: 300 !important; }
        .fw-400 { font-weight: 400 !important; }
        .fw-700 { font-weight: 700 !important; }
        .fw-900 { font-weight: 900 !important; }
        .text-italic { font-style: italic !important; }
        .letter-spacing-1 { letter-spacing: 1px; }

        .custom-container {
            width: 100%;
            max-width: 1340px;
            margin-right: auto;
            margin-left: auto;
            padding-right: 20px;
            padding-left: 20px;
        }

        .social-sidebar {
            position: fixed;
            right: 20px;
            bottom: 40px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-sidebar-btn {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff !important;
            font-size: 1.5rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .social-sidebar-btn:hover { 
            transform: scale(1.1) translateX(-3px); 
        }

        .social-sidebar-btn.fb { 
            background-color: #ffffff;
            color: #1B5AF5 !important;
        }

        .social-sidebar-btn.ig,
        .social-sidebar-btn.in,
        .social-sidebar-btn.wa { 
            background-color: #1B5AF5; 
        }
    </style>
</head>

<body>

<div class="social-sidebar d-none d-md-flex">
    <a href="https://www.facebook.com/profile.php?id=61590757046336" target="_blank" class="social-sidebar-btn fb">
        <i class="fab fa-facebook-f"></i>
    </a>

    <a href="https://www.instagram.com/grupoasiu/" target="_blank" class="social-sidebar-btn ig">
        <i class="fab fa-instagram"></i>
    </a>

    <a href="https://www.linkedin.com/company/grupo-asiu/" target="_blank" class="social-sidebar-btn in">
        <i class="fab fa-linkedin-in"></i>
    </a>

    <a href="https://wa.me/51975678920" target="_blank" class="social-sidebar-btn wa">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>