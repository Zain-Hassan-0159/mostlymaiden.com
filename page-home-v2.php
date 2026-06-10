<?php
/**
 * Template Name: Home Page V2
 * Template Post Type: page
 */
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mostly Maiden – Landing</title>

  <style>
    :root{
      --bg:#000;
      --panel:#0b0b0b;
      --panel2:#111;
      --text:#eaeaea;
      --muted:#bdbdbd;
      --line:rgba(255,255,255,.12);
      --accent:#8b0000;
      --accent2:#b10c0c;
      --btn:#1a1a1a;
      --btnHover:#252525;
      --radius:14px;
      --max:1180px;
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.4;
    }
    a{ color:inherit; text-decoration:none; }
    img{ max-width:100%; display:block; }
    .container{
      width:min(var(--max), calc(100% - 32px));
      margin-inline:auto;
    }

    /* -------------------------
      TOP HERO
    ------------------------- */
    .hero{
      position:relative;
      min-height: 62vh;
      background:
        radial-gradient(1200px 450px at 50% 60%, rgba(0,160,255,.22), transparent 60%),
        linear-gradient(to bottom, rgba(0,0,0,.25), rgba(0,0,0,.75)),
        url("assets/hero-city.jpg") center/cover no-repeat; /* <-- replace */
      overflow:hidden;
      border-bottom:1px solid var(--line);
    }
    .hero::after{
      content:"";
      position:absolute; inset:0;
      background:
        repeating-linear-gradient(
          to right,
          rgba(255,255,255,.06) 0,
          rgba(255,255,255,.06) 1px,
          transparent 1px,
          transparent 80px
        );
      mix-blend-mode:overlay;
      opacity:.6;
      pointer-events:none;
    }

    .nav{
      position:relative;
      z-index:2;
      padding:18px 0;
    }
    .nav-inner{
      display:flex;
      align-items:center;
      justify-content:flex-end;
      gap:22px;
      font-weight:600;
      letter-spacing:.02em;
      text-transform:uppercase;
      font-size:12px;
    }
    .nav a{
      opacity:.9;
      padding:8px 10px;
      border-radius:10px;
    }
    .nav a:hover{ background:rgba(255,255,255,.08); }

    /* mobile nav */
    .nav-toggle{
      display:none;
      border:1px solid var(--line);
      background:rgba(0,0,0,.35);
      color:var(--text);
      padding:10px 12px;
      border-radius:12px;
      cursor:pointer;
      font-weight:700;
      letter-spacing:.03em;
    }
    #navMenu{ display:flex; }

    .hero-center{
      position:relative;
      z-index:2;
      padding:44px 0 56px;
      display:flex;
      align-items:center;
      justify-content:center;
      text-align:center;
    }
    .brand-lockup{
      display:grid;
      gap:10px;
      justify-items:center;
      padding:18px 18px 10px;
    }
    .brand-title{
      font-size: clamp(40px, 5.5vw, 86px);
      font-weight:900;
      line-height:0.95;
      text-transform:uppercase;
      letter-spacing:.02em;
      text-shadow: 0 12px 40px rgba(0,0,0,.8);
    }
    .brand-sub{
      font-size: clamp(12px, 1.2vw, 16px);
      text-transform:uppercase;
      letter-spacing:.18em;
      font-weight:800;
      opacity:.95;
      text-shadow: 0 10px 30px rgba(0,0,0,.85);
    }
    .brand-micro{
      font-size:11px;
      text-transform:uppercase;
      letter-spacing:.16em;
      opacity:.75;
    }

    /* -------------------------
      INTRO TEXT
    ------------------------- */
    .intro{
      background:#050505;
      border-bottom:1px solid var(--line);
    }
    .intro .container{
      padding:18px 0 22px;
    }
    .intro p{
      margin:0;
      color:var(--muted);
      font-size:14px;
    }
    .intro strong{ color:var(--text); }

    /* -------------------------
      BAND IMAGE
    ------------------------- */
    .band-shot{
      background: radial-gradient(900px 340px at 50% 20%, rgba(80,150,255,.18), transparent 60%), #020202;
      border-bottom:1px solid var(--line);
    }
    .band-wrap{
      padding:28px 0 34px;
    }
    .band-card{
      border-radius: var(--radius);
      overflow:hidden;
      border:1px solid var(--line);
      background:#000;
      box-shadow: 0 20px 70px rgba(0,0,0,.65);
    }
    .band-card img{
      width:100%;
      height: clamp(220px, 38vw, 520px);
      object-fit:cover;
      filter: contrast(1.05) saturate(1.05);
    }

    /* -------------------------
      BOOKING + SHOWS
    ------------------------- */
    .section-title{
      padding:34px 0 12px;
      text-align:center;
      font-size: clamp(18px, 2.2vw, 28px);
      letter-spacing:.12em;
      text-transform:uppercase;
      font-weight:900;
    }

    .shows{
      padding-bottom:10px;
      border-bottom:1px solid var(--line);
      background:#000;
    }
    .shows h3{
      margin:0 0 10px;
      font-size:18px;
      letter-spacing:.08em;
      text-transform:uppercase;
    }
    .show-list{
      border-top:1px solid var(--line);
    }
    .show-row{
      display:grid;
      grid-template-columns: 2fr 1.6fr 0.8fr 1fr 0.9fr 120px;
      gap:10px;
      align-items:center;
      padding:14px 0;
      border-bottom:1px solid var(--line);
      font-size:13px;
      color:var(--muted);
    }
    .show-row strong{ color:var(--text); font-weight:800; }
    .ticket-btn{
      justify-self:end;
      border:1px solid rgba(255,255,255,.28);
      background:transparent;
      color:var(--text);
      padding:10px 14px;
      border-radius:12px;
      font-weight:800;
      letter-spacing:.08em;
      text-transform:uppercase;
      font-size:12px;
      cursor:pointer;
      transition:.15s ease;
    }
    .ticket-btn:hover{
      background:rgba(255,255,255,.08);
      transform: translateY(-1px);
    }

    /* compact header row labels for desktop only */
    .show-head{
      opacity:.9;
      color:#cfcfcf;
      font-weight:800;
      text-transform:uppercase;
      letter-spacing:.12em;
      font-size:11px;
      padding:10px 0 12px;
    }

    /* -------------------------
      REQUEST A SHOW
    ------------------------- */
    .request{
      padding:26px 0 34px;
      background:#000;
      border-bottom:1px solid var(--line);
    }
    .request h4{
      margin:0 0 6px;
      font-size:20px;
      font-weight:900;
    }
    .request p{
      margin:0 0 18px;
      color:var(--muted);
      font-size:13px;
    }
    .venues{
      display:grid;
      grid-template-columns: repeat(5, 1fr);
      gap:14px;
    }
    .venue{
      border:1px solid var(--line);
      border-radius:14px;
      padding:14px;
      background: linear-gradient(to bottom, rgba(255,255,255,.05), rgba(255,255,255,0));
      display:grid;
      gap:10px;
      align-content:start;
      min-height:118px;
      cursor:pointer;
      transition:.15s ease;
    }
    .venue:hover{
      transform: translateY(-2px);
      background: linear-gradient(to bottom, rgba(255,255,255,.08), rgba(255,255,255,0));
    }
    .venue img{
      height:36px;
      object-fit:contain;
      width:100%;
      filter: grayscale(1) contrast(1.2) brightness(1.15);
      opacity:.95;
    }
    .venue small{
      display:block;
      color:var(--muted);
      text-align:center;
      font-size:11px;
      line-height:1.25;
    }

    /* -------------------------
      ENCORE SECTION (RED)
    ------------------------- */
    .encore{
      background: linear-gradient(180deg, var(--accent2), var(--accent));
      padding:28px 0 34px;
      border-bottom:1px solid rgba(255,255,255,.18);
    }
    .encore-grid{
      display:grid;
      grid-template-columns: 1.05fr 0.95fr;
      gap:18px;
      align-items:stretch;
    }
    .encore-card{
      border:1px solid rgba(255,255,255,.18);
      border-radius: var(--radius);
      background: rgba(0,0,0,.22);
      padding:18px;
      min-height: 260px;
    }
    .encore h4{
      margin:0 0 10px;
      font-size:22px;
      font-weight:900;
    }
    .encore p{
      margin:0 0 14px;
      color: rgba(255,255,255,.88);
      font-size:13px;
    }

    .encore form{
      display:grid;
      gap:10px;
      margin-top:10px;
    }
    .input{
      width:100%;
      border:1px solid rgba(255,255,255,.25);
      background: rgba(0,0,0,.28);
      color: var(--text);
      padding:12px 12px;
      border-radius:12px;
      outline:none;
    }
    .input::placeholder{ color: rgba(255,255,255,.65); }

    .submit{
      width:fit-content;
      justify-self:end;
      border:none;
      background:#000;
      color:var(--text);
      padding:11px 16px;
      border-radius:12px;
      font-weight:900;
      letter-spacing:.08em;
      text-transform:uppercase;
      cursor:pointer;
      transition:.15s ease;
    }
    .submit:hover{ background:rgba(0,0,0,.82); transform: translateY(-1px); }

    .pick-title{
      display:flex;
      align-items:baseline;
      justify-content:space-between;
      gap:12px;
      margin-bottom:10px;
    }
    .pick-title span{
      font-weight:900;
      text-transform:uppercase;
      letter-spacing:.12em;
    }
    .pill{
      font-size:12px;
      font-weight:900;
      background: rgba(0,0,0,.35);
      border:1px solid rgba(255,255,255,.2);
      padding:6px 10px;
      border-radius:999px;
      letter-spacing:.12em;
    }

    .picklist{
      display:grid;
      gap:10px;
      margin-top:10px;
    }
    .pick{
      display:flex;
      align-items:flex-start;
      gap:10px;
      padding:10px 10px;
      border-radius:12px;
      border:1px solid rgba(255,255,255,.16);
      background: rgba(0,0,0,.18);
      cursor:pointer;
      user-select:none;
      transition:.12s ease;
    }
    .pick:hover{ background: rgba(0,0,0,.24); }
    .pick input{ margin-top:3px; }
    .pick label{ cursor:pointer; font-size:13px; }

    /* -------------------------
      MERCH
    ------------------------- */
    .merch{
      background:#000;
      padding:26px 0 44px;
    }
    .merch h3{
      margin:0 0 16px;
      font-size:18px;
      letter-spacing:.1em;
      text-transform:uppercase;
      font-weight:900;
    }
    .merch-grid{
      display:grid;
      grid-template-columns: repeat(4, 1fr);
      gap:16px;
    }
    .product{
      border:1px solid var(--line);
      border-radius: var(--radius);
      background: linear-gradient(to bottom, rgba(255,255,255,.05), rgba(255,255,255,0));
      overflow:hidden;
      transition:.15s ease;
    }
    .product:hover{
      transform: translateY(-2px);
      background: linear-gradient(to bottom, rgba(255,255,255,.08), rgba(255,255,255,0));
    }
    .product .img{
      background:#050505;
      padding:16px;
      display:grid;
      place-items:center;
      border-bottom:1px solid var(--line);
      min-height:180px;
    }
    .product .img img{
      height:140px;
      object-fit:contain;
      filter: drop-shadow(0 14px 30px rgba(0,0,0,.7));
    }
    .product .meta{
      padding:14px 14px 16px;
      display:grid;
      gap:6px;
    }
    .product .name{
      font-weight:900;
      letter-spacing:.02em;
    }
    .product .desc{
      color:var(--muted);
      font-size:12px;
    }
    .product .price{
      margin-top:4px;
      font-weight:900;
    }

    /* -------------------------
      RESPONSIVE
    ------------------------- */
    @media (max-width: 980px){
      .venues{ grid-template-columns: repeat(3, 1fr); }
      .encore-grid{ grid-template-columns: 1fr; }
      .show-row{ grid-template-columns: 1.7fr 1.2fr 0.8fr 0.9fr 0.8fr 120px; }
      .merch-grid{ grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 720px){
      .nav-inner{ justify-content:space-between; }
      .nav-toggle{ display:inline-flex; align-items:center; gap:8px; }
      #navMenu{
        display:none;
        position:absolute;
        right:16px;
        top:58px;
        flex-direction:column;
        gap:6px;
        padding:10px;
        border-radius:14px;
        border:1px solid var(--line);
        background: rgba(0,0,0,.88);
        backdrop-filter: blur(8px);
        min-width: 180px;
      }
      #navMenu a{ padding:10px 12px; }
      #navMenu.open{ display:flex; }

      .hero-center{ padding:34px 0 44px; }
      .intro p{ font-size:13px; }

      .show-head{ display:none; }
      .show-row{
        grid-template-columns: 1fr;
        gap:8px;
        padding:14px 0;
      }
      .show-row > div{
        display:flex;
        justify-content:space-between;
        gap:12px;
      }
      .show-row > div::before{
        content: attr(data-label);
        color:#cfcfcf;
        font-weight:800;
        text-transform:uppercase;
        letter-spacing:.12em;
        font-size:11px;
        opacity:.9;
      }
      .show-row .tickets{
        justify-content:flex-end;
      }
      .ticket-btn{ width:100%; justify-self:stretch; }

      .venues{ grid-template-columns: repeat(2, 1fr); }
      .merch-grid{ grid-template-columns: 1fr; }
    }

    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; scroll-behavior:auto !important; }
    }
  </style>
