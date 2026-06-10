<?php
/**
 * The Header — Möstly Maiden Child Theme
 * Outputs <head>, enqueued assets, and the fixed navigation bar.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title('–', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link href="https://fonts.googleapis.com/css2?family=Metal+Mania&family=Oswald:wght@300;400;500;600;700&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- NAV -->
<nav>
  <a href="/">Home</a>
  <a href="https://mostlymaiden.com/#shows">Shows</a>
  <a href="https://mostlymaiden.com/epk/">EPK</a>
  <a href="https://mostlymaiden.com/#vote">Vote</a>
  <a href="https://mostlymaiden.com/shop">Merch</a>
</nav>
