<?php
// ---------- CONFIG ----------
$channel_username = "pdloot7824"; // <-- apna channel username yahan daalo (bina @)
$channel_join_link = "https://t.me/{$channel_username}";

// Add your links here. Each item: ['title' => 'Title text', 'url' => 'https://...']
$links = [
    ['title' => 'Toluna — Welcome Offer 🪔', 'url' => 'http://pdloot.zya.me/Pro/Toluna.php'],
    ['title' => 'Confluence — Diwali Special Bonus 💖', 'url' => 'http://pdloot.zya.me/Pro/Confluence.php'],
    // Add / remove entries as you like
];
// ---------- END CONFIG ----------
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>🪔 PD Loot – Diwali Offers</title>
  <style>
    /* Reset & Global */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #0a0914 0%, #1a1625 100%);
      color: #e0e0e0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      padding: 20px 16px 100px;
      position: relative;
      overflow-x: hidden;
    }

    /* Loading Animation */
    .loading-screen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #0a0914 0%, #1a1625 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .loading-screen.hidden {
      opacity: 0;
      visibility: hidden;
    }

    .diya-loader {
      font-size: 50px;
      margin-bottom: 20px;
      animation: diyaFlicker 1.5s ease-in-out infinite;
      filter: drop-shadow(0 0 10px rgba(255, 165, 0, 0.8));
    }

    @keyframes diyaFlicker {
      0%, 100% { 
        transform: scale(1) rotate(-5deg); 
        opacity: 1;
      }
      25% { 
        transform: scale(1.1) rotate(0deg);
        opacity: 0.8;
      }
      50% { 
        transform: scale(1.05) rotate(5deg);
        opacity: 1;
      }
      75% { 
        transform: scale(1.15) rotate(-2deg);
        opacity: 0.7;
      }
    }

    .loading-text {
      color: #fff;
      font-size: 18px;
      font-weight: 600;
      text-align: center;
    }

    .loading-dots {
      display: flex;
      gap: 5px;
      margin-top: 10px;
    }

    .dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #FF6B6B;
      animation: dotPulse 1.4s ease-in-out infinite both;
    }

    .dot:nth-child(1) { animation-delay: -0.32s; }
    .dot:nth-child(2) { animation-delay: -0.16s; }
    .dot:nth-child(3) { animation-delay: 0s; }

    @keyframes dotPulse {
      0%, 80%, 100% {
        transform: scale(0.8);
        opacity: 0.5;
      }
      40% {
        transform: scale(1.2);
        opacity: 1;
      }
    }

    /* Enhanced Background */
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 10% 20%, rgba(120, 119, 198, 0.15) 0%, transparent 40%),
        radial-gradient(circle at 90% 80%, rgba(255, 119, 198, 0.12) 0%, transparent 40%),
        radial-gradient(circle at 50% 50%, rgba(120, 219, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 30% 70%, rgba(255, 215, 0, 0.1) 0%, transparent 40%);
      z-index: -1;
      animation: backgroundPulse 8s ease-in-out infinite alternate;
    }

    @keyframes backgroundPulse {
      0% { opacity: 0.7; filter: hue-rotate(0deg); }
      50% { opacity: 1; filter: hue-rotate(10deg); }
      100% { opacity: 0.8; filter: hue-rotate(-5deg); }
    }

    /* Floating particles */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .particle {
      position: absolute;
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { 
        transform: translateY(0px) rotate(0deg) scale(1); 
        opacity: 0.6;
      }
      33% { 
        transform: translateY(-20px) rotate(120deg) scale(1.1); 
        opacity: 0.8;
      }
      66% { 
        transform: translateY(10px) rotate(240deg) scale(0.9); 
        opacity: 0.4;
      }
    }

    /* Header - Mobile Optimized */
    .site-header {
      padding: 15px 0;
      text-align: left;
      margin-bottom: 25px;
    }
    .brand h1 {
      font-size: 24px;
      font-weight: 700;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 5px;
    }
    .brand h1::before {
      content: "🪔";
      font-size: 26px;
    }
    .brand .owner {
      font-size: 14px;
      opacity: 0.8;
      color: #ccc;
    }

    /* Cards - Mobile Optimized */
    .cards {
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 100%;
      margin: 0 auto;
    }

    .card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      text-decoration: none;
      border-radius: 16px;
      padding: 18px 20px;
      background: rgba(30, 25, 45, 0.9);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
      color: #fff;
      position: relative;
      overflow: hidden;
      backdrop-filter: blur(10px);
    }

    .card:hover {
      transform: translateY(-2px);
      background: rgba(40, 35, 55, 0.95);
      border-color: rgba(255, 215, 0, 0.3);
    }

    .card-inner {
      z-index: 1;
      flex: 1;
    }
    .card-title {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 5px;
      color: #fff;
    }
    .card-sub {
      font-size: 13px;
      opacity: 0.8;
      color: #ccc;
    }

    .arrow {
      font-size: 18px;
      opacity: 0.7;
      z-index: 1;
      transition: transform 0.3s ease;
    }
    .card:hover .arrow {
      transform: translateX(5px);
    }

    /* Empty state */
    .empty {
      text-align: center;
      opacity: 0.8;
      padding: 30px 20px;
      border-radius: 16px;
      background: rgba(25, 22, 40, 0.6);
      width: 100%;
      margin: 20px auto;
      font-size: 14px;
    }

    /* JOIN BUTTON - SIMPLE TEXT */
    .fixed-join {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 100%;
      max-width: 320px;
      display: flex;
      justify-content: center;
      z-index: 100;
      padding: 0 16px;
    }

    .join-btn {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      padding: 16px 28px;
      border-radius: 50px;
      background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FF6B6B 100%);
      background-size: 200% 200%;
      box-shadow: 
        0 8px 25px rgba(255, 107, 107, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.1);
      color: white;
      font-weight: 700;
      font-size: 16px;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      animation: gradientShift 3s ease infinite;
      border: none;
      cursor: pointer;
      width: 100%;
      justify-content: center;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .join-btn::before {
      content: "✨";
      font-size: 18px;
    }

    .join-btn:hover {
      transform: translateY(-2px);
      box-shadow: 
        0 12px 30px rgba(255, 107, 107, 0.6),
        0 0 0 1px rgba(255, 255, 255, 0.2);
    }

    /* Mobile First Design */
    @media (max-width: 480px) {
      body {
        padding: 15px 12px 90px;
      }
      
      .site-header {
        padding: 10px 0;
        margin-bottom: 20px;
      }
      
      .brand h1 {
        font-size: 22px;
        gap: 8px;
      }
      
      .brand h1::before {
        font-size: 24px;
      }
      
      .cards {
        gap: 12px;
      }
      
      .card {
        padding: 16px 18px;
        border-radius: 14px;
      }
      
      .card-title {
        font-size: 15px;
      }
      
      .card-sub {
        font-size: 12px;
      }
      
      .fixed-join {
        bottom: 15px;
        max-width: 280px;
      }
      
      .join-btn {
        padding: 14px 24px;
        font-size: 15px;
      }

      .diya-loader {
        font-size: 40px;
      }

      .loading-text {
        font-size: 16px;
      }
    }

    @media (max-width: 360px) {
      .brand h1 {
        font-size: 20px;
      }
      
      .card {
        padding: 14px 16px;
      }
      
      .join-btn {
        padding: 12px 20px;
        font-size: 14px;
      }
    }

    /* Small animation for cards */
    .card {
      animation: cardEntrance 0.5s ease-out;
      animation-fill-mode: both;
    }

    @keyframes cardEntrance {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <!-- Loading Animation -->
  <div class="loading-screen" id="loadingScreen">
    <div class="diya-loader">🪔</div>
    <div class="loading-text">Loading Diwali Offers</div>
    <div class="loading-dots">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
  </div>

  <!-- Floating Particles -->
  <div class="particles" id="particles"></div>

  <header class="site-header">
    <div class="brand">
      <h1>PD Loot</h1>
      <p class="owner">by Krishna Sikarwar</p>
    </div>
  </header>

  <main class="container">
    <?php if(count($links) === 0): ?>
      <div class="empty">Koi link nahi mila — upar config me $links add karo.</div>
    <?php else: ?>
      <div class="cards">
        <?php foreach($links as $i => $item): 
          $safe_title = htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8');
          $safe_url = htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8');
        ?>
          <a class="card" href="<?php echo $safe_url; ?>" target="_blank" rel="noopener noreferrer" style="animation-delay: <?php echo $i * 0.1; ?>s">
            <div class="card-inner">
              <h2 class="card-title"><?php echo $safe_title; ?></h2>
              <p class="card-sub">Open karo aur offer pao 🪔</p>
            </div>
            <span class="arrow">→</span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>

  <!-- JOIN BUTTON - SIMPLE "Join Channel" TEXT -->
  <footer class="fixed-join">
    <a class="join-btn" href="<?php echo htmlspecialchars($channel_join_link, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
      Join Channel
    </a>
  </footer>

  <script>
    // Loading animation
    window.addEventListener('load', function() {
      setTimeout(function() {
        const loadingScreen = document.getElementById('loadingScreen');
        loadingScreen.classList.add('hidden');
        
        // Remove loading screen from DOM after animation
        setTimeout(function() {
          loadingScreen.remove();
        }, 500);
      }, 2000); // 2 seconds loading time
    });

    // Create floating particles
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 12;
      
      const colors = [
        'radial-gradient(circle, rgba(255,215,0,0.3) 0%, transparent 70%)',
        'radial-gradient(circle, rgba(255,107,107,0.2) 0%, transparent 70%)',
        'radial-gradient(circle, rgba(120,219,255,0.2) 0%, transparent 70%)'
      ];
      
      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random properties
        const size = Math.random() * 60 + 20;
        const left = Math.random() * 100;
        const top = Math.random() * 100;
        const delay = Math.random() * 6;
        const duration = Math.random() * 4 + 4;
        const color = colors[Math.floor(Math.random() * colors.length)];
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${left}%`;
        particle.style.top = `${top}%`;
        particle.style.background = color;
        particle.style.animationDelay = `${delay}s`;
        particle.style.animationDuration = `${duration}s`;
        
        particlesContainer.appendChild(particle);
      }
    }

    // Simple click feedback
    document.querySelectorAll('.card').forEach((card) => {
      card.addEventListener('click', () => {
        card.style.transform = 'scale(0.98)';
        setTimeout(() => {
          card.style.transform = '';
        }, 200);
      });
    });

    // Button hover effect
    const joinBtn = document.querySelector('.join-btn');
    if (joinBtn) {
      joinBtn.addEventListener('mouseenter', function() {
        this.style.animation = 'gradientShift 1s ease infinite';
      });

      joinBtn.addEventListener('mouseleave', function() {
        this.style.animation = 'gradientShift 3s ease infinite';
      });
    }

    // Initialize particles when page loads
    document.addEventListener('DOMContentLoaded', createParticles);
  </script>
</body>
</html>