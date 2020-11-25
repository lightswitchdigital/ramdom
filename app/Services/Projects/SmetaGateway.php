<?php


namespace App\Services\Projects;


use App\Http\Requests\Projects\OrderRequest;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class SmetaGateway
{
    private $file;

    public function __construct() {

    }

    public function calculatePrice($project, OrderRequest $request): int
    {
        return 500;
    }

    public function loadFile($path) {
        $this->file = IOFactory::load($path);
    }

}
