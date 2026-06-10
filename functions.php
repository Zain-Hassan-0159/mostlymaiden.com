<?php
/**
 * Möstly Maiden – Child Theme Functions
 * Parent: Hello Elementor
 */

/* ──────────────────────────────────────────────
   0. Global settings (Customizer)
   ────────────────────────────────────────────── */
add_action( 'customize_register', function ( $wp_customize ) {
    $wp_customize->add_section( 'mm_footer_settings', [
        'title'    => 'Mostly Maiden Footer',
        'priority' => 160,
    ] );

    $wp_customize->add_setting( 'mm_footer_logo', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ] );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'mm_footer_logo',
        [
            'label'    => 'Footer Logo Image',
            'section'  => 'mm_footer_settings',
            'settings' => 'mm_footer_logo',
        ]
    ) );

    $wp_customize->add_setting( 'mm_footer_copyright', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ] );

    $wp_customize->add_control( 'mm_footer_copyright', [
        'type'        => 'textarea',
        'label'       => 'Footer Copyright',
        'section'     => 'mm_footer_settings',
        'settings'    => 'mm_footer_copyright',
        'description' => 'Displayed at the bottom of the global footer.',
    ] );
} );

// Disable WordPress emoji conversion so symbols like ✔ remain plain text.
add_action( 'init', function () {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'emoji_svg_url', '__return_false' );
} );

/* ──────────────────────────────────────────────
   1. Enqueue styles
   ────────────────────────────────────────────── */
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'hello-elementor',
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'hello-elementor-child',
        get_stylesheet_uri(),
        [ 'hello-elementor' ],
        wp_get_theme()->get( 'Version' )
    );
}, 20 );


/* ──────────────────────────────────────────────
   2. Custom Post Type: Shows (mm_show)
   ────────────────────────────────────────────── */
add_action( 'init', function () {
    register_post_type( 'mm_show', [
        'labels' => [
            'name'               => 'Shows',
            'singular_name'      => 'Show',
            'add_new'            => 'Add New Show',
            'add_new_item'       => 'Add New Show',
            'edit_item'          => 'Edit Show',
            'new_item'           => 'New Show',
            'view_item'          => 'View Show',
            'search_items'       => 'Search Shows',
            'not_found'          => 'No shows found',
            'not_found_in_trash' => 'No shows found in trash',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-tickets-alt',
        'hierarchical'  => false,
        'supports'      => [ 'title' ],   // Title = Venue Name
        'menu_position' => 5,
    ] );
} );


/* ──────────────────────────────────────────────
   3. Custom Post Type: Venues (mm_venue)
   ────────────────────────────────────────────── */
add_action( 'init', function () {
    register_post_type( 'mm_venue', [
        'labels' => [
            'name'               => 'Venues',
            'singular_name'      => 'Venue',
            'add_new'            => 'Add New Venue',
            'add_new_item'       => 'Add New Venue',
            'edit_item'          => 'Edit Venue',
            'new_item'           => 'New Venue',
            'view_item'          => 'View Venue',
            'search_items'       => 'Search Venues',
            'not_found'          => 'No venues found',
            'not_found_in_trash' => 'No venues found in trash',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-location',
        'hierarchical'  => false,
        'supports'      => [ 'title', 'thumbnail' ],   // Title = Venue Name
        'menu_position' => 6,
    ] );
} );


/* ──────────────────────────────────────────────
   4. Custom Post Type: Song Suggestions (mm_song_suggestion)
   ────────────────────────────────────────────── */
add_action( 'init', function () {
    register_post_type( 'mm_song_suggestion', [
        'labels' => [
            'name'               => 'Song Suggestions',
            'singular_name'      => 'Song Suggestion',
            'add_new'            => 'Add New Suggestion',
            'add_new_item'       => 'Add New Song Suggestion',
            'edit_item'          => 'Edit Song Suggestion',
            'new_item'           => 'New Song Suggestion',
            'view_item'          => 'View Song Suggestion',
            'search_items'       => 'Search Song Suggestions',
            'not_found'          => 'No song suggestions found',
            'not_found_in_trash' => 'No song suggestions found in trash',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-format-audio',
        'hierarchical'  => false,
        'supports'      => [ 'title' ],   // Title = Suggested song text
        'menu_position' => 7,
    ] );
} );


/* ──────────────────────────────────────────────
   5. Encore Vote — Enqueue reCAPTCHA + localize AJAX
   ────────────────────────────────────────────── */
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'google-recaptcha',
        'https://www.google.com/recaptcha/api.js?render=6LeFcHEsAAAAACqVvFAs0AKICs_9EKp3v_vbzTPi',
        [],
        null,
        true
    );
}, 30 );

// Output AJAX config as inline JS in footer
add_action( 'wp_footer', function () {
    $data = [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'mm_encore_nonce' ),
    ];
    echo '<script>var mmEncore = ' . wp_json_encode( $data ) . ';</script>';
}, 5 );



/* ──────────────────────────────────────────────
   6. AJAX: Submit Song Suggestion
   ────────────────────────────────────────────── */
