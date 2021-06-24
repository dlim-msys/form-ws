<?php

namespace App\Http\Controllers;

use App\Forms\OvertimeFormPDF;
use CFMIS\Common\Services\PDF\Procurement\PurchaseRequestPDF;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * @param Request $request
     */
    public function OvertimeForm(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'position' => 'required',
            'date_filed' => 'required',
            'department' => 'required',
            'overtime' => 'array|required',
            'overtime.*.date' => 'required|date_format:Y-m-d',
            'overtime.*.from' => 'required',
            'overtime.*.to' => 'required',
            'overtime.*.hours' => 'required',
            'overtime.*.reason' => 'required',
            'overtime.*.remark' => 'nullable'
        ]);

        $data = $request->all();

        $pdf = new OvertimeFormPDF();
        $pdf->generate($data);
    }
}
