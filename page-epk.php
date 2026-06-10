<?php
/**
 * Template Name: EPK
 * Template Post Type: page
 */
get_header();
?>
  <style>
    :root {
      --page-bg: #e3e3e3;
      --black: #000000;
      --white: #ffffff;
      --text: #1b1b1b;
      --muted: #2a2a2a;
      --content-width: 1260px;
      --right-col: 340px;
      --left-col: 840px;
      --col-gap: 80px;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      margin: 0;
      padding: 0;
      background: var(--page-bg);
      color: var(--text);
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      line-height: 1.15;
      font-weight: 400;
    }

    .epk-page {
      width: 100%;
      background: var(--page-bg);
    }

    .epk-hero {
      width: 100%;
      height: 100vh;
      position: relative;
      background: var(--black) url('http://mostlymaiden.com/wp-content/uploads/2026/03/band-photo-yellow.png') center top / cover no-repeat;
      overflow: hidden;
    }

    .epk-hero-overlay {
      position: absolute;
      inset: 0;
    }

    .epk-logo {
      position: absolute;
      top: 16px;
      left: 50%;
      transform: translateX(-50%);
      width: 220px;
      max-width: 60vw;
      z-index: 2;
    }

    .epk-logo img {
      display: block;
      width: 100%;
      height: auto;
    }

    .epk-title-bar {
      width: 100%;
      background: var(--black);
      text-align: center;
      padding: 15px 10px 17px;
    }

    .epk-title {
      margin: 0;
      color: var(--white);
      font-size: 42px;
      line-height: 1;
      font-weight: 500;
      letter-spacing: 0;
    }

    .epk-content-wrap {
      width: min(var(--content-width), calc(100% - 34px));
      margin: 0 auto;
      padding: 36px 0 40px;
      display: grid;
      grid-template-columns: minmax(0, var(--left-col)) minmax(0, var(--right-col));
      gap: var(--col-gap);
      align-items: start;
    }

    .epk-left p {
      margin: 0 0 22px;
      font-size: 16px;
      line-height: 1.2;
      color: var(--muted);
      font-weight: 400;
    }

    .epk-left p.small-gap {
      margin-bottom: 6px;
    }

    .epk-left p.tight {
      margin-bottom: 2px;
    }

    .epk-left h2 {
      margin: 0 0 4px;
      font-size: 16px;
      line-height: 1.2;
      font-weight: 700;
      color: var(--black);
      text-transform: uppercase;
      letter-spacing: 0;
    }

    .epk-left .spacer {
      height: 8px;
    }

    .epk-right {
      padding-top: 300px;
    display: flex;
    flex-direction: column;
      gap: 200px;
    }

    .epk-right figure {
      margin: 0;
      width: 100%;
      background: #1a1a1a;
    }

    .epk-right img {
      display: block;
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .image-gap-1 {
      margin-bottom: 173px;
    }

    .image-gap-2 {
      margin-bottom: 172px;
    }

    .image-gap-3 {
      margin-bottom: 188px;
    }

    .image-gap-4 {
      margin-bottom: 188px;
    }

    @media (max-width: 720px) {
      html,
      body {
        font-size: 18px;
      }

      .epk-hero {
        height: 250px;
      }

      .epk-title {
        font-size: 34px;
      }

      .epk-content-wrap {
        width: calc(100% - 24px);
        grid-template-columns: 1fr;
        gap: 22px;
      }

      .epk-left h2 {
        font-size: 22px;
        line-height: 1.2;
      }

      .epk-left p {
        font-size: 18px;
        line-height: 1.3;
        margin-bottom: 14px;
      }

      .epk-right {
        padding-top: 0;
      }

      .image-gap-1,
      .image-gap-2,
      .image-gap-3,
      .image-gap-4 {
        margin-bottom: 16px;
      }
    }
  </style>

<div class="epk-page">
  <header class="epk-hero">
    <div class="epk-hero-overlay"></div>
  </header>

  <section class="epk-title-bar">
    <h1 class="epk-title">EPK</h1>
  </section>

  <main class="epk-content-wrap">
    <section class="epk-left">
      <h2>MOSTLY MAIDEN</h2>
      <p>Boston's Premier Iron Maiden Tribute Experience</p>

      <h2>ARTIST NAME</h2>
      <p><b>MOSTLY MAIDEN</b></p>

      <h2>BASED IN</h2>
      <p>Boston, MA, Will travel 100 miles</p>

      <h2>BOOKING CONTACT</h2>
      <p class="tight">Email: <a href="mailto:band@mostlymaiden.com">band@mostlymaiden.com</a></p>
      <p class="tight">Phone: 781-462-6760</p>
      <p>Social: Facebook/mostlymaiden, www.mostlymaiden.com</p>

      <h2>BIO</h2>
      <p><b>MOSTLY MAIDEN</b> is Boston's premier tribute to Iron Maiden, delivering a fully live, no-tracks performance that captures the power, precision, and theatrical intensity of classic Maiden.</p>
      <p>Featuring dual-lead guitar harmonies, galloping bass, soaring vocals, and a thunderous rhythm section, the band recreates the authentic heavy metal experience fans demand. Their show is elevated by a 12' x 8' high-impact motion backdrop that enhances the music without relying on copyrighted character imagery.</p>
      <p>Interactive, high-energy, and unapologetically loud, <b>MOSTLY MAIDEN</b> gives audiences a true concert experience - complete with crowd-voted encores and an "All Killer No Filler" setlist.</p>
      <p>Up the Irons!</p>

      <h2>LINEUP</h2>
      <p class="tight">Rick Menduni - Vocals</p>
      <p class="tight">Matt Weiss - Guitar</p>
      <p class="tight">Gary Frey - Guitar</p>
      <p class="tight">Tom McNulty - Bass</p>
      <p>Jonathan Vandenberg - Drums</p>

      <p><b>MOSTLY MAIDEN</b>'s production includes a 12' x 8' motion video projection backdrop, delivering dynamic, high-energy visuals that amplify the performance.</p>

      <h2>WHAT SETS THE BAND APART IS AUDIENCE INTERACTION:</h2>
      <p class="tight">&bull; Fans vote on the encore at every show</p>
      <p class="tight">&bull; Audience members help shape the setlist</p>
      <p class="tight">&bull; Monthly free merch giveaways to social followers</p>
      <p class="tight">&bull; Direct fan engagement before and after performances</p>
      <p>&bull; The result is not just a tribute - it's an event.</p>

      <h2>LIVE PERFORMANCE EXPERIENCE</h2>
      <p class="tight">3 Years playing as D&Auml;&Auml;D and The Strip, Leveraging + 2000 FB followers</p>
      <p>All over MA, NH and ME.</p>

      <h2>PRODUCTION HIGHLIGHTS:</h2>
      <p class="tight">&bull; 100% Live Performance</p>
      <p class="tight">&bull; No Backing Tracks</p>
      <p class="tight">&bull; Dual Lead Guitar Harmonics</p>
      <p class="tight">&bull; 12' x 8' Motion Visual Backdrop</p>
      <p class="tight">&bull; Interactive Encore Voting</p>
      <p class="tight">&bull; High-Impact Sound System</p>
      <p>&bull; Crowd Engagement</p>

      <h2>SAMPLE SETLIST</h2>
      <p>Iron Maiden Classics:</p>
      <p class="tight">The Trooper</p>
      <p class="tight">Run to the Hills</p>
      <p class="tight">2 Minutes to Midnight</p>
      <p class="tight">Hallowed Be Thy Name</p>
      <p class="tight">Aces High</p>
      <p class="tight">Wasted Years</p>
      <p class="tight">Fear of the Dark</p>
      <p class="tight">The Number of the Beast</p>
      <p class="tight">Wrathchild</p>
      <p class="tight">Be Quick or Be Dead</p>
      <p>Many more</p>

      <p>Classic Hard Rock / Metal Additions:</p>
      <p class="tight">Judas Priest</p>
      <p class="tight">Dio</p>
      <p class="tight">Black Sabbath</p>
      <p class="tight">Motorhead</p>
      <p class="tight">UFO</p>
      <p class="tight">Def Leppard</p>
      <p>Many more</p>

      <p>(Encore selected live by audience vote)</p>

      <h2>TECHNICAL SPECIFICATIONS</h2>
      <p class="tight">Lineup: 5-Piece</p>
      <p class="tight">Performance Lengths: 120, 180 Minutes</p>
      <p class="tight">Stage Footprint: Minimum 20' wide recommended</p>
      <p class="tight">Projection Requirement: 12' x 8' rear screen support</p>
      <p class="tight">Power: Standard venue stage power</p>
      <p>Backline: All band equipment, projector, screen, PA available upon request.</p>

      <p>Stage plot and input list available upon request.</p>

      <h2>MARKET FIT</h2>
      <p>Ideal For:</p>
      <p class="tight">&bull; Regional Rock Venues</p>
      <p class="tight">&bull; Theaters</p>
      <p class="tight">&bull; Festivals</p>
      <p class="tight">&bull; Casinos</p>
      <p class="tight">&bull; Motorcycle Rallies</p>
      <p class="tight">&bull; Private Events</p>
      <p class="tight">&bull; Corporate Events</p>
      <p>&bull; Summer Outdoor Concert Series</p>

      <h2>WHY BOOK MOSTLY MAIDEN</h2>
      <p class="tight">✔ Authentic All-Live Performance</p>
      <p class="tight">✔ Built-In Iron Maiden Fan Base</p>
      <p class="tight">✔ Interactive Audience Format</p>
      <p class="tight">✔ Professional Production</p>
      <p class="tight">✔ High Visual Impact</p>
      <p class="tight">✔ Flexible Set Options</p>
      <p>✔ Strong Regional Draw (Boston Market)</p>

      <h2>BRAND NOTE</h2>
      <p><b>MOSTLY MAIDEN</b> does not use copyrighted Eddie imagery and maintains a fully compliant, original visual identity.</p>

      <h2>CALL TO ACTION</h2>
      <p>Bring arena-level metal energy to your stage.</p>
      <p>Booking Now for Summer 2026 and beyond</p>
      <p>Contact: <a href="mailto:band@mostlymaiden.com">band@mostlymaiden.com</a></p>
      <p>Up the Irons!</p>
    </section>

    <aside class="epk-right" aria-label="EPK photos">
      <figure class="image-gap-1">
        <img src="http://mostlymaiden.com/wp-content/uploads/2026/02/MM-Title.png" alt="Mostly Maiden EPK image 1" />
      </figure>
      <figure class="image-gap-2">
        <img src="http://mostlymaiden.com/wp-content/uploads/2026/02/EPK-2.png" alt="Mostly Maiden EPK image 2" />
      </figure>
      <figure class="image-gap-3">
        <img src="http://mostlymaiden.com/wp-content/uploads/2026/02/EPK-3.png" alt="Mostly Maiden EPK image 3" />
      </figure>
      <figure class="image-gap-4">
        <img src="http://mostlymaiden.com/wp-content/uploads/2026/02/EPK-1.png" alt="Mostly Maiden EPK image 1" />
      </figure>
      <figure class="image-gap-5">
        <img src="http://mostlymaiden.com/wp-content/uploads/2026/02/EPK-4.png" alt="Mostly Maiden EPK image 4" />
      </figure>
      <figure class="image-gap-6">
        <img src="http://mostlymaiden.com/wp-content/uploads/2026/02/EPK-5.png" alt="Mostly Maiden EPK image 4" />
      </figure>
    </aside>
  </main>
</div>
<?php get_footer(); ?>
