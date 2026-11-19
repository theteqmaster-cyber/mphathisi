<?php
/**
 * Mphathisi Ndlovu — Interactive CV & Portfolio (cv.mphathisi.com)
 * Clean, calm, fast-loading layout backed by updated Nov 2026 CV & Bio.
 */

$messageSent = false;
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'contact') {
    $name = strip_tags(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $message = strip_tags(trim($_POST['message'] ?? ''));

    if (empty($name) || !$email || empty($message)) {
        $errorMessage = 'Please fill in your name, a valid email, and a message.';
    } else {
        $messageSent = true;
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        if ($messageSent) {
            echo json_encode(['status' => 'success', 'message' => 'Message received. Thank you for reaching out!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $errorMessage]);
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mphathisi Ndlovu | Full-Stack Software Engineer — CV</title>
  <meta name="description" content="Interactive CV of Mphathisi Ndlovu — Full-Stack Software Engineer building web apps, Flutter mobile apps, and privacy-first offline systems in Bulawayo, Zimbabwe.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/assets/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- Subtle Background Accent -->
  <div class="bg-grid-overlay" aria-hidden="true"></div>
  <div class="radial-glow glow-left" aria-hidden="true"></div>
  <div class="radial-glow glow-right" aria-hidden="true"></div>

  <!-- 1. Thin Sticky Header -->
  <header class="site-header">
    <div class="header-left">
      <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Navigation">
        <i class="fa-solid fa-bars"></i>
      </button>
      <a href="#overview" class="logo-wrap">
        <div class="logo-icon" aria-hidden="true">M</div>
        <div class="logo-title">Mphathisi Ndlovu</div>
      </a>
    </div>
    <div class="header-right">
      <a href="https://mphathisi.com" class="btn btn-secondary header-portal-link" rel="noopener">
        <i class="fa-solid fa-globe"></i> <span>mphathisi.com</span>
      </a>
      <button class="theme-toggle-btn" id="themeToggleBtn" aria-label="Toggle Light/Dark Theme" title="Switch Theme">
        <i class="fa-solid fa-moon"></i>
      </button>
      <a href="/download" class="btn btn-primary" aria-label="Download CV PDF">
        <i class="fa-solid fa-file-pdf"></i> <span>Download CV</span>
      </a>
    </div>
  </header>

  <!-- 2. Collapsible Side Navigation -->
  <nav class="sidebar-drawer" id="sidebarDrawer" aria-label="CV Navigation">
    <div class="drawer-nav">
      <a href="#overview" class="nav-link active">
        <i class="fa-solid fa-user"></i>
        <span class="nav-link-text">Overview</span>
      </a>
      <a href="#projects" class="nav-link">
        <i class="fa-solid fa-layer-group"></i>
        <span class="nav-link-text">Projects</span>
      </a>
      <a href="#experience" class="nav-link">
        <i class="fa-solid fa-briefcase"></i>
        <span class="nav-link-text">Experience</span>
      </a>
      <a href="#skills" class="nav-link">
        <i class="fa-solid fa-sliders"></i>
        <span class="nav-link-text">Core Stack</span>
      </a>
      <a href="#education" class="nav-link">
        <i class="fa-solid fa-graduation-cap"></i>
        <span class="nav-link-text">Education</span>
      </a>
      <a href="#resources" class="nav-link">
        <i class="fa-solid fa-folder-open"></i>
        <span class="nav-link-text">Documents &amp; Demos</span>
      </a>
      <a href="#contact" class="nav-link">
        <i class="fa-solid fa-envelope"></i>
        <span class="nav-link-text">Contact</span>
      </a>
    </div>

    <div class="drawer-profile">
      <div class="drawer-avatar" aria-hidden="true">MN</div>
      <div class="drawer-profile-details">
        <span class="profile-sig">Mphathisi Ndlovu</span>
        <span class="profile-sub">Full-Stack &amp; Mobile</span>
      </div>
    </div>
  </nav>

  <!-- 3. Scrollable Main Content -->
  <div class="main-wrapper">
    <div class="content-container">

      <!-- SECTION 1: Overview & Bio -->
      <section id="overview" class="panel-card overview-panel">
        <div class="overview-bio">
          <span class="section-tag">Bulawayo, Zimbabwe (UTC+2) • Full-Stack &amp; Mobile</span>
          <h1 class="overview-heading">Calm, dependable software for web, mobile, and offline work.</h1>
          <p class="overview-desc">
            I am a full-stack software engineer and BSc (Hons) Computer Science student at the National University of Science and Technology (NUST). I build web applications, Android &amp; Linux apps, and reliable backend tools—focused on turning messy, high-stakes information into software that feels clear, private, and effortless to use.
          </p>

          <div class="overview-highlights">
            <span class="highlight-chip accent"><i class="fa-solid fa-trophy"></i> BancABC 2026 Hackathon — Top 10</span>
            <span class="highlight-chip"><i class="fa-solid fa-shield-halved"></i> AWS Responsible AI Certified</span>
            <span class="highlight-chip"><i class="fa-solid fa-clock"></i> US Business Hours Evening Overlap</span>
          </div>

          <div class="overview-actions">
            <a href="/download" class="btn btn-primary">
              <i class="fa-solid fa-download"></i> Download Full CV (PDF)
            </a>
            <a href="/assets/Mphathisi_Ndlovu_Professional_Bio.pdf" target="_blank" rel="noopener" class="btn btn-secondary">
              <i class="fa-solid fa-file-lines"></i> Professional Bio (PDF)
            </a>
            <a href="https://github.com/theteqmaster-cyber" target="_blank" rel="noopener" class="btn btn-secondary">
              <i class="fa-brands fa-github"></i> GitHub
            </a>
          </div>
        </div>

        <div class="overview-metrics-grid">
          <div class="metrics-card">
            <div class="metrics-number">Top 10</div>
            <div class="metrics-label">BancABC 2026</div>
          </div>
          <div class="metrics-card">
            <div class="metrics-number">45k+</div>
            <div class="metrics-label">LOC in Zwanane OS</div>
          </div>
          <div class="metrics-card">
            <div class="metrics-number">4+ Yrs</div>
            <div class="metrics-label">Building &amp; IT Support</div>
          </div>
          <div class="metrics-card">
            <div class="metrics-number">UTC+2</div>
            <div class="metrics-label">US Hours Overlap</div>
          </div>
        </div>
      </section>

      <!-- SECTION 2: Selected Projects & Hackathons -->
      <section id="projects" class="panel-card">
        <div class="section-header-block">
          <span class="section-tag">Selected Work &amp; Hackathons</span>
          <h2 class="section-title">Featured Projects</h2>
          <p class="section-lead">End-to-end web apps, mobile builds, and hackathon projects shipped from database design to real-world use.</p>
        </div>

        <div class="projects-grid">

          <!-- 1. CT MedAid -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-prod">HEALTHCARE</span>
              <span class="project-date">May – Sep 2026</span>
            </div>
            <h3 class="proj-name">CT MedAid</h3>
            <p class="project-summary">
              Android app and companion web portal connecting patients, verified doctors, and micro-insurance in one workflow—covering symptom triage, fair pricing estimates, nearby consultations, and doctor license verification.
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">Flutter</span>
              <span class="tech-badge">PHP 8</span>
              <span class="tech-badge">Supabase</span>
              <span class="tech-badge">OpenStreetMap</span>
              <span class="tech-badge">Groq AI</span>
            </div>
          </article>

          <!-- 2. Zwanane OS -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-prod">DAILY PRODUCTION</span>
              <span class="project-date">Sep 2026 – Present</span>
            </div>
            <h3 class="proj-name">Zwanane OS</h3>
            <p class="project-summary">
              My 45,000-line offline-first Android and Linux workspace uniting tasks, Markdown notes, deduplicated files, and personal budgets. Runs daily across devices with local Wi-Fi sync (9,699+ verified syncs) and self-hosted updates.
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">Flutter (Android &amp; Linux)</span>
              <span class="tech-badge">SQLite</span>
              <span class="tech-badge">Local P2P Sync</span>
            </div>
          </article>

          <!-- 3. eyeC -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-award">TOP 10 • BANCABC 2026</span>
              <span class="project-date">Nov 2026</span>
            </div>
            <h3 class="proj-name">eyeC — Banking Decision Cockpit</h3>
            <p class="project-summary">
              100% offline banking analytics tool that cleaned over 1M raw records into 50,000 accurate customer profiles, masked personal data at ingestion, and gave relationship managers clear, explainable risk alerts with strict safety checks.
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">Python</span>
              <span class="tech-badge">FastAPI</span>
              <span class="tech-badge">DuckDB</span>
              <span class="tech-badge">LightGBM</span>
              <span class="tech-badge">SHAP</span>
            </div>
          </article>

          <!-- 4. Zimknows -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-award">ZMC–NUST 2026</span>
              <span class="project-date">Nov 2026</span>
            </div>
            <h3 class="proj-name">Zimknows — Road Safety Platform</h3>
            <p class="project-summary">
              Highway safety platform using the Highway Data Caterpillar approach to relay urgent road alerts through cellular dead zones—connecting drivers, passengers, and local radio newsrooms in English, ChiShona, and IsiNdebele.
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">Next.js</span>
              <span class="tech-badge">TypeScript</span>
              <span class="tech-badge">Offline Relay</span>
              <span class="tech-badge">WhatsApp / USSD</span>
            </div>
            <div class="proj-actions">
              <a href="https://zimknows.vercel.app" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo
              </a>
              <a href="https://mphathisi.com/sources.html" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-folder-open"></i> Slides &amp; Proposal
              </a>
            </div>
          </article>

          <!-- 5. RETURNi & PRUTUS V3 -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-prod">WEB APPS &amp; FINTECH</span>
              <span class="project-date">Mar – Oct 2026</span>
            </div>
            <h3 class="proj-name">RETURNi &amp; PRUTUS V3</h3>
            <p class="project-summary">
              Offline-ready shop point-of-sale, loyalty, and small-business finance platforms featuring role-based portals, QR receipts, dual-currency statements, and credit scoring built to stay responsive on slow mobile connections.
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">Next.js 14</span>
              <span class="tech-badge">TypeScript</span>
              <span class="tech-badge">React</span>
              <span class="tech-badge">IndexedDB</span>
              <span class="tech-badge">Supabase</span>
              <span class="tech-badge">PHP 8</span>
            </div>
            <div class="proj-actions">
              <a href="https://returni-backpay-app.vercel.app/" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> RETURNi Demo
              </a>
            </div>
          </article>

          <!-- 6. UniRoom -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-tool">MARKETPLACE &amp; BOT</span>
              <span class="project-date">Jun – Aug 2026</span>
            </div>
            <h3 class="proj-name">UniRoom</h3>
            <p class="project-summary">
              Student housing marketplace with a landlord portal, admin analytics dashboard, cloud media uploads, and a conversational WhatsApp assistant that helps students search listings and schedule viewings.
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">PHP 8</span>
              <span class="tech-badge">Docker</span>
              <span class="tech-badge">PostgreSQL</span>
              <span class="tech-badge">Cloudflare R2</span>
              <span class="tech-badge">WhatsApp API</span>
            </div>
          </article>

          <!-- 7. Self-Hosted LAN Suite -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-tool">MOBILE + HOME SERVER</span>
              <span class="project-date">Jun – Nov 2026</span>
            </div>
            <h3 class="proj-name">Personal LAN App Suite &amp; Study Assistant</h3>
            <p class="project-summary">
              Four paired Flutter Android apps (MFlix, MShare, MSpot, iLearn) backed by a local network server, automatic device discovery, an offline search assistant for 800+ study documents, and an encrypted local keyboard/mouse tool.
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">Flutter (4 APKs)</span>
              <span class="tech-badge">PHP 8</span>
              <span class="tech-badge">Python</span>
              <span class="tech-badge">SQLite</span>
            </div>
          </article>

          <!-- 8. Robotics & Edge Hardware -->
          <article class="project-card">
            <div class="project-card-top">
              <span class="proj-status-tag status-cli">ROBOTICS &amp; HARDWARE</span>
              <span class="project-date">2026</span>
            </div>
            <h3 class="proj-name">Egrocca Delivery Rover &amp; TracePunch</h3>
            <p class="project-summary">
              Built a rural autonomous delivery rover simulation with low-battery return-to-home and OTP cargo locking (Egrocca / ShopDroid), plus a Raspberry Pi camera and sensor unit for field farm-input tracking (TracePunch).
            </p>
            <div class="proj-tech-badges">
              <span class="tech-badge">ROS 2</span>
              <span class="tech-badge">Gazebo</span>
              <span class="tech-badge">Raspberry Pi</span>
              <span class="tech-badge">OpenCV</span>
              <span class="tech-badge">Python</span>
              <span class="tech-badge">Node-RED</span>
            </div>
          </article>

        </div>
      </section>

      <!-- SECTION 3: Experience -->
      <section id="experience" class="panel-card">
        <div class="section-header-block">
          <span class="section-tag">Background</span>
          <h2 class="section-title">Experience</h2>
        </div>

        <div class="timeline-list">
          <div class="timeline-item">
            <div class="timeline-header">
              <div>
                <h3 class="timeline-role">Independent Full-Stack &amp; Mobile Developer</h3>
                <span class="timeline-org">Bulawayo, Zimbabwe (Remote)</span>
              </div>
              <span class="timeline-period">2024 – Present</span>
            </div>
            <ul class="proj-bullets">
              <li>Designed and shipped web applications, Android mobile apps, and local-first tools across healthcare (CT MedAid, Cimas Healthathon Script-Splitter), finance (PRUTUS, RETURNi, eyeC), marketplaces (UniRoom, Servu), and local client storefronts (PrintM, QPrint).</li>
              <li>Focused consistently on user privacy, reliable offline workflows, clean database design, and maintainable codebases.</li>
            </ul>
          </div>

          <div class="timeline-item">
            <div class="timeline-header">
              <div>
                <h3 class="timeline-role">IT Systems Support &amp; Linux Troubleshooting</h3>
                <span class="timeline-org">Independent</span>
              </div>
              <span class="timeline-period">2022 – 2024</span>
            </div>
            <ul class="proj-bullets">
              <li>Diagnosed hardware, Wi-Fi/LTE connection slowdowns, and Linux desktop/server issues for individuals and small setups.</li>
              <li>Wrote repeatable Bash and Python helper scripts for network diagnostics, automated backups, and service health checks.</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- SECTION 4: Core Stack -->
      <section id="skills" class="panel-card">
        <div class="section-header-block">
          <span class="section-tag">Core Stack</span>
          <h2 class="section-title">Tools &amp; Technologies</h2>
          <p class="section-lead">Practical tools I work with daily to ship clean, dependable software.</p>
        </div>

        <div class="stack-grid">
          <div class="stack-card">
            <h3 class="stack-card-title"><i class="fa-solid fa-globe"></i> Web &amp; Frontend</h3>
            <div class="stack-tags">
              <span class="stack-tag">TypeScript</span>
              <span class="stack-tag">Next.js</span>
              <span class="stack-tag">React</span>
              <span class="stack-tag">Vite</span>
              <span class="stack-tag">Tailwind CSS</span>
              <span class="stack-tag">PWA / Workbox</span>
              <span class="stack-tag">HTML5 &amp; CSS3</span>
            </div>
          </div>

          <div class="stack-card">
            <h3 class="stack-card-title"><i class="fa-solid fa-mobile-screen"></i> Mobile &amp; Desktop</h3>
            <div class="stack-tags">
              <span class="stack-tag">Flutter &amp; Dart</span>
              <span class="stack-tag">Android APKs</span>
              <span class="stack-tag">Linux GTK</span>
              <span class="stack-tag">Offline SQLite</span>
              <span class="stack-tag">IndexedDB (Dexie)</span>
              <span class="stack-tag">PyQt6</span>
            </div>
          </div>

          <div class="stack-card">
            <h3 class="stack-card-title"><i class="fa-solid fa-server"></i> Backend &amp; APIs</h3>
            <div class="stack-tags">
              <span class="stack-tag">Python (FastAPI)</span>
              <span class="stack-tag">DuckDB</span>
              <span class="stack-tag">PHP 8 (REST / PDO)</span>
              <span class="stack-tag">Node.js (Express)</span>
              <span class="stack-tag">WhatsApp Cloud API</span>
            </div>
          </div>

          <div class="stack-card">
            <h3 class="stack-card-title"><i class="fa-solid fa-shield-halved"></i> Data, Privacy &amp; Ops</h3>
            <div class="stack-tags">
              <span class="stack-tag">PostgreSQL (Supabase)</span>
              <span class="stack-tag">Row-Level Security</span>
              <span class="stack-tag">SQLite &amp; MySQL</span>
              <span class="stack-tag">Cloudflare R2</span>
              <span class="stack-tag">Docker</span>
              <span class="stack-tag">Linux &amp; Git</span>
              <span class="stack-tag">PII Masking</span>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 5: Education, Certification & Collaboration -->
      <section id="education" class="panel-card">
        <div class="section-header-block">
          <span class="section-tag">Credentials &amp; Availability</span>
          <h2 class="section-title">Education &amp; Remote Work</h2>
        </div>

        <div class="edu-grid">
          <div class="edu-card">
            <span class="edu-date">2024 – Present</span>
            <h3 class="edu-title">BSc (Hons) in Computer Science — Part 2.2</h3>
            <p class="edu-sub">National University of Science and Technology (NUST), Bulawayo, Zimbabwe</p>
          </div>

          <div class="edu-card">
            <span class="edu-date">June 2026</span>
            <h3 class="edu-title">AWS Training &amp; Certification — Responsible AI Practices</h3>
            <p class="edu-sub">Verified certificate covering privacy, transparency, bias evaluation, and practical AI governance.</p>
          </div>

          <div class="edu-card edu-card-wide">
            <span class="edu-date">Remote Collaboration</span>
            <h3 class="edu-title">Clear English Communication &amp; US Timezone Overlap</h3>
            <p class="edu-sub">
              Based in Bulawayo, Zimbabwe (CAT / UTC+2). Flexible evening hours (18:00–01:00 CAT) overlap directly with US business hours (11:00 AM–6:00 PM EST / 8:00 AM–3:00 PM PST). Open to remote product engineering, part-time roles, and internships around university studies.
            </p>
          </div>
        </div>
      </section>

      <!-- SECTION 6: Documents & Media -->
      <section id="resources" class="panel-card">
        <div class="section-header-block">
          <span class="section-tag">Downloads &amp; Walkthroughs</span>
          <h2 class="section-title">Documents &amp; Demos</h2>
        </div>

        <div class="resource-grid">
          <div class="docs-list">
            <h3 class="sub-heading"><i class="fa-solid fa-file-lines"></i> Ready-to-Share Documents</h3>

            <div class="document-card">
              <div class="document-meta">
                <div class="document-icon"><i class="fa-solid fa-file-pdf"></i></div>
                <div class="document-info">
                  <span class="document-title">Mphathisi Ndlovu — Full CV (PDF)</span>
                  <span class="document-desc">Updated November 2026 edition covering recent builds and hackathons.</span>
                </div>
              </div>
              <a href="/download" class="document-link" aria-label="Download CV PDF"><i class="fa-solid fa-download"></i></a>
            </div>

            <div class="document-card">
              <div class="document-meta">
                <div class="document-icon"><i class="fa-solid fa-user-check"></i></div>
                <div class="document-info">
                  <span class="document-title">Professional Bio (PDF)</span>
                  <span class="document-desc">Short background summary, specialties, and engineering focus.</span>
                </div>
              </div>
              <a href="/assets/Mphathisi_Ndlovu_Professional_Bio.pdf" target="_blank" rel="noopener" class="document-link" aria-label="Open Bio PDF"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>

            <div class="document-card">
              <div class="document-meta">
                <div class="document-icon"><i class="fa-solid fa-file-powerpoint"></i></div>
                <div class="document-info">
                  <span class="document-title">Zimknows Hackathon Slides &amp; Proposal</span>
                  <span class="document-desc">8-slide pitch deck and 15-page specification from ZMC–NUST 2026.</span>
                </div>
              </div>
              <a href="https://mphathisi.com/sources.html" target="_blank" rel="noopener" class="document-link" aria-label="Open Zimknows Sources"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>

            <div class="document-card">
              <div class="document-meta">
                <div class="document-icon"><i class="fa-solid fa-globe"></i></div>
                <div class="document-info">
                  <span class="document-title">Main Portal (mphathisi.com)</span>
                  <span class="document-desc">Personal showcase with live web apps and quick project links.</span>
                </div>
              </div>
              <a href="https://mphathisi.com" target="_blank" rel="noopener" class="document-link" aria-label="Visit mphathisi.com"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>
          </div>

          <div class="media-console-column">
            <h3 class="sub-heading"><i class="fa-solid fa-video"></i> Recorded App Clips</h3>

            <div class="media-display-screen">
              <div class="media-screen-placeholder" id="mediaPlaceholder">
                <i class="fa-solid fa-circle-play"></i>
                <span>Select a clip below to watch</span>
              </div>
              <iframe id="videoPlayerFrame" style="display: none;" allowfullscreen></iframe>
              <video id="videoPlayerTag" style="display: none;" controls preload="none"></video>
            </div>

            <div class="media-playlist">
              <div class="media-playlist-item" data-video-url="videos/sample1.mp4" data-is-local="true">
                <span class="media-item-title-text">Local Workspace Walkthrough</span>
                <span class="media-item-duration-text">04:12</span>
              </div>
              <div class="media-playlist-item" data-video-url="videos/sample2.mp4" data-is-local="true">
                <span class="media-item-title-text">MShare Local File Transfer Demo</span>
                <span class="media-item-duration-text">03:45</span>
              </div>
              <div class="media-playlist-item" data-video-url="videos/sample3.mp4" data-is-local="true">
                <span class="media-item-title-text">Notak Study Notes &amp; Sync Demo</span>
                <span class="media-item-duration-text">05:10</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 7: Direct Contact -->
      <section id="contact" class="panel-card">
        <div class="section-header-block">
          <span class="section-tag">Get in Touch</span>
          <h2 class="section-title">Contact</h2>
          <p class="section-lead">Send a quick note or reach me directly by email, phone, or GitHub.</p>
        </div>

        <div class="contact-section-row">
          <div class="form-side">
            <form id="corpContactForm" method="POST">
              <div class="form-input-row">
                <div class="form-field-group">
                  <label class="form-field-label" for="c_name">Your Name</label>
                  <input type="text" class="form-field-input" id="c_name" required placeholder="Jane Doe">
                </div>
                <div class="form-field-group">
                  <label class="form-field-label" for="c_email">Your Email</label>
                  <input type="email" class="form-field-input" id="c_email" required placeholder="you@example.com">
                </div>
              </div>
              <div class="form-field-group">
                <label class="form-field-label" for="c_message">Message</label>
                <textarea class="form-field-textarea" id="c_message" required placeholder="Tell me about the role or project..."></textarea>
              </div>
              <div class="form-footer-row">
                <button type="submit" class="btn btn-primary form-submit-btn">
                  <i class="fa-solid fa-paper-plane"></i> Send Message
                </button>
                <span class="form-status-msg" id="formStatusMsg" role="status" aria-live="polite"></span>
              </div>
            </form>
          </div>

          <div class="direct-contact-side">
            <div class="direct-contact-item">
              <i class="fa-solid fa-envelope"></i>
              <div>
                <span class="direct-label">Official Email</span>
                <a href="mailto:dev@mphathisi.com">dev@mphathisi.com</a>
              </div>
            </div>
            <div class="direct-contact-item">
              <i class="fa-solid fa-at"></i>
              <div>
                <span class="direct-label">Direct Email</span>
                <a href="mailto:ndlovumphathisi23@gmail.com">ndlovumphathisi23@gmail.com</a>
              </div>
            </div>
            <div class="direct-contact-item">
              <i class="fa-solid fa-phone"></i>
              <div>
                <span class="direct-label">Phone / WhatsApp</span>
                <span>+263 787 146 103</span>
              </div>
            </div>
            <div class="direct-contact-item">
              <i class="fa-brands fa-github"></i>
              <div>
                <span class="direct-label">GitHub</span>
                <a href="https://github.com/theteqmaster-cyber" target="_blank" rel="noopener">github.com/theteqmaster-cyber</a>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>

    <!-- 4. Clean Footer -->
    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-left">
          <span class="footer-brand-title">Mphathisi Ndlovu</span>
          <p class="footer-brand-desc">
            Full-stack web and mobile developer at NUST Zimbabwe, building clear, reliable, privacy-first software.
          </p>
          <div class="footer-badge">
            <a href="https://websitelaunches.com/site/mphathisi.com" target="_blank" rel="noopener">
              <img
                src="https://websitelaunches.com/badge/mphathisi.com.svg?theme=dark"
                alt="Established online - Public launch record"
                width="220"
                height="48"
                loading="lazy"
              >
            </a>
          </div>
        </div>
        <div class="footer-right">
          <ul class="footer-contacts-list">
            <li>
              <i class="fa-solid fa-phone"></i>
              <span>+263 787 146 103</span>
            </li>
            <li>
              <i class="fa-solid fa-envelope"></i>
              <a href="mailto:dev@mphathisi.com">dev@mphathisi.com</a>
            </li>
            <li>
              <i class="fa-solid fa-location-dot"></i>
              <span>Bulawayo, Zimbabwe (UTC+2)</span>
            </li>
            <li>
              <i class="fa-brands fa-github"></i>
              <a href="https://github.com/theteqmaster-cyber" target="_blank" rel="noopener">github.com/theteqmaster-cyber</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2026 Mphathisi Ndlovu. All rights reserved.</p>
        <p><a href="https://mphathisi.com" class="footer-back-link">mphathisi.com</a></p>
      </div>
    </footer>
  </div>

  <script src="/assets/js/app.js" defer></script>

</body>
</html>
