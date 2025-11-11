<?php
/**
 * Template Name: Front Page
 * Description: Custom homepage layout for Sana Portfolio theme.
 */
get_header(); 
?>

<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                Hero Section
---------------------------------------------------------------
----------------------------------------------------------------
 -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title"><?php echo esc_html( get_theme_mod( 'sanaportfolio_hero_title', 'I’m Sana Ullah — a Creative Developer & Designer' ) ); ?></h1>
        <p class="hero-subtitle"><?php echo esc_html( get_theme_mod( 'sanaportfolio_hero_subtitle', 'I design and build modern web experiences that blend clarity, aesthetics, and performance.' ) ); ?></p>
        <a href="<?php echo esc_url( get_theme_mod( 'sanaportfolio_hero_btn_link', '#hero' ) ); ?>" class="hero-btn"><?php echo esc_html( get_theme_mod( 'sanaportfolio_hero_btn_text', 'View My Work' ) ); ?></a>
    </div>
</section>

<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                About Section
---------------------------------------------------------------
----------------------------------------------------------------
 -->

<section class="about-section fade-in">
    <div class="about-inner">
        <div class="about-content">
            <h2 class="about-title"><?php echo esc_html( get_theme_mod( 'sanaportfolio_about_title', 'Who We Are' ) ); ?></h2>
            <p class="about-desc">
              <?php echo esc_html( get_theme_mod( 'sanaportfolio_about_text', 'We are a creative agency passionate about crafting impactful digital experiences. 
                Our team combines design, strategy, and technology to help brands stand out and grow.' ) ); ?>
                
            </p>
            <a href="<?php echo esc_html( get_theme_mod( 'sanaportfolio_about_btn_link', '#about' ) ); ?>" class="btn-learn-more"><?php echo esc_html( get_theme_mod( 'sanaportfolio_about_btn_text', 'Learn More' ) ); ?></a>
        </div>

        <div class="about-image">
          <?php 
          $about_img= get_theme_mod( 'sanaportfolio_about_image');
          if($about_img): ?>
            <img src="<?php echo esc_url( $about_img ); ?>" alt="About Us">
            <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us.jpg" alt="About Us">
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- <?php //get_footer(); ?> -->

<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                HTML CSS Test Section
---------------------------------------------------------------
----------------------------------------------------------------
 -->




<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                Services Section static v1 commented 3 Nov 2025
---------------------------------------------------------------
----------------------------------------------------------------
 -->

<!-- <section class="services-section fade-in" id="services">
  <div class="container">
    <h2 class="section-title">What I Do</h2>
    <div class="services-grid">

      <div class="service-box">
        <div class="icon">💻</div>
        <h3>Web Development</h3>
        <p>I build fast, modern, and SEO-optimized WordPress websites that look great on every device.</p>
      </div>

      <div class="service-box">
        <div class="icon">🎨</div>
        <h3>UI/UX Design</h3>
        <p>I create clean and minimal user interfaces focused on usability and aesthetic balance.</p>
      </div>

      <div class="service-box">
        <div class="icon">⚙️</div>
        <h3>Custom Theme Development</h3>
        <p>From concept to code — I develop bespoke WordPress themes that are lightweight and scalable.</p>
      </div>

    </div>
  </div>
</section> -->

<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                Services Section (Dynamic + Smart Fallback)
---------------------------------------------------------------
----------------------------------------------------------------
-->
<section class="services-section fade-in" id="services">
  <div class="container">
    <h2 class="section-title">
      <?php echo esc_html( get_theme_mod( 'sanaportfolio_services_title', 'What I Do' ) ); ?>
    </h2>

    <div class="services-grid">
      <?php
      $services_count = get_theme_mod( 'sanaportfolio_services_count', 3 );
      // 1️⃣ Query dynamic services
      $services_query = new WP_Query([
        'post_type'      => 'service',
        'posts_per_page' => $services_count, // always fetch up to 3 for now
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'ASC',
      ]);

      // 2️⃣ Collect dynamic services into array
      $services_data = [];

      if ( $services_query->have_posts() ) :
        while ( $services_query->have_posts() ) :
          $services_query->the_post();
          $services_data[] = [
            'icon'    => get_post_meta( get_the_ID(), '_service_icon', true ),
            'title'   => get_the_title(),
            'content' => wp_trim_words( get_the_content(), 25, '...' ),
          ];
        endwhile;
        wp_reset_postdata();
      endif;

      // 3️⃣ Define fallback demo services
      $demo_services = [
        [
          'icon'    => '💻',
          'title'   => 'Web Development',
          'content' => 'I build fast, modern, and SEO-optimized WordPress websites that look great on every device.',
        ],
        [
          'icon'    => '🎨',
          'title'   => 'UI/UX Design',
          'content' => 'I create clean and minimal user interfaces focused on usability and aesthetic balance.',
        ],
        [
          'icon'    => '⚙️',
          'title'   => 'Custom Theme Development',
          'content' => 'From concept to code — I develop bespoke WordPress themes that are lightweight and scalable.',
        ],
      ];

      // 4️⃣ Merge user posts + fallback until total = 3
      $final_services = array_slice( array_merge( $services_data, $demo_services ), 0, max(3, $services_count) );

      // 5️⃣ Output final services
      foreach ( $final_services as $service ) :
      ?>
        <div class="service-box">
          <div class="icon"><?php echo esc_html( $service['icon'] ); ?></div>
          <h3><?php echo esc_html( $service['title'] ); ?></h3>
          <p><?php echo esc_html( $service['content'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- -----------------------------------------------------------
                Portfolio Section (dynamic + smart fallback)
--------------------------------------------------------------- -->
<section class="portfolio-section fade-in" id="portfolio">
  <div class="container">

    <h2 class="section-title">
      <?php echo esc_html( get_theme_mod( 'sanaportfolio_portfolio_title', 'My Work' ) ); ?>
    </h2>

    <div class="portfolio-grid">
      <?php
      // 1) Get user requested count from Customizer (default 3)
      $requested = intval( get_theme_mod( 'sanaportfolio_portfolio_count', 3 ) );
      if ( $requested < 1 ) $requested = 3; // safe fallback

      // 2) Determine target display count:
      // If user requested 1 or 2 => target = requested (respect user).
      // If user requested 3 or more => target = 3 (minimum visible items is 3).
      $target = ( $requested >= 3 ) ? 3 : $requested;

      // 3) Query up to $requested real portfolio posts
      $portfolio_query = new WP_Query( array(
          'post_type'      => 'portfolio',
          'posts_per_page' => $requested,
          'post_status'    => 'publish',
          'orderby'        => 'date',
          'order'          => 'DESC',
      ) );

      $real_items = array();

      if ( $portfolio_query->have_posts() ) {
          while ( $portfolio_query->have_posts() ) {
              $portfolio_query->the_post();

              $real_items[] = array(
                  'title'   => get_the_title(),
                  'content' => wp_trim_words( get_the_content(), 18, '...' ),
                  'img'     => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : '',
                  'link'    => get_permalink(),
              );
          }
          wp_reset_postdata();
      }

      $real_count = count( $real_items );

      // 4) Demo/fallback items (used only to fill slots)
      $fallbacks = array(
          array(
              'title' => 'Corporate Website',
              'desc'  => 'Modern WordPress site with custom theme.',
              'img'   => get_template_directory_uri() . '/assets/images/portfolio1.jpg',
          ),
          array(
              'title' => 'Brand Landing Page',
              'desc'  => 'High-converting design for digital products.',
              'img'   => get_template_directory_uri() . '/assets/images/portfolio2.jpg',
          ),
          array(
              'title' => 'E-Commerce Store',
              'desc'  => 'WooCommerce-based minimalist store layout.',
              'img'   => get_template_directory_uri() . '/assets/images/portfolio3.jpg',
          ),
      );

      // 5) Decide final output list:
      // - If there are >= $requested real items, show only the real items (limit respected).
      // - If there are fewer real items:
      //     * if $requested is 1 or 2: fill demos up to $requested
      //     * if $requested >= 3: fill demos up to $target (which equals 3)
      $final = $real_items;

      // Compute how many items we want to end up displaying:
      $desired_total = ( $requested >= 3 ) ? 3 : $requested;

      // Fill with fallback items (use next fallback entries, avoid duplicates)
      $i = 0;
      while ( count( $final ) < $desired_total && $i < count( $fallbacks ) ) {
          // pick fallback in order but skip ones that duplicate real titles (unlikely)
          $final[] = array(
              'title'   => $fallbacks[ $i ]['title'],
              'content' => $fallbacks[ $i ]['desc'],
              'img'     => $fallbacks[ $i ]['img'],
              'link'    => '#',
          );
          $i++;
      }

      // 6) Output
      foreach ( $final as $item ) : ?>
        <div class="portfolio-item">
          <?php if ( ! empty( $item['img'] ) ) : ?>
            <img src="<?php echo esc_url( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
          <?php endif; ?>
          <div class="overlay">
            <h3><?php echo esc_html( $item['title'] ); ?></h3>
            <p><?php echo esc_html( $item['content'] ); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                Testimonial Section
---------------------------------------------------------------
----------------------------------------------------------------
-->
<section class="testimonial-section fade-in" id="testimonials">
  <div class="container">
    <h2 class="section-title">
      <?php echo esc_html( get_theme_mod( 'sanaportfolio_testimonials_title', 'What Clients Say' ) ); ?>
    </h2>

    <div class="testimonial-grid">
      <?php
      // Get number of testimonials to display (from Customizer)
      $testimonials_count = get_theme_mod( 'sanaportfolio_testimonials_count', 3 );

      // Fetch published testimonial posts
      $testimonial_query = new WP_Query(array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $testimonials_count,
        'post_status'    => 'publish',
      ));

      $displayed = 0;

      if ( $testimonial_query->have_posts() ) :
        while ( $testimonial_query->have_posts() ) : $testimonial_query->the_post(); ?>
          
          <div class="testimonial-item">
            <p class="testimonial-text">"<?php echo esc_html( get_the_content() ); ?>"</p>
            <div class="testimonial-author">
              <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>" alt="<?php the_title_attribute(); ?>">
              <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client-placeholder.jpg" alt="Client">
              <?php endif; ?>
              <div>
                <h4><?php the_title(); ?></h4>
                <span>Client</span>
              </div>
            </div>
          </div>

        <?php 
        $displayed++;
        endwhile;
        wp_reset_postdata();
      endif;

      // === Fallback testimonials if fewer than $testimonials_count exist ===
      if ( $displayed < $testimonials_count ) :
        $fallbacks = array(
          array(
            'name' => 'Sarah Johnson',
            'text' => '“Jabran delivered beyond expectations! The website looks stunning and performs flawlessly.”',
            'img'  => get_template_directory_uri() . '/assets/images/client1.jpg',
            'role' => 'Startup Founder'
          ),
          array(
            'name' => 'Michael Smith',
            'text' => '“Professional, responsive, and highly skilled in front-end and WordPress development.”',
            'img'  => get_template_directory_uri() . '/assets/images/client2.jpg',
            'role' => 'Marketing Director'
          ),
          array(
            'name' => 'Emily Davis',
            'text' => '“His eye for design and attention to detail made all the difference in our project.”',
            'img'  => get_template_directory_uri() . '/assets/images/client3.jpg',
            'role' => 'Creative Manager'
          ),
        );

        for ( $i = $displayed; $i < $testimonials_count && $i < count( $fallbacks ); $i++ ) :
          $item = $fallbacks[$i]; ?>
          
          <div class="testimonial-item">
            <p class="testimonial-text"><?php echo esc_html( $item['text'] ); ?></p>
            <div class="testimonial-author">
              <img src="<?php echo esc_url( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
              <div>
                <h4><?php echo esc_html( $item['name'] ); ?></h4>
                <span><?php echo esc_html( $item['role'] ); ?></span>
              </div>
            </div>
          </div>

        <?php endfor;
      endif;
      ?>
    </div>
  </div>
</section>



<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                Blog Section (dynamic + fallback)
---------------------------------------------------------------
----------------------------------------------------------------
 -->

<section class="blog-section" id="blog">
  <div class="container">
    <h2 class="section-title">
      <?php echo esc_html( get_theme_mod( 'sanaportfolio_blog_title', 'Latest Articles' ) ); ?>
    </h2>

    <p class="section-subtitle">
      <?php echo esc_html( get_theme_mod( 'sanaportfolio_blog_subtitle', 'Insights, stories, and thoughts from our team' ) ); ?>
    </p>

    <div class="blog-grid">
      <?php
      // 1) Get user requested count (respect 1 or 2 as valid)
      $requested = intval( get_theme_mod( 'sanaportfolio_blog_count', 3 ) );
      if ( $requested < 1 ) $requested = 1;

      // 2) Query exactly $requested recent posts
      $blog_query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => $requested,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
      ) );

      $post_count = 0;
      $real_posts = array();

      if ( $blog_query->have_posts() ) :
        while ( $blog_query->have_posts() ) : $blog_query->the_post();
          $real_posts[] = array(
            'title'   => get_the_title(),
            'excerpt' => wp_trim_words( get_the_excerpt(), 18, '...' ),
            'img'     => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : '',
            'link'    => get_the_permalink(),
          );
          $post_count++;
        endwhile;
        wp_reset_postdata();
      endif;

      // 3) Fallback demo posts (only to fill missing slots)
      $fallbacks = array(
        array(
          'title' => 'Designing for the Future: Minimalism in 2025',
          'desc'  => 'Explore how simplicity is shaping modern web design trends this year.',
          'img'   => get_template_directory_uri() . '/assets/images/blog1.jpg',
        ),
        array(
          'title' => 'Why Branding Matters More Than Ever',
          'desc'  => 'Strong branding creates trust and helps your business stand out.',
          'img'   => get_template_directory_uri() . '/assets/images/blog2.jpg',
        ),
        array(
          'title' => '5 Secrets to High-Performing Websites',
          'desc'  => 'Learn how speed, design, and UX can turn visitors into customers.',
          'img'   => get_template_directory_uri() . '/assets/images/blog3.jpg',
        ),
      );

      // 4) Build final list: real posts first, then fallbacks until we reach $requested
      $final = $real_posts;
      $i = 0;
      // If not enough real posts, add fallbacks (looping fallback array if needed)
      while ( count( $final ) < $requested ) {
        $fallback_item = $fallbacks[ $i % count( $fallbacks ) ]; // wrap if requested > fallback count
        $final[] = array(
          'title'   => $fallback_item['title'],
          'excerpt' => $fallback_item['desc'],
          'img'     => $fallback_item['img'],
          'link'    => '#',
        );
        $i++;
      }

      // 5) Output exactly $requested items (order: real -> fallback)
      foreach ( $final as $post ) : ?>
        <div class="blog-card">
          <div class="blog-image">
            <?php if ( ! empty( $post['img'] ) ) : ?>
              <img src="<?php echo esc_url( $post['img'] ); ?>" alt="<?php echo esc_attr( $post['title'] ); ?>">
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-placeholder.jpg" alt="Placeholder">
            <?php endif; ?>
          </div>
          <div class="blog-content">
            <h3><?php echo esc_html( $post['title'] ); ?></h3>
            <p><?php echo esc_html( $post['excerpt'] ); ?></p>
            <a href="<?php echo esc_url( $post['link'] ); ?>" class="read-more">Read More →</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>





<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                Contact Section
---------------------------------------------------------------
----------------------------------------------------------------
 -->
<section class="contact-section">
  <div class="container contact-container">

    <div class="contact-info">
      <h2>Let’s Work Together</h2>
      <p>Have a project in mind or just want to say hello? I’d love to hear from you.</p>

      <ul class="contact-details">
        <li><strong>Phone:</strong> <?php echo esc_html( get_option('sanaportfolio_phone') ); ?></li>
        <li><strong>Email:</strong> <?php echo esc_html( get_option('sanaportfolio_email') ); ?></li>
        <li><strong>Address:</strong> <?php echo esc_html( get_option('sanaportfolio_address') ); ?></li>
      </ul>
    </div>

    <div class="contact-form">
      <h2>Send a Message</h2>
      <form action="#" method="post">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        <button type="submit" class="btn-send">Send Message</button>
      </form>
    </div>

  </div>
</section>

<!-- -----------------------------------------------------------
 ---------------------------------------------------------------
                CTA Section
---------------------------------------------------------------
----------------------------------------------------------------
 -->

 <!-- CTA Section -->
<section class="cta-section">
  <div class="cta-content">
    <h2>Let’s Build Something Amazing Together</h2>
    <p>Whether you need a custom website or a creative brand presence — let’s turn your ideas into reality.</p>
    <a href="#contact" class="cta-button">Get in Touch</a>
  </div>
</section>
<?php get_footer(); ?>