function mm_submit_song_handler() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mm_encore_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Security check failed.' ] );
    }

    // Verify reCAPTCHA
    $recaptcha_response = isset( $_POST['recaptcha'] ) ? sanitize_text_field( $_POST['recaptcha'] ) : '';
    if ( empty( $recaptcha_response ) ) {
        wp_send_json_error( [ 'message' => 'Please complete the reCAPTCHA.' ] );
    }

    $verify = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
        'body' => [
            'secret'   => '6LeFcHEsAAAAALPJav86cwiwczhQVJwiU8oWRvtB',
            'response' => $recaptcha_response,
        ],
    ] );

    $verify_body = json_decode( wp_remote_retrieve_body( $verify ), true );
    if ( empty( $verify_body['success'] ) || ( isset( $verify_body['score'] ) && $verify_body['score'] < 0.5 ) ) {
        wp_send_json_error( [ 'message' => 'reCAPTCHA verification failed. Please try again.' ] );
    }

    // Save submission
    $song = isset( $_POST['song'] ) ? sanitize_text_field( $_POST['song'] ) : '';
    if ( empty( $song ) ) {
        wp_send_json_error( [ 'message' => 'Please enter a song name.' ] );
    }

    $post_id = wp_insert_post( [
        'post_type'   => 'mm_song_suggestion',
        'post_title'  => $song,
        'post_status' => 'publish',
    ] );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( [ 'message' => 'Could not save your suggestion.' ] );
    }

    wp_send_json_success( [ 'message' => 'Song suggestion submitted!' ] );
}
add_action( 'wp_ajax_mm_submit_song',        'mm_submit_song_handler' );
add_action( 'wp_ajax_nopriv_mm_submit_song', 'mm_submit_song_handler' );


/* ──────────────────────────────────────────────
   7. AJAX: Submit Votes (pick up to 3)
   ────────────────────────────────────────────── */
function mm_submit_votes_handler() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mm_encore_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Security check failed.' ] );
    }

    // Verify reCAPTCHA
    $recaptcha_response = isset( $_POST['recaptcha'] ) ? sanitize_text_field( $_POST['recaptcha'] ) : '';
    if ( empty( $recaptcha_response ) ) {
        wp_send_json_error( [ 'message' => 'Please complete the reCAPTCHA.' ] );
    }

    $verify = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
        'body' => [
            'secret'   => '6LeFcHEsAAAAALPJav86cwiwczhQVJwiU8oWRvtB',
            'response' => $recaptcha_response,
        ],
    ] );

    $verify_body = json_decode( wp_remote_retrieve_body( $verify ), true );
    if ( empty( $verify_body['success'] ) || ( isset( $verify_body['score'] ) && $verify_body['score'] < 0.5 ) ) {
        wp_send_json_error( [ 'message' => 'reCAPTCHA verification failed. Please try again.' ] );
    }

    // Get selected songs
    $songs = isset( $_POST['songs'] ) ? array_map( 'sanitize_text_field', (array) $_POST['songs'] ) : [];
    if ( empty( $songs ) || count( $songs ) > 3 ) {
        wp_send_json_error( [ 'message' => 'Please select between 1 and 3 songs.' ] );
    }

    // Increment vote counts
    $votes = get_option( 'mm_encore_votes', [] );
    foreach ( $songs as $song ) {
        if ( ! isset( $votes[ $song ] ) ) {
            $votes[ $song ] = 0;
        }
        $votes[ $song ]++;
    }
    update_option( 'mm_encore_votes', $votes );

    // Calculate percentages
    $total = array_sum( $votes );
    $results = [];
    foreach ( $votes as $name => $count ) {
        $results[ $name ] = [
            'votes'   => $count,
            'percent' => $total > 0 ? round( ( $count / $total ) * 100, 1 ) : 0,
        ];
    }

    // Sort by votes descending
    uasort( $results, function ( $a, $b ) {
        return $b['votes'] - $a['votes'];
    } );

    wp_send_json_success( [ 'message' => 'Vote submitted!', 'results' => $results ] );
}
add_action( 'wp_ajax_mm_submit_votes',        'mm_submit_votes_handler' );
add_action( 'wp_ajax_nopriv_mm_submit_votes', 'mm_submit_votes_handler' );

function mm_get_results_handler() {
    $votes = get_option( 'mm_encore_votes', [] );
    $total = array_sum( $votes );
    $results = [];

    foreach ( $votes as $name => $count ) {
        $results[ $name ] = [
            'votes'   => (int) $count,
            'percent' => $total > 0 ? round( ( $count / $total ) * 100, 1 ) : 0,
        ];
    }

    uasort( $results, function ( $a, $b ) {
        return $b['votes'] - $a['votes'];
    } );

    wp_send_json_success( [ 'results' => $results ] );
}
add_action( 'wp_ajax_mm_get_results',        'mm_get_results_handler' );
add_action( 'wp_ajax_nopriv_mm_get_results', 'mm_get_results_handler' );
