const { useState, useRef, useEffect } = React;

function App() {
  const [sticky, setSticky] = useState(false);
  const [heroTilt, setHeroTilt] = useState({ x: 0, y: 0, spotlightX: 50, spotlightY: 50 });
  const heroRef = useRef(null);
  const [prefersReducedMotion, setPrefersReducedMotion] = useState(false);

  useEffect(() => {
    const mq = window.matchMedia('(prefers-reduced-motion: reduce)');
    setPrefersReducedMotion(mq.matches);
    const handler = () => setPrefersReducedMotion(mq.matches);
    mq.addEventListener('change', handler);
    return () => mq.removeEventListener('change', handler);
  }, []);

  useEffect(() => {
    const onScroll = () => setSticky(window.scrollY > 60);
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  const handleHeroMouseMove = (e) => {
    if (prefersReducedMotion) return;
    const el = heroRef.current;
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width;
    const y = (e.clientY - rect.top) / rect.height;
    setHeroTilt({
      x: (y - 0.5) * 12,
      y: (x - 0.5) * -12,
      spotlightX: x * 100,
      spotlightY: y * 100,
    });
  };

  const handleHeroMouseLeave = () => {
    setHeroTilt({ x: 0, y: 0, spotlightX: 50, spotlightY: 50 });
  };

  const navLinks = [
    { href: 'about.html', label: 'About' },
    { href: 'services.html', label: 'Services' },
    { href: 'skills.html', label: 'Skills' },
    { href: 'projects.html', label: 'Projects' },
    { href: 'contact.html', label: 'Contact' },
  ];

  return (
    <>
      <header className={`site-header ${sticky ? 'sticky' : ''}`}>
        <nav className="container nav">
          <a href="index.html" className="nav-brand">Mphatic</a>
          <ul className="nav-links">
            {navLinks.map(({ href, label }) => (
              <li key={href}><a href={href}>{label}</a></li>
            ))}
          </ul>
        </nav>
      </header>

      <main>
        <section className="hero">
          <div className="hero-glows" aria-hidden="true" />
          <div className="container hero-inner">
            <div
              ref={heroRef}
              className="hero-card"
              onMouseMove={handleHeroMouseMove}
              onMouseLeave={handleHeroMouseLeave}
              style={{
                transform: prefersReducedMotion ? undefined : `perspective(800px) rotateX(${heroTilt.x}deg) rotateY(${heroTilt.y}deg)`,
                '--spotlight-x': `${heroTilt.spotlightX}%`,
                '--spotlight-y': `${heroTilt.spotlightY}%`,
              }}
            >
              <h1 className="hero-title">
                <span className="hero-title-shimmer">Sir Mphatic</span>
                <span className="hero-subtitle">Teqmaster Cyber</span>
              </h1>
              <p className="hero-tagline">Portfolio — Hydramnt</p>
              <div className="hero-actions">
                <a href="projects.html" className="btn btn-primary">View Projects</a>
                <a href="contact.html" className="btn btn-secondary">Contact Me</a>
                <a href="hydra-space.html" className="btn btn-outline">Hydra Space</a>
              </div>
            </div>
          </div>
        </section>

        <section className="section section-band" id="about-preview">
          <div className="container">
            <h2 className="section-title">About</h2>
            <p className="section-lead">Professional, simple, and clean. This site showcases who I am — Sir Mphatic, Teqmaster Cyber, Hydramnt.</p>
            <a href="about.html" className="link-arrow">Learn more about me →</a>
          </div>
        </section>

        <section className="section" id="services-preview">
          <div className="container">
            <h2 className="section-title">Services</h2>
            <div className="card-grid">
              <div className="card">
                <h3>Frontend &amp; React</h3>
                <p>Clean, responsive interfaces and static sites.</p>
              </div>
              <div className="card">
                <h3>Cyber &amp; Security</h3>
                <p>Security-minded development and practices.</p>
              </div>
              <div className="card">
                <h3>Consulting</h3>
                <p>Guidance and solutions tailored to your goals.</p>
              </div>
            </div>
            <a href="services.html" className="link-arrow">All services →</a>
          </div>
        </section>

        <section className="section section-band" id="skills-preview">
          <div className="container">
            <h2 className="section-title">Skills</h2>
            <p className="section-lead">HTML, CSS, React, and a focus on modern frontend and security.</p>
            <a href="skills.html" className="link-arrow">Full skills list →</a>
          </div>
        </section>

        <section className="section" id="projects-preview">
          <div className="container">
            <h2 className="section-title">Projects</h2>
            <p className="section-lead">Selected work and side projects.</p>
            <a href="projects.html" className="btn btn-primary">View Projects</a>
          </div>
        </section>

        <section className="section section-cta section-band">
          <div className="container cta-inner">
            <h2 className="section-title">Get in touch</h2>
            <p className="section-lead">Ready to work together? Reach out.</p>
            <a href="contact.html" className="btn btn-primary">Contact Me</a>
          </div>
        </section>
      </main>

      <footer className="site-footer">
        <div className="container footer-inner">
          <p className="footer-brand">Mphatic — Teqmaster Cyber · Hydramnt</p>
          <p className="footer-copy">Portfolio site. Professional, simple, clean.</p>
        </div>
      </footer>
    </>
  );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);
