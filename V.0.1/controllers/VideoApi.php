<?php

namespace controllers;

use controllers\base\Api;
use models\FormationModel;

class VideoApi extends Api
{
    private $formationModel;

    function __construct()
    {
        $this->formationModel = new FormationModel();
    }

    function publicVideos()
    {
        echo json_encode($this->formationModel->getPublicVideos());
    }
}