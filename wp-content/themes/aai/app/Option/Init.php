<?php

if (!class_exists('CSF')) {
  return;
}

/*
  Include all option file here
 */

/* Theme menu page */

require_once AAI_THEME_DIR . '/app/Option/Parent-page.php';
/* Theme Option  Settings*/
require_once AAI_THEME_DIR . '/app/Option/Settings/General.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Style.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Header.php';

require_once AAI_THEME_DIR . '/app/Option/Settings/Banner.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Blog.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Post-Page.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Scroll-Top-Button.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Pre-Loader.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Social.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Footer.php';
require_once AAI_THEME_DIR . '/app/Option/Settings/Custom-css.php';

require_once AAI_THEME_DIR . '/app/Option/Settings/BackUp.php';


/* Post Meta */
require_once AAI_THEME_DIR . '/app/Option/Posts/Post.php';
require_once AAI_THEME_DIR . '/app/Option/Posts/Page.php';
