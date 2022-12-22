<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Render extends BaseController
{
    public function js($jsName)
    {
        if(($js = file_get_contents(__DIR__.'/../Views/js/'.$jsName)) === FALSE) show_404();
        $mimeType = 'text/javascript';

        $this->response
        ->setStatusCode(200)
        ->setContentType($mimeType)
        ->setBody($js)
        ->send();
    }
    public function image($imageName)
    {
        if(($image = file_get_contents(WRITEPATH.'uploads/foto/'.$imageName)) === FALSE) show_404();
        $mimeType = 'image/jpg';

        $this->response
        ->setStatusCode(200)
        ->setContentType($mimeType)
        ->setBody($image)
        ->send();
    }
}
