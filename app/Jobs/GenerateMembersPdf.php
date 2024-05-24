<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateMembersPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Retrieve all members from the database
        $members = \App\Models\Member::all();

        // Generate PDF using a Blade view
        $pdf = Pdf::loadView('pdf.members', compact('members'));

        // Define a path for the file
        $filePath = 'members.pdf';

        // Save the PDF to the server
        Storage::put($filePath, $pdf->output());
    }
}
