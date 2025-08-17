<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        // Example: PDF array (replace with DB query if needed)
        $pdfs = [
            (object)['title' => 'HEALTHY WORKPLACE LETTER OF COMMITMENT', 'file' => '1.pdf'],
            (object)['title' => 'NEW COMPOSITION OF THE SAFETY AND HEALTH COMMITTEE OF DTI 12 REGIONAL OFFICE', 'file' => '2.pdf'],
            (object)['title' => 'DTI RO 12_PSCP', 'file' => '3.pdf'],
            (object)['title' => 'R12 OSH_Accomplishment Report 2024', 'file' => '4.pdf'],
            (object)['title' => 'RMO 064 SERIES OF 2025 08.07.2025 RECONSTITUTION OF THE CONTINUITY CORE TEAM (CCT) OF THE DTI REGIONAL OFFICE XII', 'file' => '5.pdf'],
            (object)['title' => 'RMO 072 SERIES OF 2024 09.03.2024 WORKPLACE SAFETY AND DISASTER PREPAREDNESS POLICY', 'file' => '6.pdf'],
            (object)['title' => 'RMO 086 SERIES OF 2024 10.04.2024 ESTABLISHMENT OF HEALTHY WORKPLACE POLICY', 'file' => '7.pdf'],
            (object)['title' => 'RMO 090 SERIES OF 2024 10.25.2024 MENTAL HEALTH PROGRAM (MHP)OF DTI 12', 'file' => '8.pdf'],
            (object)['title' => 'RMO 111 SERIES OF 2023 12.23.2024 RECOMPOSITION OF A DRUG-FREE WORKPLACE COMMITTEE', 'file' => '9.pdf'],
            (object)['title' => 'RMO-077-08.08.2022-DRUG-FREE-WORKPLACE-POLICY-AND-PROGRAM', 'file' => '10.pdf'],
            (object)['title' => 'RMO066 S.2024 SMOKE AND VAPE FREE WORKPLACE POLICY AND PROGRAM', 'file' => '11.pdf'],
        ];

        // Ensure $pdfs is always an array
        if (!$pdfs) {
            $pdfs = [];
        }

        return view('auth.users.view.policies', compact('pdfs'));
    }
}
