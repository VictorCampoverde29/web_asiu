var MAP_CITIES = ['Sullana', 'Chiclayo', 'Lima', 'Tarapoto', 'Pucallpa'];

function initHistoriaCarousel() {
    var qsCarousel = document.querySelector('.qs-carousel');
    if (!qsCarousel) {
        return;
    }

    var slides = document.querySelectorAll('.qs-slide');
    var indicators = document.querySelectorAll('.qs-indicator');
    var currentSlide = 0;
    var slideInterval;

    function setCarouselMinHeight() {
        if (!slides.length) {
            return;
        }

        var maxHeight = 0;

        slides.forEach(function (slide) {
            slide.style.position = 'static';
            slide.style.visibility = 'visible';
            slide.style.opacity = '1';
            maxHeight = Math.max(maxHeight, slide.offsetHeight);
            slide.style.position = '';
            slide.style.visibility = '';
            slide.style.opacity = '';
        });

        qsCarousel.style.minHeight = (maxHeight + 8) + 'px';
    }

    function goToSlide(index) {
        if (index === currentSlide) {
            return;
        }

        slides[currentSlide].classList.remove('active');
        indicators[currentSlide].classList.remove('active');
        currentSlide = index;
        slides[currentSlide].classList.add('active');
        indicators[currentSlide].classList.add('active');
        resetInterval();
    }

    function nextSlide() {
        goToSlide((currentSlide + 1) % slides.length);
    }

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 6000);
    }

    indicators.forEach(function (indicator) {
        indicator.addEventListener('click', function () {
            var index = parseInt(indicator.getAttribute('data-slide'), 10);
            if (!isNaN(index)) {
                goToSlide(index);
            }
        });
    });

    setCarouselMinHeight();
    window.addEventListener('resize', setCarouselMinHeight);
    slideInterval = setInterval(nextSlide, 6000);
}

function initStatCounters() {
    var counters = document.querySelectorAll('.stat-number');
    if (!counters.length) {
        return;
    }

    var counterObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) {
                return;
            }

            var el = entry.target;
            var target = parseInt(el.dataset.target, 10);
            var current = 0;
            var stepTime = Math.abs(Math.floor(2000 / target));
            var timer = setInterval(function () {
                current++;
                if (target < 10) {
                    el.textContent = current.toString().padStart(2, '0');
                } else {
                    el.textContent = '+' + current;
                }
                if (current >= target) {
                    clearInterval(timer);
                }
            }, stepTime);

            observer.unobserve(el);
        });
    }, { threshold: 0.5 });

    counters.forEach(function (counter) {
        counterObserver.observe(counter);
    });
}

