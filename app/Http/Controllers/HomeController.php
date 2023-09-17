<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_payments_invoices = round(Invoice::where('Value_Status', '1')->count() / Invoice::count() * 100);
        $total_invoice_unpaid = round(Invoice::where('Value_Status', '2')->count() / Invoice::count() * 100);
        $total_invoice_partial = round(Invoice::where('Value_Status', '3')->count() / Invoice::count() * 100);

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['فواتير المدفوعة', 'فواتير غير المدفوعة', 'فواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "فواتير المدفوعة",
                    'backgroundColor' => ['#2e8a01'],
                    'data' => [$total_payments_invoices],
                ],
                [
                    "label" => "فواتير غير المدفوعة",
                    'backgroundColor' => ['#ee335e'],
                    'data' => [$total_invoice_unpaid],
                ],
                [
                    "label" => "فواتير المدفوعه جزئيا",
                    'backgroundColor' => ['#f4ba0b'],
                    'data' => [$total_invoice_partial],
                ],
            ])
            ->options([
                'fontFamily' => 'Cairo', // Set the font family to Cairo for all text
                'legend' => [
                    'labels' => [
                        'fontFamily' => 'Cairo', // You can set it here as well for legend labels
                    ],
                ],
                'plugins' => [
                    'tooltip' => [
                        'enabled' => true,
                        'fontFamily' => 'Cairo', // Set the font family to Cairo for tooltips
                    ],
                ],
                'plugins' => [
                    'tooltip' => [
                        'enabled' => true,
                        'fontFamily' => 'Cairo', // Set the font family to Cairo for tooltips
                    ],
                ],
                
            ]);
        $chartjspie = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['فواتير المدفوعة', 'فواتير غير المدفوعة', 'فواتير المدفوعه جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#2e8a01', '#ee335e', '#f4ba0b'],
                    'hoverBackgroundColor' => ['#2e8a01', '#ee335e', '#f4ba0b'],
                    'data' => [$total_payments_invoices, $total_invoice_unpaid, $total_invoice_partial]
                ]
            ])
            ->options([
                'legend' => [
                    'labels' => [
                        'fontFamily' => 'Cairo', // Set the font family to Cairo
                        'fontWeight' => 'bold', // Set the font weight to bold
                    ],
                ],
                'plugins' => [
                    'tooltip' => [
                        'enabled' => true,
                        'fontFamily' => 'Cairo', // Set the font family for tooltips to Cairo
                        'fontWeight' => 'bold', // Set the font weight to bold for tooltips
                    ],
                ],
            ]);



        return view("home", compact('chartjspie', 'chartjs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
