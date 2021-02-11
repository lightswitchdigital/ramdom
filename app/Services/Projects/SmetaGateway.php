<?php


namespace App\Services\Projects;

use App\Models\Projects\Project;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class SmetaGateway
{
    private string $file;
    private Spreadsheet $reader;

    public function __construct($file) {
        $this->file = $file;
        $this->initReader();
    }

    private function initReader()
    {
        $file = $this->file;

        $reader = IOFactory::createReader('Xlsx')->load($file);

        $this->reader = $reader;
    }

    public function calculatePrice(Project $project, Request $request)
    {
        $this->setRequestValues($request);

        $result = $this->getResult();

        return $result;
    }

    private function setRequestValues(Request $request) {
        foreach ($this->propertiesCellsMap() as $name => $cell) {
            $value = $request[$name];

            $this->setValue($cell, $value);
        }
    }

    private function setValue($cell, $value) {
        $this->reader->getSheet(0)->getCell($cell)->setValue($value);
    }

    private function getResult() {

        $cell = $this->getResultCellName();

        return $this->getCalculatedValue($cell);
    }

    private function getValue($cell) {
        return $this->reader->getSheet(0)->getCell($cell)->getValue();
    }

    private function getCalculatedValue($cell) {
        return $this->reader->getSheet(0)->getCell($cell)->getCalculatedValue();
    }

    private function clear() {
        $file = $this->file;

        $reader = IOFactory::createReader('Xlsx')->load($file);

        $this->reader = $reader;
    }

    // Methods that connected with cell names

    private function propertiesCellsMap() {
        return [
            'material' => 'B2',
            'height' => 'B4'
        ];
    }

    private function getResultCellName() {
        return 'E2';
    }

}