function initMapSection() {
    var mapSection = document.querySelector('.map-section');
    if (!mapSection) {
        return;
    }

    var mapContainer = document.querySelector('.peru-map-container');
    var mapStage = document.querySelector('.map-stats-stage');
    var presenceCore = document.querySelector('.map-presence-core');
    var presenceSvg = document.querySelector('.map-presence-svg');
    var regionPaths = document.querySelectorAll('.peru-map-container svg #features path');
    var presenceAnimationsBound = false;

    ['PEPIU', 'PELAM', 'PESAM', 'PELIM', 'PEUCA'].forEach(function (regionId) {
        var path = document.getElementById(regionId);
        if (path) {
            path.classList.add('region-presence');
        }
    });

    function clearRegionHighlight() {
        regionPaths.forEach(function (path) {
            path.classList.remove('region-active', 'region-dimmed');
        });
        mapContainer?.classList.remove('is-pin-hover');
    }

    function highlightRegion(regionId) {
        clearRegionHighlight();
        if (!regionId) {
            return;
        }
        var activePath = document.getElementById(regionId);
        if (!activePath) {
            return;
        }
        mapContainer?.classList.add('is-pin-hover');
        activePath.classList.add('region-active');
        regionPaths.forEach(function (path) {
            if (path.id !== regionId) {
                path.classList.add('region-dimmed');
            }
        });
    }

    document.querySelectorAll('.map-pin[data-region]').forEach(function (pin) {
        pin.addEventListener('mouseenter', function () { highlightRegion(pin.dataset.region); });
        pin.addEventListener('mouseleave', clearRegionHighlight);
        pin.addEventListener('focus', function () { highlightRegion(pin.dataset.region); });
        pin.addEventListener('blur', clearRegionHighlight);
    });

    var CITY_LINE_CONFIG = {
        Sullana:  { side: 'west', stub: 56 },
        Chiclayo: { side: 'west', stub: 86 },
        Lima:     { side: 'west', stub: 66 },
        Tarapoto: { side: 'east', stub: 166 },
        Pucallpa: { side: 'east', stub: 136 }
    };

    function getCityLineConfig(city) {
        return CITY_LINE_CONFIG[city] || { side: 'west', stub: 36 };
    }

    function getEffectiveStub(cfg, anchorX, tagWidth, coreRect, side) {
        var stub = cfg.stub;
        var w = window.innerWidth;

        if (w < 992) {
            var scale = w < 480 ? 0.36 : (w < 768 ? 0.46 : 0.56);
            stub = Math.round(stub * scale);
        }

        var coreWidth = coreRect.width;
        var metricsPanel = mapStage.querySelector('.map-metrics');
        var eastLimit = coreWidth - 8;

        if (metricsPanel && w >= 992) {
            eastLimit = metricsPanel.getBoundingClientRect().left - coreRect.left - 14;
        }

        if (side === 'west') {
            stub = Math.min(stub, anchorX - tagWidth - 8);
        } else {
            stub = Math.min(stub, eastLimit - anchorX - tagWidth - 8);
        }

        return Math.max(10, stub);
    }

    function pinMapPoint(city) {
        var pin = mapContainer.querySelector('.map-pin[data-city="' + city + '"]');
        if (!pin) {
            return null;
        }
        var mapRect = mapContainer.getBoundingClientRect();
        var leftPct = parseFloat(pin.style.left);
        var topPct = parseFloat(pin.style.top);
        if (isNaN(leftPct) || isNaN(topPct)) {
            return null;
        }
        return {
            x: mapRect.left + mapRect.width * (leftPct / 100),
            y: mapRect.top + mapRect.height * (topPct / 100)
        };
    }

    function pinAnchor(city, stageRect) {
        var point = pinMapPoint(city);
        if (!point) {
            return null;
        }
        return {
            x: point.x - stageRect.left,
            y: point.y - stageRect.top
        };
    }

    function positionCityTags() {
        var coreRect = presenceCore.getBoundingClientRect();
        var coreWidth = coreRect.width;

        MAP_CITIES.forEach(function (city) {
            var pin = mapContainer.querySelector('.map-pin[data-city="' + city + '"]');
            var tag = presenceCore.querySelector('.map-city-tag[data-city="' + city + '"]');
            var point = pinMapPoint(city);
            if (!pin || !tag || !point) {
                return;
            }

            var cfg = getCityLineConfig(city);
            var anchorX = point.x - coreRect.left;
            var anchorY = point.y - coreRect.top;
            var tagWidth = tag.offsetWidth;
            var stub = getEffectiveStub(cfg, anchorX, tagWidth, coreRect, cfg.side);
            var lineEndX = cfg.side === 'east' ? anchorX + stub : anchorX - stub;
            var tagLeft = cfg.side === 'east' ? lineEndX : lineEndX - tagWidth;

            tag.classList.remove('map-city-tag--place-west', 'map-city-tag--place-east');
            tag.classList.add(cfg.side === 'east' ? 'map-city-tag--place-east' : 'map-city-tag--place-west');

            tag.style.top = anchorY + 'px';
            tag.style.transform = 'translateY(-50%)';
            tag.style.right = 'auto';
            tag.style.left = Math.min(Math.max(6, tagLeft), coreWidth - tagWidth - 6) + 'px';
        });
    }

    function cityConnector(city, stageRect) {
        var anchor = pinAnchor(city, stageRect);
        var tagName = presenceCore.querySelector('.map-city-tag[data-city="' + city + '"] .map-city-tag__name');
        var tag = presenceCore.querySelector('.map-city-tag[data-city="' + city + '"]');
        if (!anchor || !tagName) {
            return null;
        }
        var cfg = getCityLineConfig(city);
        var coreRect = presenceCore.getBoundingClientRect();
        var anchorX = anchor.x + stageRect.left - coreRect.left;
        var stub = getEffectiveStub(cfg, anchorX, tag ? tag.offsetWidth : 0, coreRect, cfg.side);
        var nameRect = tagName.getBoundingClientRect();
        var labelY = nameRect.top + nameRect.height / 2 - stageRect.top;
        var lineEndX = cfg.side === 'east' ? anchor.x + stub : anchor.x - stub;

        return {
            from: { x: anchor.x, y: labelY },
            to: { x: lineEndX, y: labelY },
            dot: { x: anchor.x, y: labelY }
        };
    }

    function metricAccent(metricKey, stageRect) {
        var card = mapStage.querySelector('.metric-card[data-metric="' + metricKey + '"]');
        var value = card ? card.querySelector('.metric-card__value') : null;
        var metricsPanel = mapStage.querySelector('.map-metrics');
        if (!value || !metricsPanel) {
            return null;
        }
        var valueRect = value.getBoundingClientRect();
        var metricsRect = metricsPanel.getBoundingClientRect();
        var maxStub = 26;
        var endX = valueRect.left - stageRect.left - 14;
        var endY = valueRect.top - stageRect.top + valueRect.height * 0.38;
        var startX = endX - maxStub;
        var metricsEdge = metricsRect.left - stageRect.left + 2;
        startX = Math.max(startX, metricsEdge);
        if (endX - startX < 6) {
            return null;
        }
        return {
            from: { x: startX, y: endY },
            to: { x: endX, y: endY }
        };
    }

    function resetPathStroke(path) {
        var len = path.getTotalLength();
        if (len <= 0) {
            return;
        }
        path.style.strokeDasharray = String(len);
        path.style.strokeDashoffset = String(len);
    }

    function syncPresenceStrokeState() {
        var st = typeof ScrollTrigger !== 'undefined' ? ScrollTrigger.getById('map-presence') : null;
        var revealed = st && st.progress > 0;
        presenceSvg?.querySelectorAll('.map-presence-svg__path').forEach(function (path) {
            if (revealed) {
                path.style.strokeDashoffset = '0';
            } else {
                resetPathStroke(path);
            }
        });
    }

    function drawPresenceLayout() {
        if (!mapStage || !presenceCore || !presenceSvg || !mapContainer) {
            mapStage?.classList.remove('is-presence-ready');
            return;
        }

        mapStage.classList.remove('is-presence-ready');

        var stageRect = mapStage.getBoundingClientRect();
        presenceSvg.setAttribute('viewBox', '0 0 ' + stageRect.width + ' ' + stageRect.height);

        positionCityTags();

        MAP_CITIES.forEach(function (city) {
            var conn = cityConnector(city, stageRect);
            var path = presenceSvg.querySelector('[data-path="city"][data-city="' + city + '"]');
            var dot = presenceSvg.querySelector('[data-dot="city"][data-city="' + city + '"]');
            if (!conn || !path) {
                return;
            }
            path.setAttribute('d', 'M ' + conn.from.x + ' ' + conn.from.y + ' L ' + conn.to.x + ' ' + conn.to.y);
            resetPathStroke(path);
            if (dot) {
                dot.setAttribute('cx', conn.dot.x);
                dot.setAttribute('cy', conn.dot.y);
            }
        });

        if (window.innerWidth >= 992) {
            ['north', 'reach', 'capital'].forEach(function (key) {
                var conn = metricAccent(key, stageRect);
                var path = presenceSvg.querySelector('[data-path="metric"][data-metric="' + key + '"]');
                var dot = presenceSvg.querySelector('[data-dot="metric"][data-metric="' + key + '"]');
                if (!conn || !path) {
                    return;
                }
                path.setAttribute('d', 'M ' + conn.from.x + ' ' + conn.from.y + ' L ' + conn.to.x + ' ' + conn.to.y);
                resetPathStroke(path);
                if (dot) {
                    dot.setAttribute('cx', conn.to.x);
                    dot.setAttribute('cy', conn.to.y);
                }
            });
        } else {
            presenceSvg.querySelectorAll('[data-path="metric"]').forEach(function (path) {
                path.removeAttribute('d');
            });
        }

        mapStage.classList.add('is-presence-ready');
        syncPresenceStrokeState();
    }

    function bindPresenceAnimations() {
        if (presenceAnimationsBound || typeof gsap === 'undefined') {
            return;
        }
        presenceAnimationsBound = true;

        gsap.registerPlugin(ScrollTrigger);

        gsap.from('.peru-map-container > svg', {
            scrollTrigger: {
                trigger: '.map-section',
                start: 'top 75%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 50,
            duration: 1,
            ease: 'power3.out'
        });

        gsap.utils.toArray('.map-pin').forEach(function (pin, i) {
            gsap.fromTo(pin,
                { scale: 0, opacity: 0, y: -30 },
                {
                    scrollTrigger: {
                        trigger: '.map-section',
                        start: 'top 60%',
                        toggleActions: 'play none none reverse'
                    },
                    scale: 1,
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'elastic.out(1, 0.5)',
                    delay: 0.2 + (i * 0.12)
                }
            );
        });

        var mapRevealScroll = {
            id: 'map-presence',
            trigger: '.map-section',
            start: 'top 62%',
            toggleActions: 'play none none reverse',
            invalidateOnRefresh: true
        };

        gsap.fromTo('.map-city-tag',
            { autoAlpha: 0, y: 5 },
            {
                scrollTrigger: mapRevealScroll,
                autoAlpha: 1,
                y: 0,
                duration: 0.4,
                stagger: 0.06,
                delay: 0.38,
                ease: 'power2.out'
            }
        );

        gsap.utils.toArray('.map-presence-svg__path--city').forEach(function (path, index) {
            gsap.fromTo(path,
                { strokeDashoffset: function () { return this.targets()[0].getTotalLength(); } },
                {
                    scrollTrigger: mapRevealScroll,
                    strokeDashoffset: 0,
                    duration: 0.55,
                    delay: 0.42 + index * 0.08,
                    ease: 'power2.out'
                }
            );
        });

        gsap.utils.toArray('.map-presence-svg__path--metric').forEach(function (path, index) {
            gsap.fromTo(path,
                { strokeDashoffset: function () { return this.targets()[0].getTotalLength(); } },
                {
                    scrollTrigger: mapRevealScroll,
                    strokeDashoffset: 0,
                    duration: 0.42,
                    delay: 0.78 + index * 0.1,
                    ease: 'power2.out'
                }
            );
        });

        gsap.to('.map-presence-svg__dot', {
            scrollTrigger: mapRevealScroll,
            opacity: 1,
            duration: 0.35,
            stagger: 0.05,
            delay: 0.55,
            ease: 'power2.out'
        });

        gsap.fromTo('.metric-card',
            { opacity: 0, x: 12 },
            {
                scrollTrigger: mapRevealScroll,
                opacity: 1,
                x: 0,
                duration: 0.5,
                stagger: 0.1,
                delay: 0.82,
                ease: 'power2.out'
            }
        );
    }

    function initPresenceSection() {
        bindPresenceAnimations();

        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            drawPresenceLayout();
            presenceSvg?.querySelectorAll('.map-presence-svg__path').forEach(function (path) {
                path.style.strokeDashoffset = '0';
            });
            presenceSvg?.querySelectorAll('.map-presence-svg__dot').forEach(function (dot) {
                dot.style.opacity = '1';
            });
            document.querySelectorAll('.map-city-tag, .metric-card').forEach(function (el) {
                if (typeof gsap !== 'undefined') {
                    gsap.set(el, { autoAlpha: 1, opacity: 1, x: 0, y: 0 });
                }
            });
            return;
        }

        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                drawPresenceLayout();
                if (typeof ScrollTrigger !== 'undefined') {
                    ScrollTrigger.refresh();
                }
            });
        });
    }

    var presenceResizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(presenceResizeTimer);
        presenceResizeTimer = setTimeout(function () {
            drawPresenceLayout();
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.refresh();
            }
        }, 120);
    });

    initPresenceSection();
}

function initQuienesSomosPage() {
    initHistoriaCarousel();
    initStatCounters();
    initMapSection();
}

document.addEventListener('DOMContentLoaded', initQuienesSomosPage);
