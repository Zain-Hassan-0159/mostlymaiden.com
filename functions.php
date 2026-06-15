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
/**
 * Helper to get reCAPTCHA v3 site and secret keys from homepage ACF fields.
 */
if ( ! function_exists( 'mm_get_recaptcha_keys' ) ) {
    function mm_get_recaptcha_keys() {
        $home_id = get_option( 'page_on_front' );
        $site_key   = function_exists( 'get_field' ) ? get_field( 'recaptcha_site_key', $home_id ) : '';
        $secret_key = function_exists( 'get_field' ) ? get_field( 'recaptcha_secret_key', $home_id ) : '';

        return [
            'site_key'   => ! empty( $site_key ) ? sanitize_text_field( $site_key ) : '6LeFcHEsAAAAACqVvFAs0AKICs_9EKp3v_vbzTPi',
            'secret_key' => ! empty( $secret_key ) ? sanitize_text_field( $secret_key ) : '6LeFcHEsAAAAALPJav86cwiwczhQVJwiU8oWRvtB',
        ];
    }
}

add_action( 'wp_enqueue_scripts', function () {
    $keys = mm_get_recaptcha_keys();
    wp_enqueue_script(
        'google-recaptcha',
        'https://www.google.com/recaptcha/api.js?render=' . esc_attr( $keys['site_key'] ),
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

    $keys = mm_get_recaptcha_keys();
    $verify = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
        'body' => [
            'secret'   => $keys['secret_key'],
            'response' => $recaptcha_response,
        ],
    ] );

    $verify_body = json_decode( wp_remote_retrieve_body( $verify ), true );
    if ( empty( $verify_body['success'] ) || ( isset( $verify_body['score'] ) && $verify_body['score'] < 0.5 ) ) {
        $error_msg = 'reCAPTCHA verification failed. Please try again.';
        if ( isset( $verify_body['error-codes'] ) && is_array( $verify_body['error-codes'] ) ) {
            $error_msg .= ' (Error: ' . implode( ', ', $verify_body['error-codes'] ) . ')';
        }
        wp_send_json_error( [ 'message' => $error_msg ] );
    }

    // Save submission
    $song = isset( $_POST['song'] ) ? sanitize_text_field( $_POST['song'] ) : '';
    if ( empty( $song ) ) {
        wp_send_json_error( [ 'message' => 'Please enter a song name.' ] );
    }

    $show_id = isset( $_POST['show_id'] ) ? intval( $_POST['show_id'] ) : 0;

    $post_id = wp_insert_post( [
        'post_type'   => 'mm_song_suggestion',
        'post_title'  => $song,
        'post_status' => 'publish',
    ] );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( [ 'message' => 'Could not save your suggestion.' ] );
    }

    if ( $show_id > 0 ) {
        update_post_meta( $post_id, 'show_id', $show_id );
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

    $keys = mm_get_recaptcha_keys();
    $verify = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
        'body' => [
            'secret'   => $keys['secret_key'],
            'response' => $recaptcha_response,
        ],
    ] );

    $verify_body = json_decode( wp_remote_retrieve_body( $verify ), true );
    if ( empty( $verify_body['success'] ) || ( isset( $verify_body['score'] ) && $verify_body['score'] < 0.5 ) ) {
        $error_msg = 'reCAPTCHA verification failed. Please try again.';
        if ( isset( $verify_body['error-codes'] ) && is_array( $verify_body['error-codes'] ) ) {
            $error_msg .= ' (Error: ' . implode( ', ', $verify_body['error-codes'] ) . ')';
        }
        wp_send_json_error( [ 'message' => $error_msg ] );
    }

    // Get show_id
    $show_id = isset( $_POST['show_id'] ) ? intval( $_POST['show_id'] ) : 0;
    if ( ! $show_id ) {
        wp_send_json_error( [ 'message' => 'Invalid show ID.' ] );
    }

    // Get selected songs
    $songs = isset( $_POST['songs'] ) ? array_map( 'sanitize_text_field', (array) $_POST['songs'] ) : [];
    if ( empty( $songs ) || count( $songs ) > 3 ) {
        wp_send_json_error( [ 'message' => 'Please select between 1 and 3 songs.' ] );
    }

    // Increment vote counts for this show
    $votes = get_post_meta( $show_id, 'mm_encore_votes', true );
    if ( ! is_array( $votes ) ) {
        $votes = [];
    }
    foreach ( $songs as $song ) {
        if ( ! isset( $votes[ $song ] ) ) {
            $votes[ $song ] = 0;
        }
        $votes[ $song ]++;
    }
    update_post_meta( $show_id, 'mm_encore_votes', $votes );

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
    $show_id = isset( $_POST['show_id'] ) ? intval( $_POST['show_id'] ) : 0;
    if ( ! $show_id ) {
        wp_send_json_error( [ 'message' => 'Invalid show ID.' ] );
    }

    $votes = get_post_meta( $show_id, 'mm_encore_votes', true );
    if ( ! is_array( $votes ) ) {
        $votes = [];
    }
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

/* ──────────────────────────────────────────────
   8. Admin Column: Display Show Name for Suggestions
   ────────────────────────────────────────────── */
add_filter( 'manage_mm_song_suggestion_posts_columns', function ( $columns ) {
    $columns['show_id'] = 'For Show';
    return $columns;
} );

