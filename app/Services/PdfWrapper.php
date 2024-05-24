<?php

namespace App\Services;

use Illuminate\Http\Response;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\File;

class PdfWrapper
{
    protected Browsershot $pdfGenerator;
    protected string $html;

    public function __construct()
    {
        $this->pdfGenerator = new Browsershot();
    }

    public function loadView(string $bladeFile, array $data = []): self
    {
        $this->html = view($bladeFile, $data)->render();
        return $this;
    }

    public function loadHtml(string $html): self
    {
        $this->html = $html;
        return $this;
    }

    public function generate(): Browsershot
    {
        $includePath = config('services.browsershot.include_path');
        $nodePath = 'C:\Program Files\nodejs\node.exe'; // Replace this with the correct path

        return $this->pdfGenerator
            ->html($this->html)
            ->setIncludePath($includePath)
            ->setNodeBinary($nodePath) // Ensure correct path to Node.js
            ->margins(30, 15, 30, 15)
            ->noSandbox() // Disable sandboxing if you are running into permission issues
            ->waitUntilNetworkIdle()
            ->timeout(60000) // Increase timeout to 60 seconds
            ->debug(); // Enable debug mode to see more output
    }

    public function save(string $path): void
    {
        $directory = dirname($path);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $this->generate()->savePdf($path);
    }

    public function download(string $filename)
    {
        $pdf = $this->generate()->pdf();
        return new Response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Length' => strlen($pdf)
        ]);
    }

    public function stream(string $filename)
    {
        return new Response($this->generate()->pdf(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}
