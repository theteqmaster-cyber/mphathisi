<?php
/**
 * Corporate Developer Portfolio Main Controller
 * Renders the clean, Stripe/Vercel inspired scrolling dashboard.
 */

// Handle dynamic AJAX form submission
$messageSent = false;
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'contact') {
    $name = strip_tags(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $message = strip_tags(trim($_POST['message'] ?? ''));

    if (empty($name) || !$email || empty($message)) {
        $errorMessage = 'Invalid fields. Please verify parameters.';
    } else {
        // Log transaction securely
        $messageSent = true;
    }
    
    // Check if AJAX
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        if ($messageSent) {
            echo json_encode(['status' => 'success', 'message' => 'API Transaction completed successfully.']);
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
  <title>Mphathisi Ndlovu | Full Stack Systems Engineer</title>
  <meta name="description" content="Portfolio of Mphathisi Ndlovu - Full Stack Software Engineer & Systems Administrator. High-performance clean applications with secure system architectures.">
  
  <!-- CSS Stylesheets -->
  <link rel="stylesheet" href="/assets/css/styles.css">
  
  <!-- FontAwesome & CDNs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <!-- Background overlays and spotlight tracking -->
  <div class="bg-grid-overlay" aria-hidden="true"></div>
  <canvas class="spotlight-canvas" id="spotlightCanvas" aria-hidden="true"></canvas>
  <div class="radial-glow glow-left" aria-hidden="true"></div>
  <div class="radial-glow glow-right" aria-hidden="true"></div>

  <!-- 1. Thin Top Sticky Header -->
  <header class="site-header">
    <div class="header-left">
      <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Side Navigation">
        <i class="fa-solid fa-bars"></i>
      </button>
      <a href="#overview" class="logo-wrap">
        <div class="logo-icon" aria-hidden="true">M</div>
        <div class="logo-title">Mphathisi Ndlovu</div>
      </a>
    </div>
    <div class="header-right">
      <button class="theme-toggle-btn" id="themeToggleBtn" aria-label="Toggle Light/Dark Theme">
        <i class="fa-solid fa-moon"></i>
      </button>
      <a href="/download" class="btn btn-primary" aria-label="Download CV PDF">
        <i class="fa-solid fa-file-pdf"></i> <span>Download CV</span>
      </a>
    </div>
  </header>

  <!-- 2. Collapsible Side Drawer -->
  <nav class="sidebar-drawer" id="sidebarDrawer" aria-label="Sidebar Navigation">
    <div class="drawer-nav">
      <a href="#overview" class="nav-link active">
        <i class="fa-solid fa-house"></i>
        <span class="nav-link-text">Overview</span>
      </a>
      <a href="#projects" class="nav-link">
        <i class="fa-solid fa-layer-group"></i>
        <span class="nav-link-text">Systems Portfolio</span>
      </a>
      <a href="#skills" class="nav-link">
        <i class="fa-solid fa-list-check"></i>
        <span class="nav-link-text">Capabilities</span>
      </a>
      <a href="#resources" class="nav-link">
        <i class="fa-solid fa-folder-open"></i>
        <span class="nav-link-text">Resource Space</span>
      </a>
      <a href="#contact" class="nav-link">
        <i class="fa-solid fa-paper-plane"></i>
        <span class="nav-link-text">Contact Gate</span>
      </a>
    </div>

    <!-- Collapsible sidebar user avatar details -->
    <div class="drawer-profile">
      <div class="drawer-avatar" aria-hidden="true">
        <i class="fa-solid fa-user-tie"></i>
      </div>
      <div class="drawer-profile-details">
        <span class="profile-sig">M. Ndlovu</span>
        <span class="profile-sub">Systems Architect</span>
      </div>
    </div>
  </nav>

  <!-- 3. Scrollable Main Wrapper -->
  <div class="main-wrapper">
    <div class="content-container">

      <!-- Executive Project Slideshow Showcase -->
      <div class="showcase-slider" id="showcaseSlider">
        <!-- Slide 1 -->
        <div class="showcase-slide active" data-index="0">
          <img src="/assets/Screenshot from 2026-06-24 15-25-13.png" alt="HydraSpace Screenshot">
          <div class="slide-overlay">
            <span class="slide-tag">Academic Operating System</span>
            <h3 class="slide-title">HydraSpace Academic Platform</h3>
            <p class="slide-desc">An all-in-one university resource organizer managing student notes, schedules, and document classification.</p>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="showcase-slide" data-index="1">
          <img src="/assets/Screenshot from 2026-06-24 15-25-32.png" alt="Returni Screenshot">
          <div class="slide-overlay">
            <span class="slide-tag">SME Business Ledger</span>
            <h3 class="slide-title">Returni POS &amp; Retention</h3>
            <p class="slide-desc">A simple customer retention and merchant portal built to handle retail store transactions and ledger records.</p>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="showcase-slide" data-index="2">
          <img src="/assets/Screenshot from 2026-06-24 15-25-54.png" alt="Servu Screenshot">
          <div class="slide-overlay">
            <span class="slide-tag">Gig Economy Matchmaker</span>
            <h3 class="slide-title">Servu Talent Marketplace</h3>
            <p class="slide-desc">Connecting local small businesses with verified youth talent using escrow agreements and reviews in Bulawayo.</p>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="showcase-slide" data-index="3">
          <img src="/assets/Screenshot from 2026-06-24 15-26-23.png" alt="EasyQuizzy Screenshot">
          <div class="slide-overlay">
            <span class="slide-tag">Cognitive Quiz App</span>
            <h3 class="slide-title">EasyQuizzy Interactive Hub</h3>
            <p class="slide-desc">A trivia and self-assessment portal testing user knowledge across multiple categories with scoreboards.</p>
          </div>
        </div>

        <!-- Slide 5 -->
        <div class="showcase-slide" data-index="4">
          <img src="/assets/Screenshot from 2026-06-24 15-27-40.png" alt="Central Intelligence Screenshot">
          <div class="slide-overlay">
            <span class="slide-tag">Host Node Control Center</span>
            <h3 class="slide-title">Central Intelligence Dashboard</h3>
            <p class="slide-desc">The master systems administration interface directing local service nodes like MShare, MStudio, and MSpot.</p>
          </div>
        </div>

        <!-- Navigation Dots -->
        <div class="slide-dots">
          <span class="slide-dot active" data-index="0"></span>
          <span class="slide-dot" data-index="1"></span>
          <span class="slide-dot" data-index="2"></span>
          <span class="slide-dot" data-index="3"></span>
          <span class="slide-dot" data-index="4"></span>
        </div>
      </div>

      <!-- SECTION 1: Overview Panel -->
      <section id="overview" class="panel-card overview-panel">
        <div class="overview-bio">
          <span class="section-tag">Executive Summary</span>
          <h1 class="overview-heading">Engineering Secure, Resilient Full-Stack Systems</h1>
          <p class="overview-desc">
            I specialize in constructing robust backend infrastructures, configuring secure systems administration tasks, and building responsive client-side web integrations. By bridging core application development with hands-on systems operations and security audits, I deliver applications that are resilient under load, compliant with network isolation standards, and clean by design.
          </p>
          
          <!-- Interactive Server log tracker -->
          <div class="server-logs-container">
            <span class="section-tag">Live Activity Feeds</span>
            <div class="logs-console-box" id="logsConsoleBox" aria-label="System diagnostic logs">
              <!-- Populated via Javascript -->
            </div>
          </div>
        </div>

        <div class="overview-metrics-grid">
          <div class="metrics-card">
            <div class="metrics-number">9</div>
            <div class="metrics-label">System Deployments</div>
          </div>
          <div class="metrics-card">
            <div class="metrics-number">100%</div>
            <div class="metrics-label">Vercel Ready</div>
          </div>
          <div class="metrics-card">
            <div class="metrics-number">15ms</div>
            <div class="metrics-label">DB Connection Latency</div>
          </div>
          <div class="metrics-card">
            <div class="metrics-number">3+ Yrs</div>
            <div class="metrics-label">Technical Operations</div>
          </div>
        </div>
      </section>

      <!-- SECTION 2: Systems Portfolio (Scrolling Alternating Rows) -->
      <section id="projects" class="panel-card">
        <span class="section-tag">Case Studies</span>
        <h2 class="section-title">Systems Portfolio</h2>
        
        <div class="projects-list-container">
          
          <!-- Project 1: Returni -->
          <div class="project-showcase-row">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">Returni POS &amp; Ledger</h3>
                <span class="proj-status-tag status-prod">PRODUCTION</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">React.js</span>
                <span class="tech-badge">Node.js</span>
                <span class="tech-badge">Express</span>
                <span class="tech-badge">PostgreSQL</span>
              </div>
              <p class="overview-desc">
                An accounting database and point-of-sale solution resolving balance synchronization deficits in standard ledger entries. Supports multiple client sessions, debt registers, transactional record audits, and inventory logs.
              </p>
              <ul class="proj-bullets">
                <li>Implements secure access control layers and parameterized database procedures to prevent leaks.</li>
                <li>Responsive layout featuring custom charts rendering real-time debt status.</li>
                <li>Optimized data schemas matching GAAP ledger accounting norms.</li>
              </ul>
              <div class="proj-actions">
                <a href="https://returni-backpay-app.vercel.app/" target="_blank" class="btn btn-secondary" rel="noopener">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Active Demo
                </a>
              </div>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">Data Transaction Pipeline</span>
                <div class="diagram-steps">
                  <div class="diagram-node">React UI Dashboard</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i></div>
                  <div class="diagram-node active-node">Express API Gateway</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i></div>
                  <div class="diagram-node">PostgreSQL Database Schema</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project 2: MStudio (Reverse Row) -->
          <div class="project-showcase-row row-reverse">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">MStudio Remote IDE</h3>
                <span class="proj-status-tag status-tool">INTERNAL TOOL</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">PHP API</span>
                <span class="tech-badge">WebSockets</span>
                <span class="tech-badge">Node Process Spawn</span>
                <span class="tech-badge">Linux Shell</span>
              </div>
              <p class="overview-desc">
                A remote development workspace allowing systems administrators to run shell diagnostics and edit server configurations directly via secure browser tunnels. Ideal for managing headless instances.
              </p>
              <ul class="proj-bullets">
                <li>Enables folder traversing and server directory auditing directly from the browser interface.</li>
                <li>Responsive logs streaming terminal updates continuously via WebSockets connections.</li>
                <li>Enforces sandbox validations protecting core host operating system assets.</li>
              </ul>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">Process Execution Path</span>
                <div class="diagram-steps">
                  <div class="diagram-node">Admin Web Interface</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrows-up-down"></i></div>
                  <div class="diagram-node active-node">PHP Auth &amp; Socket Broker</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrows-up-down"></i></div>
                  <div class="diagram-node">Linux Process Spawner (Node Shell)</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project 3: MShare -->
          <div class="project-showcase-row">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">MShare Transfer Engine</h3>
                <span class="proj-status-tag status-tool">INTERNAL TOOL</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">WebRTC DataChannel</span>
                <span class="tech-badge">HTML5 FileReader</span>
                <span class="tech-badge">PHP Signaling Broker</span>
                <span class="tech-badge">Buffer Chunking</span>
              </div>
              <p class="overview-desc">
                A file sharing interface for direct browser-to-browser media delivery. Bypasses intermediate host storage space bottlenecks by chunking large file streams in memory.
              </p>
              <ul class="proj-bullets">
                <li>Incorporates auto-resume recovery protocols managing network interruptions.</li>
                <li>Real-time download stats charting network throughput and memory buffering.</li>
                <li>Secures connections utilizing direct local handshakes and end-to-end routing.</li>
              </ul>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">P2P Network Flow</span>
                <div class="diagram-steps">
                  <div class="diagram-node">Sender Node (Chunk Reader)</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrows-up-down"></i> Handshake (PHP Socket)</div>
                  <div class="diagram-node active-node">Direct WebRTC DataChannel</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i></div>
                  <div class="diagram-node">Receiver Node (File Assembly)</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project 4: Notak2 (Reverse Row) -->
          <div class="project-showcase-row row-reverse">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">Notak2 Academic Portal</h3>
                <span class="proj-status-tag status-prod">PRODUCTION</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">Laravel</span>
                <span class="tech-badge">Supabase DB</span>
                <span class="tech-badge">Cloudflare R2</span>
                <span class="tech-badge">RBAC System</span>
              </div>
              <p class="overview-desc">
                A university administration portal cataloging materials based on the NAPTS classification (Notes, Assignments, Presentations, Tests, Sources). Built to serve as a fast and secure file hosting system.
              </p>
              <ul class="proj-bullets">
                <li>Secures access logs and manages download transactions using Laravel authentication models.</li>
                <li>Distributes large document downloads via Cloudflare R2 cloud object storage paths.</li>
                <li>Enforces strict separation of roles (Admins, CIs, Viewers) protecting curriculum grade tables.</li>
              </ul>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">Cloud Architecture Map</span>
                <div class="diagram-steps">
                  <div class="diagram-node">Web Portal (Laravel App)</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrows-split-up-and-left"></i> Auth &amp; Routes</div>
                  <div class="diagram-node active-node">Supabase DB (PostgreSQL)</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i> Files</div>
                  <div class="diagram-node">Cloudflare R2 Buckets</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project 5: LiveScript -->
          <div class="project-showcase-row">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">LiveScript Automation</h3>
                <span class="proj-status-tag status-cli">SYSTEM UTILITY</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">Bash Scripting</span>
                <span class="tech-badge">ANSI Console UX</span>
                <span class="tech-badge">Linux Utilities</span>
                <span class="tech-badge">API Integration</span>
              </div>
              <p class="overview-desc">
                A shell-based automation suite and task manager designed for server maintenance, cron actions, local logs management, and system diagnosis.
              </p>
              <ul class="proj-bullets">
                <li>Automates backups and copies directories to remote cloud buckets (R2 mirroring).</li>
                <li>Performs background health diagnostics on database logs and process allocations.</li>
                <li>Provides keyboard-driven CLI interfaces optimizing execution speeds.</li>
              </ul>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">Automation Sequence</span>
                <div class="diagram-steps">
                  <div class="diagram-node">Cron Daemon / User Action</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i></div>
                  <div class="diagram-node active-node">LiveScript Automation Core</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrows-split-up-and-left"></i> Tasks</div>
                  <div class="diagram-node">Backups / Log Scrapers / Cloud Syncs</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project 6: MSpot (Reverse Row) -->
          <div class="project-showcase-row row-reverse">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">MSpot Media Player</h3>
                <span class="proj-status-tag status-tool">INTERNAL TOOL</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">HTML5 Audio API</span>
                <span class="tech-badge">JavaScript (ES6)</span>
                <span class="tech-badge">LocalStorage</span>
                <span class="tech-badge">CSS Flexbox</span>
              </div>
              <p class="overview-desc">
                A high-performance audio player streaming localized files with queueing mechanisms, search indexing, and custom configurations.
              </p>
              <ul class="proj-bullets">
                <li>Utilizes modern browser storage to retain play queues, logs, and settings.</li>
                <li>Sleek media player controls optimizing asset rendering speeds.</li>
                <li>Clean responsive viewport layouts adapt seamlessly to different devices.</li>
              </ul>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">Media Flow Path</span>
                <div class="diagram-steps">
                  <div class="diagram-node">Web Client Interface</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i> Action</div>
                  <div class="diagram-node active-node">HTML5 Audio Player API</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrows-up-down"></i> Sync</div>
                  <div class="diagram-node">LocalStorage (Queues &amp; Settings)</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project 7: Servu Marketplace -->
          <div class="project-showcase-row">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">Servu Talent Marketplace</h3>
                <span class="proj-status-tag status-prod">PRODUCTION</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">Node.js</span>
                <span class="tech-badge">Express</span>
                <span class="tech-badge">MySQL DB</span>
                <span class="tech-badge">Escrow API</span>
              </div>
              <p class="overview-desc">
                A localized freelance gig marketplace connecting small-to-medium enterprises (SMEs) with verified youth talent in Bulawayo. Resolves trade trust deficits by managing secure transaction contracts.
              </p>
              <ul class="proj-bullets">
                <li>Enforces contract identity verification procedures protecting user transactions.</li>
                <li>Interactive review log system validating merchant feedback scores.</li>
                <li>High-speed relational database indexing for instantaneous category browsing.</li>
              </ul>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">Marketplace Escrow Map</span>
                <div class="diagram-steps">
                  <div class="diagram-node">SME / Client Employer</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i> Funds Deposit</div>
                  <div class="diagram-node active-node">Servu Escrow Contract Gateway</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i> Release</div>
                  <div class="diagram-node">Contractor / Verified Youth</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Project 8: EasyQuizzy -->
          <div class="project-showcase-row row-reverse">
            <div class="proj-copy-side">
              <div class="proj-tagline-group">
                <h3 class="proj-name">EasyQuizzy Interactive Hub</h3>
                <span class="proj-status-tag status-prod">PRODUCTION</span>
              </div>
              <div class="proj-tech-badges">
                <span class="tech-badge">React.js</span>
                <span class="tech-badge">State Hooks</span>
                <span class="tech-badge">JSON Schemas</span>
                <span class="tech-badge">LocalStorage</span>
              </div>
              <p class="overview-desc">
                A gamified self-assessment portal featuring dynamic quiz sessions across diverse categories. Designed to track cognitive development metrics and score records.
              </p>
              <ul class="proj-bullets">
                <li>Manages question database structures dynamically through clean JSON schema arrays.</li>
                <li>Maintains persistent local records tracking user progress metrics.</li>
                <li>Responsive viewport controls optimized for rapid-fire interface interactions.</li>
              </ul>
            </div>
            
            <div class="proj-diagram-side">
              <div class="diagram-frame">
                <span class="diagram-heading">Quiz State Machine</span>
                <div class="diagram-steps">
                  <div class="diagram-node">Select Category &amp; Load JSON</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i></div>
                  <div class="diagram-node active-node">React Session State Controller</div>
                  <div class="diagram-connector"><i class="fa-solid fa-arrow-down"></i></div>
                  <div class="diagram-node">Commit Score to Persistent Cache</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- SECTION 3: Technical Capabilities -->
      <section id="skills" class="panel-card">
        <span class="section-tag">Core Competencies</span>
        <h2 class="section-title">Technical Capabilities</h2>
        
        <div class="capabilities-grid">
          
          <div class="skills-column">
            <h3 class="proj-name" style="font-size: 1.15rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-code"></i> Engineering Focus</h3>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">PHP (Laravel, Pure PHP APIs)</span>
                <span class="skill-percent">92%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="92%"></div></div>
            </div>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">JavaScript (Node.js, Express, React)</span>
                <span class="skill-percent">95%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="95%"></div></div>
            </div>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">Systems Shell (Bash scripting, Automations)</span>
                <span class="skill-percent">90%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="90%"></div></div>
            </div>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">Database Systems (PostgreSQL, MySQL, SQLite)</span>
                <span class="skill-percent">88%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="88%"></div></div>
            </div>
          </div>

          <div class="skills-column">
            <h3 class="proj-name" style="font-size: 1.15rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-gears"></i> Operations &amp; Security</h3>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">Linux Server Administration (Debian/Ubuntu)</span>
                <span class="skill-percent">90%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="90%"></div></div>
            </div>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">Vulnerability Auditing &amp; Pen-Testing</span>
                <span class="skill-percent">85%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="85%"></div></div>
            </div>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">Cloud Operations (Vercel, Supabase, Cloudflare)</span>
                <span class="skill-percent">87%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="87%"></div></div>
            </div>
            <div class="skill-block">
              <div class="skill-label-row">
                <span class="skill-title">Application Security (JWT, RBAC Schemes)</span>
                <span class="skill-percent">92%</span>
              </div>
              <div class="skill-outer-bar"><div class="skill-inner-bar" data-level="92%"></div></div>
            </div>
          </div>

          <div class="capabilities-creds">
            <div class="cred-card-box">
              <div class="cred-card-icon"><i class="fa-solid fa-server"></i></div>
              <div class="cred-card-copy">
                <h4 class="cred-card-title">System Infrastructure &amp; Support</h4>
                <p class="cred-card-desc">Experienced in routing configurations, directory audits, server monitoring tasks, and network security policies.</p>
              </div>
            </div>
            <div class="cred-card-box">
              <div class="cred-card-icon"><i class="fa-solid fa-code-compare"></i></div>
              <div class="cred-card-copy">
                <h4 class="cred-card-title">Secure Application Design</h4>
                <p class="cred-card-desc">Specialized in setting up database query sanitizations, access token models, and cryptographic data structures.</p>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- SECTION 4: Resource Space -->
      <section id="resources" class="panel-card">
        <span class="section-tag">Library &amp; Demonstrations</span>
        <h2 class="section-title">Resource Space</h2>
        
        <div class="resource-grid">
          <div class="docs-list">
            <h3 class="proj-name" style="font-size: 1.15rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-book-open"></i> Technical Document Index</h3>
            
            <div class="document-card">
              <div class="document-meta">
                <div class="document-icon"><i class="fa-solid fa-file-powerpoint"></i></div>
                <div class="document-info">
                  <span class="document-title">Introduction to Returni POS</span>
                  <span class="document-desc">Outlines double-entry ledger design and transaction flows.</span>
                </div>
              </div>
              <a href="https://docs.google.com/presentation/d/1rtCBWPvFpStwEwTb8A9n-qiB1TNFoSrf3a7VA9BmX_Q/edit?usp=sharing" target="_blank" rel="noopener" class="document-link" aria-label="Open Link"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>

            <div class="document-card">
              <div class="document-meta">
                <div class="document-icon"><i class="fa-solid fa-file-powerpoint"></i></div>
                <div class="document-info">
                  <span class="document-title">Systems Architecture Presentation</span>
                  <span class="document-desc">Covers full-stack development patterns and testing workflows.</span>
                </div>
              </div>
              <a href="https://docs.google.com/presentation/d/1vkMqxLd1Izgfs69MaIFS4Abc_S8IPFqgxRjZHTttqjk/edit?usp=sharing" target="_blank" rel="noopener" class="document-link" aria-label="Open Link"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>

            <div class="document-card">
              <div class="document-meta">
                <div class="document-icon"><i class="fa-solid fa-file-pdf"></i></div>
                <div class="document-info">
                  <span class="document-title">MShare Buffer Transfers Document</span>
                  <span class="document-desc">Technical specification sheet for WebRTC peer connections.</span>
                </div>
              </div>
              <a href="/download" class="document-link" aria-label="Download Document"><i class="fa-solid fa-download"></i></a>
            </div>
          </div>

          <div class="media-console-column">
            <h3 class="proj-name" style="font-size: 1.15rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-video"></i> System Demonstration Feeds</h3>
            
            <div class="media-display-screen">
              <div class="media-screen-placeholder" id="mediaPlaceholder">
                <i class="fa-solid fa-circle-play"></i>
                <span>SELECT DEMO FEED FROM THE LIST BELOW</span>
              </div>
              <iframe id="videoPlayerFrame" style="display: none;" allowfullscreen></iframe>
              <video id="videoPlayerTag" style="display: none;" controls></video>
            </div>

            <div class="media-playlist">
              <div class="media-playlist-item" data-video-url="videos/sample1.mp4" data-is-local="true">
                <span class="media-item-title-text">MStudio IDE Traversal Demo</span>
                <span class="media-item-duration-text">04:12</span>
              </div>
              <div class="media-playlist-item" data-video-url="videos/sample2.mp4" data-is-local="true">
                <span class="media-item-title-text">MShare WebRTC Transfer Speed Audits</span>
                <span class="media-item-duration-text">03:45</span>
              </div>
              <div class="media-playlist-item" data-video-url="videos/sample3.mp4" data-is-local="true">
                <span class="media-item-title-text">Notak2 Database Replication Sync</span>
                <span class="media-item-duration-text">05:10</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 5: Contact Gateway -->
      <section id="contact" class="panel-card">
        <span class="section-tag">Communications</span>
        <h2 class="section-title">Contact Gate</h2>
        
        <div class="contact-section-row">
          <div class="form-side">
            <form id="corpContactForm" method="POST">
              <div class="form-input-row">
                <div class="form-field-group">
                  <label class="form-field-label" for="c_name">Sender Name</label>
                  <input type="text" class="form-field-input" id="c_name" required placeholder="Enter name...">
                </div>
                <div class="form-field-group">
                  <label class="form-field-label" for="c_email">Sender Email</label>
                  <input type="email" class="form-field-input" id="c_email" required placeholder="Enter email...">
                </div>
              </div>
              <div class="form-field-group">
                <label class="form-field-label" for="c_message">Message Body</label>
                <textarea class="form-field-textarea" id="c_message" required placeholder="Type details here..."></textarea>
              </div>
              <button type="submit" class="btn btn-primary form-submit-btn">
                <i class="fa-solid fa-paper-plane"></i> Transmit Request
              </button>
            </form>
          </div>

          <div class="logger-side">
            <h3 class="proj-name" style="font-size: 1.1rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-terminal"></i> Transaction Logs</h3>
            <div class="api-log-stream" id="transLogView">
              <div class="api-log-row"><span class="api-log-tag">[API]</span> <span>Awaiting contact transmission handshake signal...</span></div>
            </div>
          </div>
        </div>
      </section>

    </div>

    <!-- 4. Detailed Corporate Footer -->
    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-left">
          <span class="footer-brand-title">Mphathisi Ndlovu</span>
          <p class="footer-brand-desc">
            A software engineer focused on developing secure, high-integrity solutions, with a strong background in APIs, Linux operations, and database reliability.
          </p>
        </div>
        <div class="footer-right">
          <ul class="footer-contacts-list">
            <li>
              <i class="fa-solid fa-phone"></i>
              <span>+263 787 146 103</span>
            </li>
            <li>
              <i class="fa-solid fa-envelope"></i>
              <a href="mailto:theteqmaster@gmail.com">theteqmaster@gmail.com</a>
            </li>
            <li>
              <i class="fa-solid fa-envelope"></i>
              <a href="mailto:ndlovumphathisi23@gmail.com">ndlovumphathisi23@gmail.com</a>
            </li>
            <li>
              <i class="fa-solid fa-location-dot"></i>
              <span>Bulawayo, Zimbabwe</span>
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
        <p style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--text-dark);">STATUS: SECURE DATA PIPELINE</p>
      </div>
    </footer>
  </div>

  <!-- Client Script -->
  <script src="/assets/js/app.js"></script>

</body>
</html>