add_action( 'manage_mm_song_suggestion_posts_custom_column', function ( $column, $post_id ) {
    if ( 'show_id' === $column ) {
        $show_id = get_post_meta( $post_id, 'show_id', true );
        if ( $show_id ) {
            $show_title = get_the_title( $show_id );
            echo esc_html( $show_title ? $show_title : 'Show #' . $show_id );
        } else {
            echo '—';
        }
    }
}, 10, 2 );

/* ──────────────────────────────────────────────
   9. Admin Columns & Metabox: Show Voting Details
   ────────────────────────────────────────────── */

// Add custom column to Shows list view
add_filter( 'manage_mm_show_posts_columns', function ( $columns ) {
    $columns['mm_show_votes'] = 'Encore Votes';
    return $columns;
} );

// Output top 3 voted songs in Shows list column
add_action( 'manage_mm_show_posts_custom_column', function ( $column, $post_id ) {
    if ( 'mm_show_votes' === $column ) {
        $votes = get_post_meta( $post_id, 'mm_encore_votes', true );
        if ( ! empty( $votes ) && is_array( $votes ) ) {
            arsort( $votes );
            $top_3 = array_slice( $votes, 0, 3, true );
            $summary = [];
            foreach ( $top_3 as $song => $count ) {
                $summary[] = esc_html( $song ) . ' (' . intval( $count ) . ')';
            }
            echo implode( '<br>', $summary );
            if ( count( $votes ) > 3 ) {
                echo '<br><span style="color: #888; font-size: 11px;">+' . ( count( $votes ) - 3 ) . ' more...</span>';
            }
        } else {
            echo '<span style="color: #aaa;">No votes yet</span>';
        }
    }
}, 10, 2 );

// Register the Encore Votes Meta Box on Edit Show screen
add_action( 'add_meta_boxes', function () {
    add_meta_box(
        'mm_show_votes_meta_box',
        'Encore Voting Results',
        'mm_render_show_votes_meta_box',
        'mm_show',
        'normal',
        'high'
    );
} );

// Render the metabox content with nice visual percentages and clear action
function mm_render_show_votes_meta_box( $post ) {
    $post_id = $post->ID;
    $votes = get_post_meta( $post_id, 'mm_encore_votes', true );
    
    // Process clear action if clicked
    if ( isset( $_GET['clear_votes'] ) && check_admin_referer( 'mm_clear_votes_nonce', 'clear_votes_nonce' ) ) {
        delete_post_meta( $post_id, 'mm_encore_votes' );
        $votes = [];
        echo '<div class="notice notice-success is-dismissible" style="margin: 0 0 15px 0;"><p>Voting data cleared successfully.</p></div>';
    }

    if ( empty( $votes ) || ! is_array( $votes ) ) {
        echo '<p style="margin: 10px 0;">No votes have been submitted for this show yet.</p>';
        return;
    }

    arsort( $votes );
    $total_votes = array_sum( $votes );

    echo '<table class="wp-list-table widefat fixed striped posts" style="margin-top: 10px; border: 1px solid #ccd0d4; box-shadow: none;">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="font-weight: bold; padding: 10px;">Song / Artist</th>';
    echo '<th style="font-weight: bold; width: 100px; padding: 10px;">Votes</th>';
    echo '<th style="font-weight: bold; width: 200px; padding: 10px;">Percentage</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ( $votes as $song => $count ) {
        $pct = $total_votes > 0 ? round( ( $count / $total_votes ) * 100, 1 ) : 0;
        echo '<tr>';
        echo '<td style="padding: 8px 10px; font-weight: 500;">' . esc_html( $song ) . '</td>';
        echo '<td style="padding: 8px 10px; font-size: 14px;"><strong>' . intval( $count ) . '</strong></td>';
        echo '<td style="padding: 8px 10px; vertical-align: middle;">';
        echo '<div style="background: #f0f0f1; border-radius: 4px; overflow: hidden; height: 20px; position: relative; border: 1px solid #c3c4c7;">';
        echo '<div style="background: #2271b1; width: ' . esc_attr( $pct ) . '%; height: 100%;"></div>';
        echo '<span style="position: absolute; right: 8px; top: 0; font-size: 11px; font-weight: bold; line-height: 20px; color: #3c434a; text-shadow: 0 0 2px #fff;">' . $pct . '%</span>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '<tfoot>';
    echo '<tr style="font-weight: bold; background: #f6f7f7; border-top: 1px solid #ccd0d4;">';
    echo '<td style="padding: 10px;">Total Votes</td>';
    echo '<td style="padding: 10px; font-size: 15px;">' . intval( $total_votes ) . '</td>';
    echo '<td style="padding: 10px;">100%</td>';
    echo '</tr>';
    echo '</tfoot>';
    echo '</table>';

    // Output secure reset link
    $clear_url = wp_nonce_url(
        admin_url( 'post.php?post=' . $post_id . '&action=edit&clear_votes=1' ),
        'mm_clear_votes_nonce',
        'clear_votes_nonce'
    );
    echo '<p style="margin-top: 20px; text-align: right; margin-bottom: 5px;">';
    echo '<a href="' . esc_url( $clear_url ) . '" class="button button-link-delete" onclick="return confirm(\'Are you sure you want to delete all voting data for this show? This action cannot be undone.\');" style="color: #b32d2e; text-decoration: none; font-weight: 500;">Clear Voting Data</a>';
    echo '</p>';
}

