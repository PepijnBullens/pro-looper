<?php
  // Include global configuration and functions
  include_once './core/db_connect.php';

  // Initialize the 'view' variable
  $view = '';

  // Check if the 'view' parameter exists in the GET request
  if (!empty($_GET['view'])) {
    // Sanitize the 'view' parameter to prevent XSS attacks
    $view = htmlspecialchars($_GET['view']);
    // Split the 'view' parameter by "/"
    $view = explode("/", $view);
  }

  // Initialize variables for page, CSS, and JavaScript files
  $page = '';
  $css = [];
  $js = [];

  // Determine the appropriate page, CSS, and JS based on the 'view' parameter
  if (empty($view[0])) {
    // Default to main page if no view is provided
    $page = 'main.php';
    $css[] = 'main.css';
    $js[] = 'main.js';
  } else {
    // Load 404 page for all other cases
    $page = '404.php';
    $css[] = '404.css';
    $js[] = '404.js';
  }

  // Include the determined page file
  require_once $env['BASE_URL'] . 'core/header.php';
  require_once $env['BASE_URL'] . 'views/' . $page;
  require_once $env['BASE_URL'] . 'core/footer.php';
?>