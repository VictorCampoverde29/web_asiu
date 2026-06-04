document.addEventListener('DOMContentLoaded', function () {
    initHeroCarouselProgress();
    initLogoMarqueeCenter();
});

function initHeroCarouselProgress() {
    var heroCarousel = document.getElementById('heroCarousel');
    var progressThumb = document.getElementById('heroProgressThumb');

    if (!heroCarousel || !progressThumb) {
        return;
    }

    var totalItems = heroCarousel.querySelectorAll('.carousel-item').length;

    function updateProgress(index) {
        var track = progressThumb.parentElement;
        var maxLeft = track.offsetWidth - progressThumb.offsetWidth;
        var ratio = totalItems > 1 ? index / (totalItems - 1) : 0;
        progressThumb.style.left = (ratio * maxLeft) + 'px';
    }

    updateProgress(0);

    var onSlide = function (e) {
        updateProgress(e.to);
    };

    if (window.jQuery) {
        window.jQuery(heroCarousel).on('slide.bs.carousel', onSlide);
    } else {
        heroCarousel.addEventListener('slide.bs.carousel', onSlide);
    }
}

function initLogoMarqueeCenter() {
    var marqueeContainer = document.querySelector('.logo-marquee-container');

    if (!marqueeContainer) {
        return;
    }

    var logos = marqueeContainer.querySelectorAll('.brand-logo');
    var rafId = null;
    var lastCenterLogo = null;

    function updateCenterLogo() {
        var containerRect = marqueeContainer.getBoundingClientRect();
        var centerX = containerRect.left + containerRect.width / 2;
        var closestLogo = null;
        var minDistance = Infinity;

        logos.forEach(function (logo) {
            var rect = logo.getBoundingClientRect();
            var distance = Math.abs(rect.left + rect.width / 2 - centerX);

            if (distance < minDistance) {
                minDistance = distance;
                closestLogo = logo;
            }
        });

        if (closestLogo === lastCenterLogo) {
            rafId = requestAnimationFrame(updateCenterLogo);
            return;
        }

        logos.forEach(function (logo) {
            logo.classList.remove('logo-center');
        });

        if (closestLogo) {
            closestLogo.classList.add('logo-center');
        }

        lastCenterLogo = closestLogo;
        rafId = requestAnimationFrame(updateCenterLogo);
    }

    var marqueeObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                if (!rafId) {
                    rafId = requestAnimationFrame(updateCenterLogo);
                }
            } else if (rafId) {
                cancelAnimationFrame(rafId);
                rafId = null;
            }
        });
    }, { threshold: 0.1 });

    marqueeObserver.observe(marqueeContainer);
    rafId = requestAnimationFrame(updateCenterLogo);
}
