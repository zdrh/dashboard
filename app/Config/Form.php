<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Form extends BaseConfig
{
    public $uploadPath = "upload/profile/";
    public $editButton = "<button class=\"btn btn-warning\">Editovat</button>";
    public $deleteButtonStart = "<button type=\"button\" class=\"btn btn-danger\" data-bs-toggle=\"modal\" ";
    public $deleteButtonEnd = "\">Smazat</button>";
}
