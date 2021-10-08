<?php

namespace controllers;

use controllers\base\Web;

/**
 * Contrôleur principal
 * - Home du site
 * - Page à propos
 */
class Main extends Web
{
    function home()
    {
        $this->header();
        include("views/global/home.php");
        $this->footer();
    }

    function about()
    {
        $this->header();
        include("views/global/about.php");
        $this->footer();
    }
}