</head>

<body>

  <!-- HERO -->
  <header class="hero">
    <div class="nav">
      <div class="container">
        <div class="nav-inner">
          <button class="nav-toggle" type="button" aria-controls="navMenu" aria-expanded="false" id="navToggle">
            Menu
          </button>

          <nav id="navMenu" aria-label="Primary">
            <a href="#band">Band</a>
            <a href="#shows">Shows</a>
            <a href="#epk">EPK</a>
            <a href="#vote">Vote</a>
            <a href="#merch">Merch</a>
          </nav>
        </div>
      </div>
    </div>

    <div class="hero-center">
      <div class="container">
        <div class="brand-lockup">
          <!-- Replace with your real logo image if you want -->
          <!-- <img src="assets/logo.png" alt="Mostly Maiden" style="max-width:540px;"> -->

          <div class="brand-title">Mostly<br>Maiden</div>
          <div class="brand-sub">The Iron Maiden Experience</div>
          <div class="brand-micro">All Live &nbsp;–&nbsp; No Tracks</div>
        </div>
      </div>
    </div>
  </header>

  <!-- INTRO -->
  <section class="intro" id="band">
    <div class="container">
      <p>
        <strong>MOSTLY MAIDEN</strong> delivers an AMAZING set of your favorite Iron Maiden songs.
        All killer. No filler. Experience a real live production complete with incredible sound and visuals.
        Engage with the band by picking each show’s encore. Vote for your favorite classic and New Wave of British
        Heavy Metal songs — we deliver the goods!
      </p>
    </div>
  </section>

  <!-- BAND IMAGE -->
  <section class="band-shot">
    <div class="container band-wrap">
      <div class="band-card">
        <img src="assets/band-stage.jpg" alt="Mostly Maiden live on stage" /> <!-- <-- replace -->
      </div>
    </div>
  </section>

  <!-- BOOKING TITLE -->
  <div class="section-title">Now Booking Summer/Fall 2026</div>

  <!-- SHOWS -->
  <section class="shows" id="shows">
    <div class="container">
      <h3>Shows</h3>

      <div class="show-head show-row" aria-hidden="true">
        <div>Venue</div>
        <div>City</div>
        <div>Date</div>
        <div>Time</div>
        <div>Price</div>
        <div></div>
      </div>

      <div class="show-list">
        <!-- Duplicate these rows dynamically later if needed -->
        <div class="show-row">
          <div data-label="Venue"><strong>The Vault</strong></div>
          <div data-label="City">New Bedford, MA</div>
          <div data-label="Date">Saturday, July 17, 2026</div>
          <div data-label="Time">9:00PM</div>
          <div data-label="Price">$15/Advance &nbsp; • &nbsp; $20/Door</div>
          <div class="tickets" data-label="Tickets"><button class="ticket-btn">Tickets</button></div>
        </div>

        <div class="show-row">
          <div data-label="Venue"><strong>The Vault</strong></div>
          <div data-label="City">New Bedford, MA</div>
          <div data-label="Date">Saturday, July 17, 2026</div>
          <div data-label="Time">9:00PM</div>
          <div data-label="Price">$15/Advance &nbsp; • &nbsp; $20/Door</div>
          <div class="tickets" data-label="Tickets"><button class="ticket-btn">Tickets</button></div>
        </div>

        <div class="show-row">
          <div data-label="Venue"><strong>The Vault</strong></div>
          <div data-label="City">New Bedford, MA</div>
          <div data-label="Date">Saturday, July 17, 2026</div>
          <div data-label="Time">9:00PM</div>
          <div data-label="Price">$15/Advance &nbsp; • &nbsp; $20/Door</div>
          <div class="tickets" data-label="Tickets"><button class="ticket-btn">Tickets</button></div>
        </div>

        <div class="show-row">
          <div data-label="Venue"><strong>The Vault</strong></div>
          <div data-label="City">New Bedford, MA</div>
          <div data-label="Date">Saturday, July 17, 2026</div>
          <div data-label="Time">9:00PM</div>
          <div data-label="Price">$15/Advance &nbsp; • &nbsp; $20/Door</div>
          <div class="tickets" data-label="Tickets"><button class="ticket-btn">Tickets</button></div>
        </div>

        <div class="show-row">
          <div data-label="Venue"><strong>The Vault</strong></div>
          <div data-label="City">New Bedford, MA</div>
          <div data-label="Date">Saturday, July 17, 2026</div>
          <div data-label="Time">9:00PM</div>
          <div data-label="Price">$15/Advance &nbsp; • &nbsp; $20/Door</div>
          <div class="tickets" data-label="Tickets"><button class="ticket-btn">Tickets</button></div>
        </div>

        <div class="show-row">
          <div data-label="Venue"><strong>The Vault</strong></div>
          <div data-label="City">New Bedford, MA</div>
          <div data-label="Date">Saturday, July 17, 2026</div>
          <div data-label="Time">9:00PM</div>
          <div data-label="Price">$15/Advance &nbsp; • &nbsp; $20/Door</div>
          <div class="tickets" data-label="Tickets"><button class="ticket-btn">Tickets</button></div>
        </div>
      </div>
    </div>
  </section>

  <!-- REQUEST A SHOW -->
  <section class="request" id="epk">
    <div class="container">
      <h4>Request a show near you!</h4>
      <p>Click on the venue below to request a show.</p>

      <div class="venues">
        <div class="venue" role="button" tabindex="0">
          <img src="assets/venue-vault.png" alt="The Vault" /> <!-- <-- replace -->
          <small>The Vault<br>New Bedford MA</small>
        </div>

        <div class="venue" role="button" tabindex="0">
          <img src="assets/venue-wallys.png" alt="Wally's" /> <!-- <-- replace -->
          <small>Wally’s<br>Hampton, NH</small>
        </div>

        <div class="venue" role="button" tabindex="0">
          <img src="assets/venue-jewel.png" alt="Jewel" /> <!-- <-- replace -->
          <small>Jewel<br>Manchester, NH</small>
        </div>

        <div class="venue" role="button" tabindex="0">
          <img src="assets/venue-angelcity.png" alt="Angel City" /> <!-- <-- replace -->
          <small>Angel City<br>Manchester, NH</small>
        </div>

        <div class="venue" role="button" tabindex="0">
          <img src="assets/venue-taffeta.png" alt="Taffeta" /> <!-- <-- replace -->
          <small>Taffeta<br>Lowell, MA</small>
        </div>
      </div>
    </div>
  </section>

  <!-- ENCORE / VOTE -->
  <section class="encore" id="vote">
    <div class="container encore-grid">
      <div class="encore-card">
        <h4>You pick the Encore!</h4>
        <p>
          That’s right — pick the 3 songs you want to hear as tonight’s encore.
          We’ll play the top choices as selected by you!
        </p>
        <p>
          Vote as many times as you like and feel free to suggest a song you want to hear next time!
        </p>

        <form>
          <input class="input" type="text" placeholder="Submit your Song" aria-label="Submit your Song" />
          <!-- if you want real reCAPTCHA, add it here -->
          <button class="submit" type="button">Submit</button>
        </form>
      </div>

      <div class="encore-card">
        <div class="pick-title">
          <span>Pick 3</span>
          <span class="pill">Encore</span>
        </div>

        <div class="picklist" aria-label="Pick 3 songs">
          <div class="pick">
            <input type="checkbox" id="s1">
            <label for="s1">Hellion / Electric Eye – Judas Priest</label>
          </div>
          <div class="pick">
            <input type="checkbox" id="s2">
            <label for="s2">Children of the Grave – Black Sabbath</label>
          </div>
          <div class="pick">
            <input type="checkbox" id="s3">
            <label for="s3">Killed by Death – Motörhead</label>
          </div>
          <div class="pick">
            <input type="checkbox" id="s4">
            <label for="s4">Let it Go – Def Leppard</label>
          </div>
          <div class="pick">
            <input type="checkbox" id="s5">
            <label for="s5">Doctor Doctor – UFO</label>
          </div>
          <div class="pick">
            <input type="checkbox" id="s6">
            <label for="s6">Looks That Kill – Mötley Crüe</label>
          </div>
          <div class="pick">
            <input type="checkbox" id="s7">
            <label for="s7">Rocket Queen – Guns N’ Roses</label>
          </div>
        </div>

        <div style="display:flex; justify-content:flex-end; margin-top:12px;">
          <button class="submit" type="button">Submit</button>
        </div>
      </div>
    </div>
  </section>

  <!-- MERCH -->
  <section class="merch" id="merch">
    <div class="container">
      <h3>Merch</h3>

      <div class="merch-grid">
        <article class="product">
          <div class="img">
            <img src="assets/merch-shirt-1.png" alt="Classic Logo Front T-Shirt" /> <!-- <-- replace -->
          </div>
          <div class="meta">
            <div class="name">Classic Logo Front</div>
            <div class="desc">100% Cotton<br>S-3XL</div>
            <div class="price">$20.00</div>
          </div>
        </article>

        <article class="product">
          <div class="img">
            <img src="assets/merch-shirt-2.png" alt="Stack Logo Front T-Shirt" /> <!-- <-- replace -->
          </div>
          <div class="meta">
            <div class="name">Stack Logo Front</div>
            <div class="desc">100% Cotton<br>S-3XL</div>
            <div class="price">$20.00</div>
          </div>
        </article>

        <article class="product">
          <div class="img">
            <img src="assets/merch-hat.png" alt="Knit Hat" /> <!-- <-- replace -->
          </div>
          <div class="meta">
            <div class="name">Knit Hat</div>
            <div class="desc">S-3XL</div>
            <div class="price">$15.00</div>
          </div>
        </article>

        <article class="product">
          <div class="img">
            <img src="assets/merch-hoodie.png" alt="Hoodie Classic Logo Front" /> <!-- <-- replace -->
          </div>
          <div class="meta">
            <div class="name">Hoodie Classic Logo Front</div>
            <div class="desc">S-3XL</div>
            <div class="price">$40.00</div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <script>
    // Mobile nav toggle
    const btn = document.getElementById('navToggle');
    const menu = document.getElementById('navMenu');

    if (btn && menu) {
      btn.addEventListener('click', () => {
        const open = menu.classList.toggle('open');
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      });

      // close on link click (mobile)
      menu.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
          menu.classList.remove('open');
          btn.setAttribute('aria-expanded', 'false');
        });
      });
    }

    // Limit "Pick 3" checkboxes
    const checks = Array.from(document.querySelectorAll('.picklist input[type="checkbox"]'));
    checks.forEach(c => {
      c.addEventListener('change', () => {
        const selected = checks.filter(x => x.checked);
        if (selected.length > 3) c.checked = false;
      });
    });
  </script>

</body>
</html>
