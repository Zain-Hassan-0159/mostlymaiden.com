<?php
/**
 * Template Name: Home Page V1
 * Template Post Type: page
 *
 * Dynamic version — ACF Free compatible (no repeater fields).
 *
 * Data sources:
 *  - ACF text/textarea fields on this page
 *  - CPT: mm_show  (one post per show date)
 *  - CPT: mm_venue (one post per request-a-show venue)
 *  - Merch section: hidden (placeholder for future WooCommerce integration)
 */

// Helper: get ACF field with fallback (safe when ACF not active)
function mm_field( $key, $default = '' ) {
    if ( ! function_exists( 'get_field' ) ) return $default;
    $val = get_field( $key );
    return ( $val !== '' && $val !== null && $val !== false ) ? $val : $default;
}

get_header();
?>

<style>
  :root {
    --red: #cc1818;
    --red-dark: #8b0000;
    --gold: #c9a227;
    --white: #f0eee8;
    --black: #0a0a0a;
    --dark: #111111;
    --mid: #1a1a1a;
    --text-gray: #aaa;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }

  body {
    background: var(--black);
    color: var(--white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    overflow-x: hidden;
  }

  /* ── HERO ── */
  .hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
    background: #050a18;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .hero-bg {
    position: absolute; inset: 0;
    background:
      radial-gradient(ellipse 80% 60% at 50% 40%, rgba(0,60,160,.35) 0%, transparent 70%),
      radial-gradient(ellipse 60% 40% at 20% 80%, rgba(150,10,10,.2) 0%, transparent 60%),
      repeating-linear-gradient(0deg, rgba(255,255,255,.02) 0px, rgba(255,255,255,.02) 1px, transparent 1px, transparent 60px),
      repeating-linear-gradient(90deg, rgba(255,255,255,.02) 0px, rgba(255,255,255,.02) 1px, transparent 1px, transparent 60px);
    animation: bgPulse 6s ease-in-out infinite alternate;
  }
  @keyframes bgPulse {
    from { filter: brightness(1); }
    to   { filter: brightness(1.15); }
  }
  .city {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 220px;
    background: linear-gradient(to top, #05080f 30%, transparent 100%);
  }
  .city::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 180px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1920 180'%3E%3Crect x='0' y='80' width='40' height='100' fill='%23080c14'/%3E%3Crect x='50' y='50' width='60' height='130' fill='%23080c14'/%3E%3Crect x='120' y='70' width='30' height='110' fill='%23080c14'/%3E%3Crect x='160' y='20' width='80' height='160' fill='%230a0f1a'/%3E%3Crect x='250' y='60' width='50' height='120' fill='%23080c14'/%3E%3Crect x='310' y='40' width='70' height='140' fill='%230a0f1a'/%3E%3Crect x='390' y='75' width='35' height='105' fill='%23080c14'/%3E%3Crect x='440' y='30' width='55' height='150' fill='%230a0f1a'/%3E%3Crect x='510' y='65' width='45' height='115' fill='%23080c14'/%3E%3Crect x='570' y='45' width='65' height='135' fill='%230a0f1a'/%3E%3Crect x='650' y='10' width='90' height='170' fill='%230d1220'/%3E%3Crect x='760' y='55' width='40' height='125' fill='%23080c14'/%3E%3Crect x='820' y='35' width='75' height='145' fill='%230a0f1a'/%3E%3Crect x='910' y='60' width='50' height='120' fill='%23080c14'/%3E%3Crect x='970' y='25' width='80' height='155' fill='%230d1220'/%3E%3Crect x='1060' y='70' width='35' height='110' fill='%23080c14'/%3E%3Crect x='1110' y='45' width='60' height='135' fill='%230a0f1a'/%3E%3Crect x='1180' y='55' width='45' height='125' fill='%23080c14'/%3E%3Crect x='1240' y='20' width='85' height='160' fill='%230d1220'/%3E%3Crect x='1340' y='65' width='40' height='115' fill='%23080c14'/%3E%3Crect x='1395' y='40' width='70' height='140' fill='%230a0f1a'/%3E%3Crect x='1480' y='60' width='50' height='120' fill='%23080c14'/%3E%3Crect x='1545' y='30' width='65' height='150' fill='%230a0f1a'/%3E%3Crect x='1620' y='15' width='90' height='165' fill='%230d1220'/%3E%3Crect x='1725' y='50' width='55' height='130' fill='%230a0f1a'/%3E%3Crect x='1790' y='75' width='40' height='105' fill='%23080c14'/%3E%3Crect x='1845' y='40' width='75' height='140' fill='%230a0f1a'/%3E%3C/svg%3E") center bottom / cover no-repeat;
  }
  .hero-logo-wrap {
    position: relative; z-index: 2;
    display: flex; flex-direction: column; align-items: center;
    animation: heroFade 1.2s ease both;
  }
  @keyframes heroFade {
    from { opacity:0; transform: translateY(-30px); }
    to   { opacity:1; transform: translateY(0); }
  }
  .logo-skull {
    font-size: 5rem; line-height: 1;
    filter: drop-shadow(0 0 20px rgba(0,100,255,.6));
    animation: glowPulse 3s ease-in-out infinite alternate;
  }
  @keyframes glowPulse {
    from { filter: drop-shadow(0 0 15px rgba(0,100,255,.5)); }
    to   { filter: drop-shadow(0 0 35px rgba(0,150,255,.9)) drop-shadow(0 0 60px rgba(0,80,200,.4)); }
  }
  .hero h1 {
    font-family: 'Metal Mania', cursive;
    font-size: clamp(3rem, 9vw, 7rem);
    line-height: .95; color: var(--white);
    text-shadow: 0 0 30px rgba(100,180,255,.5), 0 4px 12px rgba(0,0,0,.8);
    letter-spacing: .05em; margin: .15em 0;
  }
  .hero h1 span { color: #6ab4ff; }
  .hero-sub {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(.9rem, 2vw, 1.3rem);
    letter-spacing: .4em; text-transform: uppercase;
    color: var(--white); margin-bottom: .8rem;
  }
  .hero-tags {
    display: flex; gap: 1rem;
    font-family: 'Oswald', sans-serif;
    font-size: .7rem; letter-spacing: .25em;
    text-transform: uppercase; color: var(--text-gray); align-items: center;
  }
  .hero-tags span::before { content: '• '; color: var(--red); }
  .hero::after {
    content: ''; position: absolute; inset: 0;
    background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(0,0,0,.04) 3px, rgba(0,0,0,.04) 4px);
    pointer-events: none; z-index: 3;
  }

  /* ── ABOUT ── */
  .about {
    background: #0e0e0e; padding: 3rem 2rem; text-align: center;
    border-top: 2px solid var(--red-dark); border-bottom: 2px solid var(--red-dark);
  }
  .about p { max-width: 680px; margin: 0 auto; font-size: 1rem; line-height: 1.8; color: #ccc; }
  .about strong { color: var(--white); font-weight: 600; }

  /* ── STAGE ── */
  .stage {
    position: relative;
  }
  .stage-lights { position: absolute; inset: 0; overflow: hidden; }
  .stage-lights::before, .stage-lights::after {
    content: ''; position: absolute; top: 0; width: 4px; height: 100%;
    background: linear-gradient(to bottom, rgba(120,180,255,.9) 0%, rgba(80,140,255,.2) 60%, transparent 100%);
    filter: blur(6px); animation: lightSway 4s ease-in-out infinite alternate;
  }
  .stage-lights::before { left: 25%; transform-origin: top center; transform: rotate(-12deg); }
  .stage-lights::after  { right: 25%; transform-origin: top center; transform: rotate(12deg); animation-delay: -2s; }
  @keyframes lightSway { from { opacity: .6; } to { opacity: 1; } }
  .stage-band {
    position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);
    width: min(700px, 90vw); height: 70%;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 700 300'%3E%3Cellipse cx='120' cy='250' rx='30' ry='50' fill='%23050510'/%3E%3Crect x='100' y='100' width='40' height='150' rx='5' fill='%23060611'/%3E%3Cellipse cx='120' cy='95' rx='22' ry='22' fill='%23060611'/%3E%3Crect x='105' y='160' width='30' height='8' rx='2' fill='%23040410' transform='rotate(-25 105 160)'/%3E%3Cellipse cx='230' cy='260' rx='30' ry='40' fill='%23050510'/%3E%3Crect x='212' y='120' width='38' height='140' rx='5' fill='%23060611'/%3E%3Cellipse cx='230' cy='115' rx='22' ry='22' fill='%23060611'/%3E%3Crect x='215' y='155' width='32' height='8' rx='2' fill='%23040410' transform='rotate(20 215 155)'/%3E%3Cellipse cx='350' cy='265' rx='35' ry='35' fill='%23050510'/%3E%3Crect x='330' y='115' width='42' height='150' rx='5' fill='%23060611'/%3E%3Cellipse cx='350' cy='108' rx='24' ry='24' fill='%23060611'/%3E%3Crect x='320' y='200' width='60' height='45' rx='3' fill='%23040410'/%3E%3Cellipse cx='470' cy='255' rx='30' ry='45' fill='%23050510'/%3E%3Crect x='452' y='105' width='38' height='150' rx='5' fill='%23060611'/%3E%3Cellipse cx='470' cy='98' rx='22' ry='22' fill='%23060611'/%3E%3Crect x='455' y='150' width='32' height='8' rx='2' fill='%23040410' transform='rotate(-20 455 150)'/%3E%3Cellipse cx='580' cy='250' rx='30' ry='50' fill='%23050510'/%3E%3Crect x='562' y='100' width='40' height='150' rx='5' fill='%23060611'/%3E%3Cellipse cx='580' cy='95' rx='22' ry='22' fill='%23060611'/%3E%3Crect x='565' y='160' width='30' height='8' rx='2' fill='%23040410' transform='rotate(25 565 160)'/%3E%3C/svg%3E") center bottom / contain no-repeat;
    filter: drop-shadow(0 0 30px rgba(50,100,255,.3));
  }
  .stage-logo { position: relative; z-index: 5; text-align: center; margin-bottom: 8rem; }
  .stage-logo .skull-sm { font-size: 2.5rem; display: block; filter: drop-shadow(0 0 12px rgba(100,180,255,.8)); }
  .stage-logo h2 {
    font-family: 'Metal Mania', cursive; font-size: clamp(1.8rem, 5vw, 3.5rem);
    text-shadow: 0 0 20px rgba(100,180,255,.6); line-height: .9;
  }
  .stage-logo h2 span { color: #6ab4ff; }

  /* ── BOOKING BANNER ── */
  .booking-banner {
    background: var(--dark); text-align: center; padding: 3.5rem 1rem;
    border-top: 1px solid #222;
  }
  .booking-banner h2 {
    font-family: 'Oswald', sans-serif; font-size: clamp(1.5rem, 4vw, 2.5rem);
    font-weight: 600; letter-spacing: .15em; text-transform: uppercase;
  }

  /* ── SHOWS ── */
  .shows { padding: 1rem 2rem 3rem; max-width: 960px; margin: 0 auto; }
  .shows h3 {
    font-family: 'Oswald', sans-serif; font-size: 1.2rem; letter-spacing: .2em;
    text-transform: uppercase; border-bottom: 2px solid var(--red);
    padding-bottom: .5rem; margin-bottom: 1.2rem; display: inline-block;
  }
  .show-row {
    display: grid;
    grid-template-columns: 1.2fr 1fr auto auto auto 30px;
    gap: .5rem 1.5rem; align-items: center;
    padding: .9rem 0; border-bottom: 1px solid #1f1f1f; font-size: .9rem;
    cursor: pointer;
  }
  .show-row:hover { background: rgba(255,255,255,.02); }
  .show-venue { font-weight: 500; color: var(--white); }
  .show-venue:hover{ color: white; }
  .show-date  { color: var(--text-gray); font-size: .85rem; }
  .show-date-link {
    color: inherit;
    font: inherit;
    background: none;
    border: 0;
    padding: 0;
    cursor: pointer;
    text-decoration: underline;
    text-decoration-color: rgba(240, 238, 232, .35);
    text-underline-offset: .18em;
    transition: color .2s ease, text-decoration-color .2s ease;
  }
  .show-date-link:hover,
  .show-date-link:focus-visible {
    color: var(--white);
    text-decoration-color: var(--red);
    outline: none;
    background-color: transparent;
  }
  .show-time  { color: var(--text-gray); font-size: .85rem; white-space: nowrap; }
  .show-price { color: var(--text-gray); font-size: .8rem; white-space: nowrap; }
  .btn-ticket {
    background: var(--red); color: #fff; border: none;
    padding: .45rem 1.1rem; font-family: 'Oswald', sans-serif;
    font-size: .8rem; letter-spacing: .1em; text-transform: uppercase;
    cursor: pointer; transition: background .2s, transform .1s;
    white-space: nowrap; clip-path: polygon(6px 0%, 100% 0%, calc(100% - 6px) 100%, 0% 100%);
    text-decoration: none; display: inline-block; line-height: 1.8;
  }
  .btn-ticket:hover { background: #e01a1a; transform: scale(1.03); color: #fff; }
  .no-shows { color: var(--text-gray); font-size: .9rem; padding: 1rem 0; }
  .show-lightbox {
    position: fixed;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    background: rgba(0, 0, 0, .82);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity .2s ease, visibility .2s ease;
    z-index: 9999;
  }
  .show-lightbox.is-open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }
  .show-lightbox-dialog {
    position: relative;
    width: min(92vw, 960px);
    max-height: 92vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .show-lightbox-image {
    display: block;
    max-width: 100%;
    max-height: 92vh;
    border: 1px solid rgba(255,255,255,.14);
    box-shadow: 0 22px 60px rgba(0,0,0,.45);
  }
  .show-lightbox-close {
    position: absolute;
    top: -14px;
    right: -14px;
    width: 40px;
    height: 40px;
    border: 0;
    border-radius: 999px;
    background: var(--red);
    color: #fff;
    font-size: 1.5rem;
    line-height: 1;
    cursor: pointer;
    box-shadow: 0 10px 24px rgba(0,0,0,.35);
  }

  /* ── SHOW ACCORDION & VOTING ── */
  .show-chevron {
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-gray);
    transition: color .2s;
  }
  .show-row:hover .show-chevron {
    color: var(--white);
  }
  .show-voting-dropdown {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.3s ease-in-out;
    overflow: hidden;
    background: #121212;
  }
  .show-item.is-open .show-voting-dropdown {
    grid-template-rows: 1fr;
    border-bottom: 2px solid var(--red-dark);
  }
  .show-voting-content {
    min-height: 0;
  }
  .show-voting-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  .show-voting-left {
    background: linear-gradient(135deg, #1a0303 0%, #2c0808 100%);
    padding: 2.5rem 2rem; display: flex; flex-direction: column; gap: 1.2rem;
  }
  .show-voting-right {
    background: linear-gradient(135deg, #200404 0%, #370a0a 100%);
    padding: 2.5rem 2rem; display: flex; flex-direction: column; gap: 1rem;
    border-left: 1px solid rgba(255,255,255,0.05);
  }
  .show-voting-right h4 {
    font-family: 'Oswald', sans-serif; font-size: 1.5rem; font-weight: 700;
    letter-spacing: .2em; text-transform: uppercase; text-align: center; margin-bottom: .5rem;
  }
  .show-voting-left h3 {
    font-family: 'Oswald', sans-serif; font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700; text-transform: uppercase;
  }
  .show-voting-left p { font-size: .9rem; color: #e0b0b0; line-height: 1.6; }
  .show-voting-left h5 {
    font-family: 'Oswald', sans-serif; font-size: 1rem;
    letter-spacing: .1em; text-transform: uppercase; margin-top: .5rem;
  }

  .vote-input {
    background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15);
    color: #fff; padding: .75rem 1rem; width: 100%;
    font-size: .95rem; font-family: 'Barlow', sans-serif;
    outline: none; transition: border-color .2s;
  }
  .vote-input:focus { border-color: var(--red); }
  .btn-submit {
    margin-top: 15px !important;
    background: var(--red); color: #fff; border: none;
    padding: .75rem 2rem; font-family: 'Oswald', sans-serif;
    font-size: 1rem; letter-spacing: .15em; text-transform: uppercase;
    cursor: pointer; transition: background .2s, transform .1s; align-self: flex-start;
  }
  .btn-submit:hover { background: #e01a1a; transform: scale(1.02); }
  .btn-submit:disabled { background: #555; cursor: not-allowed; transform: none; }
  .btn-submit.full { align-self: stretch; }
  .song-option {
    display: flex; align-items: center; gap: .8rem;
    padding: .5rem 0; font-size: .9rem; cursor: pointer; transition: color .2s;
  }
  .song-option:hover { color: #f88; }
  .song-option input[type=checkbox] { display: none; }
  .song-option.disabled { opacity: .35; pointer-events: none; }
  .check-dot {
    width: 16px; height: 16px; border: 2px solid rgba(255,255,255,.3);
    border-radius: 3px; flex-shrink: 0; position: relative; transition: border-color .2s, background .2s;
  }
  .song-option:hover .check-dot { border-color: var(--red); }
  .song-option input:checked + .check-dot { border-color: var(--red); background: var(--red); }
  .encore-msg {
    padding: .6rem 1rem; font-size: .85rem; border-radius: 4px; margin-top: .3rem;
  }
  .encore-msg.success { background: rgba(21,90,21,.4); border: 1px solid #2a7a2a; color: #8f8; }
  .encore-msg.error   { background: rgba(140,20,20,.4); border: 1px solid #8b0000; color: #f88; }
  
  /* Vote results */
  .vote-results { display: flex; flex-direction: column; gap: .6rem; margin-top: .5rem; }
  .vote-bar-row { display: flex; flex-direction: column; gap: .2rem; }
  .vote-bar-label {
    display: flex; justify-content: space-between; font-size: .8rem; color: #ddd;
  }
  .vote-bar-track {
    height: 22px; background: rgba(255,255,255,.08); border-radius: 3px; overflow: hidden;
    position: relative;
  }
  .vote-bar-fill {
    height: 100%; background: linear-gradient(90deg, var(--red-dark), var(--red));
    border-radius: 3px; transition: width 1s ease; width: 0;
  }
  .vote-bar-pct {
    position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
    font-size: .7rem; font-weight: 600; color: #fff; text-shadow: 0 1px 3px rgba(0,0,0,.6);
  }
  .pick-counter {
    font-family: 'Oswald', sans-serif; font-size: .8rem; color: var(--text-gray);
    letter-spacing: .05em; text-align: center; margin-bottom: .3rem;
  }

  @media (max-width: 640px) {
    .show-row { 
      grid-template-columns: 1fr auto auto; 
      grid-template-rows: auto auto; 
      gap: .5rem 1rem;
    }
    .show-time, .show-price { display: none; }
    .show-venue { grid-column: 1; }
    .show-date  { grid-column: 1; }
    .btn-ticket { grid-column: 2; grid-row: 1 / 3; }
    .show-chevron { grid-column: 3; grid-row: 1 / 3; }
    .hero{min-height: 40vh;background-position: center;}
    .show-lightbox { padding: 1rem; }
    .show-lightbox-close {
      top: -10px;
      right: -10px;
      width: 36px;
      height: 36px;
    }
    .show-voting-grid {
      grid-template-columns: 1fr;
    }
    .show-voting-left, .show-voting-right {
      padding: 1.5rem 1rem;
    }
    .show-voting-right {
      border-left: none;
      border-top: 1px solid rgba(255,255,255,0.05);
    }
  }

  .show-venue:hover{
    color: white;
  }

</style>

<?php
/* ================================================================
   HERO
   ACF fields (on this page):
     hero_logo  — image          
     hero_background      — image         
   ================================================================ */

$hero_subtitle = mm_field( 'hero_subtitle', 'The Iron Maiden Experience' );

// Comma-separated tags → array
$hero_logo  = mm_field( 'hero_logo' );
$hero_background = mm_field( 'hero_background' );
?>

<!-- HERO -->
<section class="hero" id="band" style="background-image: url('<?php echo esc_url( $hero_background['url'] ); ?>');">
  <div class="hero-logo-wrap">
    <?php if($hero_logo) : ?>
    <img width="500" src="<?php echo esc_url( $hero_logo['url'] ); ?>" alt="<?php echo esc_attr( $hero_logo['alt'] ); ?>">
    <?php endif; ?>
  </div>
</section>

<?php
/* ================================================================
   ABOUT
   ACF field: about_text — Wysiwyg or Textarea
   ================================================================ */
$about_default = '<strong>MÖSTLY MAIDEN</strong> delivers an AMAZING set of your favorite Iron Maiden songs. All Killer No Filler! Experience a real live production complete with incredible sound and visuals. Engage with the band by picking each show\'s encore. Vote for your favorite Classic and New Wave of British Heavy Metal songs — we deliver the goods!';
$about_text = mm_field( 'about_text', $about_default );
?>

<!-- ABOUT -->
<section class="about">
  <p><?php echo wp_kses_post( $about_text ); ?></p>
</section>

<!-- STAGE VISUAL -->
<section class="stage" id="epk">
  <?php
  $stage_visual = mm_field( 'stage_visual' );
  ?>
  <img style="width: 100%;" src="<?php echo esc_url( $stage_visual['url'] ); ?>" alt="<?php echo esc_attr( $stage_visual['alt'] ); ?>">
</section>

<?php
/* ================================================================
   BOOKING BANNER
   ACF field: booking_banner_text — Text
   ================================================================ */
$booking_text = mm_field( 'booking_banner_text', 'Now Booking Fall/Winter 2026' );
?>

<!-- BOOKING BANNER -->
<div class="booking-banner">
  <h2><?php echo esc_html( $booking_text ); ?></h2>
</div>

<?php
/* ================================================================
   SHOWS
   Source: CPT "mm_show"
     Post Title   = Venue name (e.g. "The Vault, New Bedford, MA")
     ACF fields set on mm_show posts:
       show_date        — Text  e.g. "Saturday, July 17, 2026"
       show_time        — Text  e.g. "9:00 PM"
       show_price       — Text  e.g. "$15/Advance &nbsp; $20/Door"
       show_ticket_url  — URL   (leave blank for no link)
   Order: by menu_order ASC so you can drag-sort in the admin.
   ================================================================ */

$shows_query = new WP_Query( [
    'post_type'      => 'mm_show',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

// Static fallback rows shown before any CPT posts exist
$default_shows = [
    [ 'venue' => 'The Vault, New Bedford, MA',     'date' => 'Saturday, July 17, 2026',      'time' => '9:00 PM', 'price' => '$15/Advance &nbsp; $20/Door', 'url' => '' ],
];
?>


<!-- SHOWS -->
<section class="shows" id="shows">
  <h3>Shows</h3>

  <?php if ( $shows_query->have_posts() ) : ?>

    <?php while ( $shows_query->have_posts() ) : $shows_query->the_post(); ?>
      <?php
        $show_id     = get_the_ID();
        $show_venue  = get_the_title();
        $show_date   = function_exists('get_field') ? get_field('show_date')       : '';
        $show_time   = function_exists('get_field') ? get_field('show_time')       : '';
        $show_price  = function_exists('get_field') ? get_field('show_price')      : '';
        $show_url    = function_exists('get_field') ? get_field('show_ticket_url') : '';

        // Fetch show-specific voting fields
        $encore_title       = function_exists('get_field') ? get_field('encore_title', $show_id) : '';
        $encore_description = function_exists('get_field') ? get_field('encore_description', $show_id) : '';
        $submit_song_label  = function_exists('get_field') ? get_field('submit_song_label', $show_id) : '';
        $raw_songs          = function_exists('get_field') ? get_field('song_options', $show_id) : '';

        // Fallbacks
        if ( ! $encore_title ) $encore_title = 'You pick the Encore!';
        if ( ! $encore_description ) {
            $encore_description = "That's right — pick the 3 songs you want to hear as tonight's encore. We'll play the top choices as selected by you!\n\nVote as many times as you like and feel free to suggest a song that you want to hear next time!";
        }
        if ( ! $submit_song_label ) $submit_song_label = 'Submit your Song';
        if ( ! $raw_songs ) {
            $raw_songs = "Hellion/Electric Eye – Judas Priest\nChildren of the Grave – Black Sabbath\nKilled by Death – Motörhead\nLet it Go – Def Leppard\nDoctor Doctor – UFO\nLooks That Kill – Mötley Crüe\nRocket Queen – Guns & Roses";
        }

        $songs = array_filter( array_map( 'trim', explode( "\n", $raw_songs ) ) );
        $desc_paragraphs = array_filter( array_map( 'trim', preg_split( '/\n{2,}/', $encore_description ) ) );
      ?>
      <div class="show-item" data-show-id="<?php echo esc_attr( $show_id ); ?>">
        <div class="show-row">
          <a href="https://www.magicroomnorwood.com/" target="_blank" class="show-venue"><?php echo esc_html( $show_venue ); ?></a>
          <div class="show-date">
            <button class="show-date-link" type="button" data-show-lightbox-trigger>
              <?php echo esc_html( $show_date ); ?>
            </button>
          </div>
          <div class="show-time"><?php echo esc_html( $show_time ); ?></div>
          <div class="show-price"><?php echo wp_kses_post( $show_price ); ?></div>
          <?php if ( $show_url ) : ?>
            <a class="btn-ticket" href="<?php echo esc_url( $show_url ); ?>" target="_blank" rel="noopener">Tickets</a>
          <?php else : ?>
            <button class="btn-ticket" type="button">Tickets</button>
          <?php endif; ?>
          <div class="show-chevron">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron-icon" style="width: 16px; height: 16px; transition: transform 0.2s;"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
        </div>

        <div class="show-voting-dropdown">
          <div class="show-voting-content">
            <div class="show-voting-grid">
              <!-- Left: Submit Song -->
              <div class="show-voting-left">
                <h3><?php echo esc_html( $encore_title ); ?></h3>
                <?php foreach ( $desc_paragraphs as $para ) : ?>
                  <p><?php echo esc_html( $para ); ?></p>
                <?php endforeach; ?>
                <h5><?php echo esc_html( $submit_song_label ); ?></h5>
                <form class="mm-song-form" autocomplete="off">
                  <input class="vote-input" type="text" name="song" placeholder="Enter a song or artist…" required>
                  <button class="btn-submit" type="submit">Submit</button>
                  <div class="song-msg"></div>
                </form>
              </div>

              <!-- Right: Pick 3 -->
              <div class="show-voting-right">
                <h4 class="mm-vote-title">Pick 3</h4>
                <form class="mm-vote-form">
                  <div class="pick-counter">Selected: <span class="pick-count">0</span> / 3</div>
                  <?php foreach ( $songs as $i => $song ) : ?>
                  <label class="song-option">
                    <input type="checkbox" name="songs[]" value="<?php echo esc_attr( $song ); ?>">
                    <span class="check-dot"></span>
                    <?php echo esc_html( $song ); ?>
                  </label>
                  <?php endforeach; ?>
                  <button class="btn-submit full" type="submit" style="margin-top:auto;">Submit Vote</button>
                  <div class="vote-msg"></div>
                </form>
                <div class="mm-vote-results vote-results" style="display:none;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>

  <?php else : ?>

    <!-- No CPT posts yet — show static fallback data -->
    <?php foreach ( $default_shows as $show ) : ?>
    <div class="show-row">
      <div class="show-venue"><?php echo esc_html( $show['venue'] ); ?></div>
      <div class="show-date">
        <button class="show-date-link" type="button" data-show-lightbox-trigger>
          <?php echo esc_html( $show['date'] ); ?>
        </button>
      </div>
      <div class="show-time"><?php echo esc_html( $show['time'] ); ?></div>
      <div class="show-price"><?php echo wp_kses_post( $show['price'] ); ?></div>
      <?php if ( $show['url'] ) : ?>
        <a class="btn-ticket" href="<?php echo esc_url( $show['url'] ); ?>" target="_blank" rel="noopener">Tickets</a>
      <?php else : ?>
        <button class="btn-ticket" type="button">Tickets</button>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>

  <?php endif; ?>
</section>

<div class="show-lightbox" id="show-lightbox" aria-hidden="true">
  <div class="show-lightbox-dialog" role="dialog" aria-modal="true" aria-label="Show poster">
    <button class="show-lightbox-close" type="button" aria-label="Close lightbox">&times;</button>
    <img
      class="show-lightbox-image"
      src="http://mostlymaiden.com/wp-content/uploads/2026/04/hardbox.png"
      alt="Show poster"
      loading="lazy"
    />
  </div>
</div>


<?php
/* ================================================================
   REQUEST A SHOW
   ACF fields (on this page):
     request_title    — Text
     request_subtitle — Text
   Source: CPT "mm_venue"
     Post Title   = Venue display name (e.g. "The Vault")
     ACF fields set on mm_venue posts:
       venue_location   — Text        e.g. "New Bedford, MA"
       venue_logo_text  — Textarea    e.g. "THE\nVAULT" (newline = line break in logo)
       venue_dark       — True/False  checked = dark logo box style
   ================================================================ */

$request_title    = mm_field( 'request_title',    'Request a show near you!' );
$request_subtitle = mm_field( 'request_subtitle', 'Click on the venue below to request a show' );


$venues_query = new WP_Query( [
    'post_type'      => 'mm_venue',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

$default_venues = [
    [ 'name' => 'The Vault',  'location' => 'New Bedford MA',  'logo' => "THE\nVAULT",       'dark' => false ],
    [ 'name' => "Wally's",   'location' => 'Hampton, NH',      'logo' => "WALLY'S",          'dark' => false ],
    [ 'name' => 'Jewel',     'location' => 'Manchester, NH',   'logo' => "JEWEL\nNIGHTCLUB", 'dark' => true  ],
    [ 'name' => 'Angel City','location' => 'Manchester, NH',   'logo' => "Angel\nCity",      'dark' => true  ],
    [ 'name' => 'Taffeta',   'location' => 'Lowell, MA',       'logo' => 'TAFFETA',          'dark' => false ],
];
?>

<!-- REQUEST A SHOW -->
<section class="request">
  <h3><?php echo esc_html( $request_title ); ?></h3>
  <p><?php echo esc_html( $request_subtitle ); ?></p>
  <div class="venues-grid">

    <?php if ( $venues_query->have_posts() ) : ?>

      <?php while ( $venues_query->have_posts() ) : $venues_query->the_post(); ?>
        <?php
          $v_name     = get_the_title();
          $v_location = function_exists('get_field') ? get_field('venue_location')  : '';
          $venue_url = get_field('venue_url');
        ?>
        <a class="venue-card" href="<?php echo esc_url( $venue_url ); ?>" target="_blank" rel="noopener">
          <div class="venue-logo-box dark">
            <?php
            if ( has_post_thumbnail() ) :
                // Display the post thumbnail with 'thumbnail' size (default 150x150)
                the_post_thumbnail( 'full' ); 
            endif;
            ?>
          </div>
          <p class="venue-name"><?php echo esc_html( $v_name ); ?></p>
          <p class="venue-place"><?php echo esc_html( $v_location ); ?></p>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>

    <?php else : ?>

      <!-- No CPT posts yet — show static default venues -->
      <?php foreach ( $default_venues as $venue ) :
        $box_class = $venue['dark'] ? 'venue-logo-box dark' : 'venue-logo-box';
      ?>
      <div class="venue-card">
        <div class="<?php echo esc_attr( $box_class ); ?>">
          <div class="vl"><?php echo nl2br( esc_html( $venue['logo'] ) ); ?></div>
        </div>
        <div class="venue-name"><?php echo esc_html( $venue['name'] ); ?></div>
        <div class="venue-place"><?php echo esc_html( $venue['location'] ); ?></div>
      </div>
      <?php endforeach; ?>

    <?php endif; ?>

  </div>
</section>

<?php
/* ================================================================
   MERCH — Hidden (future WooCommerce integration)
   To enable: remove the comment wrappers below and build out
   the WooCommerce product query.
   ================================================================ */
/*
<section class="merch" id="merch">
  <h3>Merch</h3>
  <div class="merch-grid">
    <!-- WooCommerce product loop will go here -->
  </div>
</section>
*/
?>

<script>
  const MM_AJAX_URL = <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>;
  const MM_NONCE = <?php echo wp_json_encode( wp_create_nonce( 'mm_encore_nonce' ) ); ?>;

  // Animate show rows on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateX(0)';
      }
    });
  }, { threshold: .1 });

  document.querySelectorAll('.show-row').forEach((row, i) => {
    row.style.opacity = '0';
    row.style.transform = 'translateX(-20px)';
    row.style.transition = `opacity .5s ease ${i * .07}s, transform .5s ease ${i * .07}s`;
    observer.observe(row);
  });

  // Toggle dropdown panel
  document.querySelectorAll('.show-row').forEach(row => {
    row.addEventListener('click', (e) => {
      // Don't toggle if clicking links or buttons or lightbox triggers
      if (e.target.closest('a') || e.target.closest('button') || e.target.closest('[data-show-lightbox-trigger]')) {
        return;
      }
      const showItem = row.closest('.show-item');
      if (showItem) {
        showItem.classList.toggle('is-open');
      }
    });
  });

  /* ── reCAPTCHA v3 helper ── */
  const RECAPTCHA_SITE_KEY = '6LeFcHEsAAAAACqVvFAs0AKICs_9EKp3v_vbzTPi';
  function getRecaptchaToken(action) {
    return grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: action });
  }

  // Initialize per-show voting and song submission logic
  document.querySelectorAll('.show-item').forEach(showItem => {
    const showId = showItem.dataset.showId;
    const songForm = showItem.querySelector('.mm-song-form');
    const voteForm = showItem.querySelector('.mm-vote-form');
    const voteTitle = showItem.querySelector('.mm-vote-title');
    const pickCount = showItem.querySelector('.pick-count');
    const checkboxes = voteForm ? voteForm.querySelectorAll('input[type=checkbox][name="songs[]"]') : [];
    const voteResults = showItem.querySelector('.mm-vote-results');

    // Handle check limit (up to 3)
    if (voteForm) {
      checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
          const checked = voteForm.querySelectorAll('input[type=checkbox][name="songs[]"]:checked');
          if (pickCount) pickCount.textContent = checked.length;
          checkboxes.forEach(c => {
            const label = c.closest('.song-option');
            if (!c.checked && checked.length >= 3) {
              label.classList.add('disabled');
            } else {
              label.classList.remove('disabled');
            }
          });
        });
      });
    }

    // Helper to hide form
    function hideVoteForm() {
      if (voteForm) voteForm.style.display = 'none';
      if (voteTitle) voteTitle.style.display = 'none';
    }

    // Helper to show msg
    function showMsg(el, text, type) {
      el.innerHTML = '<div class="encore-msg ' + type + '">' + text + '</div>';
    }

    // Helper to render results
    function renderResults(results) {
      if (!voteResults) return;
      let html = '<h4 style="margin-bottom:.5rem;">Current Results</h4>';
      for (const [song, data] of Object.entries(results)) {
        html += `<div class="vote-bar-row">
          <div class="vote-bar-label"><span>${escHtml(song)}</span><span>${data.votes} vote${data.votes!==1?'s':''}</span></div>
          <div class="vote-bar-track">
            <div class="vote-bar-fill" data-pct="${data.percent}"></div>
            <span class="vote-bar-pct">${data.percent}%</span>
          </div>
        </div>`;
      }
      voteResults.innerHTML = html;
      voteResults.style.display = 'flex';
      // Animate bars
      requestAnimationFrame(() => {
        voteResults.querySelectorAll('.vote-bar-fill').forEach(bar => {
          bar.style.width = bar.dataset.pct + '%';
        });
      });
    }

    function escHtml(str) {
      const d = document.createElement('div');
      d.textContent = str;
      return d.innerHTML;
    }

    // Check localStorage
    const hasVoted = localStorage.getItem('mm_voted_' + showId);
    if (hasVoted) {
      hideVoteForm();
      const cachedResults = localStorage.getItem('mm_vote_results_' + showId);
      if (cachedResults) {
        try {
          renderResults(JSON.parse(cachedResults));
        } catch (_) {}
      }
      loadResults();
    }

    function loadResults() {
      fetch(MM_AJAX_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'mm_get_results', show_id: showId })
      })
      .then(r => r.json())
      .then(res => {
        if (res.success && res.data.results && Object.keys(res.data.results).length > 0) {
          renderResults(res.data.results);
        }
      })
      .catch(() => {});
    }

    // Submit Song Form
    if (songForm) {
      songForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn     = songForm.querySelector('.btn-submit');
        const msgDiv  = showItem.querySelector('.song-msg');
        const songVal = songForm.querySelector('input[name=song]').value.trim();

        if (!msgDiv) return;
        msgDiv.innerHTML = '';
        if (!songVal) { showMsg(msgDiv, 'Please enter a song name.', 'error'); return; }

        btn.disabled = true;
        btn.textContent = 'Submitting…';

        getRecaptchaToken('submit_song').then(token => {
          return fetch(MM_AJAX_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
              action: 'mm_submit_song',
              nonce: MM_NONCE,
              recaptcha: token,
              song: songVal,
              show_id: showId
            })
          });
        })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            showMsg(msgDiv, res.data.message, 'success');
            songForm.querySelector('input[name=song]').value = '';
          } else {
            showMsg(msgDiv, res.data.message || 'Submission failed.', 'error');
          }
          btn.disabled = false;
          btn.textContent = 'Submit';
        })
        .catch(() => {
          showMsg(msgDiv, 'Network error. Please try again.', 'error');
          btn.disabled = false;
          btn.textContent = 'Submit';
        });
      });
    }

    // Submit Vote Form
    if (voteForm) {
      voteForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (localStorage.getItem('mm_voted_' + showId)) {
          showMsg(showItem.querySelector('.vote-msg'), 'You have already voted for this show!', 'error');
          return;
        }
        const btn    = voteForm.querySelector('.btn-submit');
        const msgDiv = showItem.querySelector('.vote-msg');
        const checked = voteForm.querySelectorAll('input[type=checkbox][name="songs[]"]:checked');
        const songs  = Array.from(checked).map(c => c.value);

        if (!msgDiv) return;
        msgDiv.innerHTML = '';
        if (songs.length === 0) { showMsg(msgDiv, 'Please select at least one song.', 'error'); return; }

        btn.disabled = true;
        btn.textContent = 'Submitting…';

        getRecaptchaToken('submit_vote').then(token => {
          const params = new URLSearchParams();
          params.append('action', 'mm_submit_votes');
          params.append('nonce', MM_NONCE);
          params.append('recaptcha', token);
          params.append('show_id', showId);
          songs.forEach(s => params.append('songs[]', s));

          return fetch(MM_AJAX_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params
          });
        })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            showMsg(msgDiv, res.data.message, 'success');
            renderResults(res.data.results);
            localStorage.setItem('mm_voted_' + showId, '1');
            localStorage.setItem('mm_vote_results_' + showId, JSON.stringify(res.data.results || {}));
            hideVoteForm();
          } else {
            showMsg(msgDiv, res.data.message || 'Vote failed.', 'error');
          }
          btn.disabled = false;
          btn.textContent = 'Submit Vote';
        })
        .catch(() => {
          showMsg(msgDiv, 'Network error. Please try again.', 'error');
          btn.disabled = false;
          btn.textContent = 'Submit Vote';
        });
      });
    }
  });

  const showLightbox = document.getElementById('show-lightbox');
  const showLightboxDialog = showLightbox ? showLightbox.querySelector('.show-lightbox-dialog') : null;
  const showLightboxClose = showLightbox ? showLightbox.querySelector('.show-lightbox-close') : null;
  const showLightboxTriggers = document.querySelectorAll('[data-show-lightbox-trigger]');

  function openShowLightbox() {
    if (!showLightbox) return;
    showLightbox.classList.add('is-open');
    showLightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeShowLightbox() {
    if (!showLightbox) return;
    showLightbox.classList.remove('is-open');
    showLightbox.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  showLightboxTriggers.forEach(trigger => {
    trigger.addEventListener('click', openShowLightbox);
  });

  if (showLightboxClose) {
    showLightboxClose.addEventListener('click', closeShowLightbox);
  }

  if (showLightbox) {
    showLightbox.addEventListener('click', event => {
      if (!showLightboxDialog || !showLightboxDialog.contains(event.target)) {
        closeShowLightbox();
      }
    });
  }

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && showLightbox && showLightbox.classList.contains('is-open')) {
      closeShowLightbox();
    }
  });
</script>

<?php get_footer(); ?>
