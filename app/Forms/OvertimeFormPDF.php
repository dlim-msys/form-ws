<?php

namespace App\Forms;

use Anouar\Fpdf\Fpdf;

class OvertimeFormPDF extends Fpdf
{
    /**
     * @var int
     */
    protected static $border = 1;

    /**
     * RequestSlipPDF constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $buildData
     */
    public function generate($buildData)
    {
        $data = self::buildData($buildData);
        $this->generatePDF($data);
        $this->SetAutoPageBreak(false);
        $this->Output();
        exit;
    }

    public function generatePDF($data)
    {
        $this->grid=false;
        $this->addPage('P', [216,279]);
        $this->Image(resource_path('pdf/OT-Form.jpg'), 0, 0, 216, 279,'jpg');
        $this->setFont('Times', '', 11);

        $this->setXY(30, 30);
        $this->cell(0, 5, $data['name'], 0, 0, 'L');
        $this->setXY(130, 30);
        $this->cell(0, 5, $data['date_filed'], 0, 0, 'L');
        $this->setXY(32, 35);
        $this->cell(0, 5, $data['position'], 0, 0, 'L');
        $this->setXY(135, 35);
        $this->cell(0, 5, $data['department'], 0, 0, 'L');
        $this->setY(58.5);
        $totalOvertime = 0;
        foreach ($data['overtime'] as $overtime) {
            $this->setX(13);
            $this->cell(22, 5, $overtime['date'], 0, 0, 'C');
            $this->cell(19, 5, $overtime['from'], 0, 0, 'C');
            $this->cell(16.5, 5, $overtime['to'], 0, 0, 'C');
            $this->cell(24, 5, $overtime['hours'], 0, 0, 'C');
            $this->cell(57.2, 5, $overtime['reason'], 0, 0, 'C');
            $this->cell(51, 5, $overtime['remark'], 0, 1, 'C');

            $totalOvertime+=$overtime['hours'];
        }

        $this->setXY(100,88.8);
        $this->cell(22, 5, $totalOvertime, 0, 0, 'C');
        $this->setXY(13,111);
        $this->cell(63, 5, $data['name'], 0, 0, 'C');

        $this->setXY(30, 165);
        $this->cell(0, 5, $data['name'], 0, 0, 'L');
        $this->setXY(130, 165);
        $this->cell(0, 5, $data['date_filed'], 0, 0, 'L');
        $this->setXY(32, 170);
        $this->cell(0, 5, $data['position'], 0, 0, 'L');
        $this->setXY(135, 170);
        $this->cell(0, 5, $data['department'], 0, 0, 'L');

        $this->setY(193.5);
        foreach ($data['overtime'] as $overtime) {
            $this->setX(13);
            $this->cell(22, 5, $overtime['date'], 0, 0, 'C');
            $this->cell(19, 5, $overtime['from'], 0, 0, 'C');
            $this->cell(16.5, 5, $overtime['to'], 0, 0, 'C');
            $this->cell(24, 5, $overtime['hours'], 0, 0, 'C');
            $this->cell(57.2, 5, $overtime['reason'], 0, 0, 'C');
            $this->cell(51, 5, $overtime['remark'], 0, 1, 'C');
        }

        $this->setXY(100,224);
        $this->cell(22, 5, $totalOvertime, 0, 0, 'C');
        $this->setXY(13,246.2);
        $this->cell(63, 5, $data['name'], 0, 0, 'C');

    }

    /**
     * @param $data
     * @return array
     */
    public function buildData($data)
    {
        return $data;
    }
}
