/**
 * Corporate Scrolling Dashboard Controller
 * Manages responsive collapsible side drawer, scroll spy indicators,
 * IntersectionObserver lazy skill-bar animations, spotlight, and API forms.
 */

document.addEventListener('DOMContentLoaded', () => {
    // -------------------------------------------------------------------------
    // 1. Mouse Spotlight Canvas Glow
    // -------------------------------------------------------------------------
    const canvas = document.getElementById('spotlightCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width = (canvas.width = window.innerWidth);
        let height = (canvas.height = window.innerHeight);
        let mouse = { x: width / 2, y: height / 2, targetX: width / 2, targetY: height / 2 };

        window.addEventListener('mousemove', (e) => {
            mouse.targetX = e.clientX;
            mouse.targetY = e.clientY;
        });

        const drawSpotlight = () => {
            ctx.clearRect(0, 0, width, height);
            mouse.x += (mouse.targetX - mouse.x) * 0.1;
            mouse.y += (mouse.targetY - mouse.y) * 0.1;

            const gradient = ctx.createRadialGradient(mouse.x, mouse.y, 10, mouse.x, mouse.y, 400);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.04)');
            gradient.addColorStop(0.5, 'rgba(13, 148, 136, 0.015)');
            gradient.addColorStop(1, 'transparent');

            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, width, height);
            requestAnimationFrame(drawSpotlight);
        };
        drawSpotlight();

        window.addEventListener('resize', () => {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        });
    }

    // -------------------------------------------------------------------------
    // 2. Collapsible Sidebar Drawer Logic (Mobile & Desktop)
    // -------------------------------------------------------------------------
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sidebarDrawer = document.getElementById('sidebarDrawer');
    const body = document.body;

    const toggleSidebar = () => {
        if (window.innerWidth >= 1024) {
            // Desktop: collapse to slim icon bar
            sidebarDrawer.classList.toggle('collapsed');
            body.classList.toggle('body-collapsed');
        } else {
            // Mobile: slide drawer in/out
            sidebarDrawer.classList.toggle('drawer-open');
        }
    };

    if (hamburgerBtn && sidebarDrawer) {
        hamburgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });

        // Close mobile drawer when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                if (!sidebarDrawer.contains(e.target) && !hamburgerBtn.contains(e.target)) {
                    sidebarDrawer.classList.remove('drawer-open');
                }
            }
        });

        // Close mobile drawer after selecting a link
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    sidebarDrawer.classList.remove('drawer-open');
                }
            });
        });
    }

    // -------------------------------------------------------------------------
    // 3. Scroll-Spy: Highlight Active Sidebar Link
    // -------------------------------------------------------------------------
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    const scrollSpy = () => {
        const scrollPosition = window.scrollY + 100; // offset for sticky header

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    };

    window.addEventListener('scroll', scrollSpy);

    // -------------------------------------------------------------------------
    // 4. Lazy-Load Skill Progress Bars (Intersection Observer)
    // -------------------------------------------------------------------------
    const skillsSection = document.getElementById('skills');
    const skillFills = document.querySelectorAll('.skill-inner-bar');

    if (skillsSection && skillFills.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.2
        };

        const animateSkills = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    skillFills.forEach(fill => {
                        const level = fill.getAttribute('data-level');
                        fill.style.width = level;
                    });
                    observer.unobserve(entry.target); // Trigger animation once
                }
            });
        };

        const skillsObserver = new IntersectionObserver(animateSkills, observerOptions);
        skillsObserver.observe(skillsSection);
    }

    // -------------------------------------------------------------------------
    // 5. System Logs Feed (Overview logs)
    // -------------------------------------------------------------------------
    const logsConsole = document.getElementById('logsConsoleBox');
    const addSystemLog = (msg, status = 'sys') => {
        if (!logsConsole) return;
        const now = new Date();
        const timeStr = now.toTimeString().split(' ')[0];

        const logLine = document.createElement('div');
        logLine.className = 'log-row';
        const statusTag = status.toUpperCase();

        logLine.innerHTML = `<span class="log-timestamp">[${timeStr}]</span> <span class="log-status ${status}">[${statusTag}]</span> <span class="log-message">${msg}</span>`;
        logsConsole.insertBefore(logLine, logsConsole.firstChild);

        if (logsConsole.children.length > 30) {
            logsConsole.removeChild(logsConsole.lastChild);
        }
    };

    const logsLibrary = [
        { msg: "Supabase DB sync verified. Connections: stable (15ms latency).", status: "sys" },
        { msg: "Checked remote server nodes. Memory allocation normal.", status: "sys" },
        { msg: "Vulnerability audit trace run: 0 passive security issues identified.", status: "sec" },
        { msg: "Backup job complete: mirrored academic archives to cloud store.", status: "sys" },
        { msg: "Cleaned cache tables. System latency reduced by 12%.", status: "sys" },
        { msg: "Token validation complete: isolation boundaries secured.", status: "sec" }
    ];

    setInterval(() => {
        const rand = logsLibrary[Math.floor(Math.random() * logsLibrary.length)];
        addSystemLog(rand.msg, rand.status);
    }, 11000);

    setTimeout(() => addSystemLog("System initialized. Corporate dashboard engine loaded.", "sys"), 400);
    setTimeout(() => addSystemLog("Security credentials verified. Access tokens loaded.", "sec"), 900);
    setTimeout(() => addSystemLog("Database clusters active: PostgreSQL and Supabase synchronized.", "sys"), 1400);

    // -------------------------------------------------------------------------
    // 6. Resource Space Video Logs Loader
    // -------------------------------------------------------------------------
    const mediaPlaylistItems = document.querySelectorAll('.media-playlist-item');
    const videoPlayerFrame = document.getElementById('videoPlayerFrame');
    const videoPlayerTag = document.getElementById('videoPlayerTag');
    const mediaPlaceholder = document.getElementById('mediaPlaceholder');

    mediaPlaylistItems.forEach(item => {
        item.addEventListener('click', () => {
            const url = item.getAttribute('data-video-url');
            const isLocal = item.getAttribute('data-is-local') === 'true';

            mediaPlaylistItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            if (mediaPlaceholder) mediaPlaceholder.style.display = 'none';

            if (isLocal) {
                if (videoPlayerFrame) videoPlayerFrame.style.display = 'none';
                if (videoPlayerTag) {
                    videoPlayerTag.style.display = 'block';
                    videoPlayerTag.src = url;
                    videoPlayerTag.play();
                }
            } else {
                if (videoPlayerTag) {
                    videoPlayerTag.pause();
                    videoPlayerTag.style.display = 'none';
                }
                if (videoPlayerFrame) {
                    videoPlayerFrame.style.display = 'block';
                    videoPlayerFrame.src = url;
                }
            }

            addSystemLog(`Streaming document demonstration: [${item.querySelector('.media-item-title-text').textContent}]`, 'sys');
        });
    });

    // -------------------------------------------------------------------------
    // 7. Corporate Contact Form Submission Logger
    // -------------------------------------------------------------------------
    const contactForm = document.getElementById('corpContactForm');
    const transFeed = document.getElementById('transLogView');

    const addTransLog = (msg, state = 'info') => {
        if (!transFeed) return;
        const row = document.createElement('div');
        row.className = 'api-log-row';

        let stateMsgClass = '';
        if (state === 'ok') stateMsgClass = 'api-log-success';
        if (state === 'err') stateMsgClass = 'api-log-error';

        row.innerHTML = `<span class="api-log-tag">[API]</span> <span class="${stateMsgClass}">${msg}</span>`;
        transFeed.appendChild(row);
        transFeed.scrollTop = transFeed.scrollHeight;
    };

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const name = document.getElementById('c_name').value;
            const email = document.getElementById('c_email').value;
            const msg = document.getElementById('c_message').value;

            if (!name || !email || !msg) {
                addTransLog("Error: Validation parameters failed. All fields required.", 'err');
                return;
            }

            transFeed.innerHTML = '';
            addTransLog("Processing request payload headers...");

            setTimeout(() => {
                addTransLog("Validating request body data integrity...");
            }, 500);

            setTimeout(() => {
                addTransLog("Sending API POST request over TLS/HTTPS...");
            }, 1000);

            setTimeout(() => {
                const formData = new FormData();
                formData.append('action', 'contact');
                formData.append('name', name);
                formData.append('email', email);
                formData.append('message', msg);

                fetch('/api/index.php', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        addTransLog("API Connection established successfully.", 'ok');
                        addTransLog("Server response: 200 OK. Transaction logged.", 'ok');
                        addSystemLog(`Contact submission received from: ${name} (${email})`, 'sec');
                        contactForm.reset();
                    } else {
                        addTransLog(`API Error: ${data.message}`, 'err');
                    }
                })
                .catch(err => {
                    addTransLog("Error: Destination host unreachable or request timeout.", 'err');
                    addTransLog(err.toString(), 'err');
                });
            }, 1500);
        });
    }

    // -------------------------------------------------------------------------
    // 8. Executive Project Showcase Slideshow
    // -------------------------------------------------------------------------
    const slides = document.querySelectorAll('.showcase-slide');
    const dots = document.querySelectorAll('.slide-dot');
    let currentSlide = 0;
    let slideInterval = null;

    const showSlide = (index) => {
        if (index === currentSlide) return;

        slides.forEach((slide) => {
            if (slide.classList.contains('active')) {
                slide.classList.remove('active');
                slide.classList.add('exit-left');
                // Clean up transition class after animation completes
                setTimeout(() => {
                    slide.classList.remove('exit-left');
                }, 800);
            } else {
                slide.classList.remove('exit-left');
            }
        });

        dots.forEach(dot => dot.classList.remove('active'));

        slides[index].classList.add('active');
        dots[index].classList.add('active');
        currentSlide = index;
    };

    const nextSlide = () => {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
    };

    const startSlideShow = () => {
        stopSlideShow();
        slideInterval = setInterval(nextSlide, 2800); // Transition every 2.8 seconds
    };

    const stopSlideShow = () => {
        if (slideInterval) clearInterval(slideInterval);
    };

    if (slides.length > 0 && dots.length > 0) {
        // Dot clicks
        dots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                showSlide(idx);
                startSlideShow(); // reset interval on manual select
            });
        });

        // Pause slideshow on hover
        const sliderContainer = document.getElementById('showcaseSlider');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', stopSlideShow);
            sliderContainer.addEventListener('mouseleave', startSlideShow);
        }

        startSlideShow();
    }

    // -------------------------------------------------------------------------
    // 9. Light/Dark Theme Toggle
    // -------------------------------------------------------------------------
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = themeToggleBtn ? themeToggleBtn.querySelector('i') : null;

    // Check saved local storage preference
    const savedTheme = localStorage.getItem('site-theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
        if (themeIcon) {
            themeIcon.className = 'fa-solid fa-sun';
        }
    } else {
        // Default is light theme (no class needed)
        document.body.classList.remove('dark-theme');
        if (themeIcon) {
            themeIcon.className = 'fa-solid fa-moon';
        }
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme');
            const isDark = document.body.classList.contains('dark-theme');
            localStorage.setItem('site-theme', isDark ? 'dark' : 'light');

            if (themeIcon) {
                themeIcon.className = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
            }

            addSystemLog(`Theme toggled to: ${isDark ? 'Dark Mode' : 'Light Mode'}`, 'sys');
        });
    }
});
