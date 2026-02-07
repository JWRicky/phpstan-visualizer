<?php

namespace JWRicky\PhpStanVisualizer\Http\Controllers;

use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Storage;

class PhpStanVisualizerController extends Controller
{
    public function __invoke()
    {
        
        $editor = config('phpstan-visualizer.editor', 'vscode');
        $urlTemplate = config("phpstan-visualizer.templates.{$editor}", config('phpstan-visualizer.templates.vscode'));
        $jsonPath = config('phpstan-visualizer.report_path', 'phpstan/report.json');
        
        if (!Storage::exists($jsonPath)) {
            return "JSON report not found. Run 'composer phpstan:json' first.";
        }

        $data = json_decode(Storage::get($jsonPath), true);
        $basePath = base_path();

        $files = collect($data['files'] ?? [])->map(function ($info, $absPath) use ($basePath, $urlTemplate) {
            $relativePath = str_replace($basePath . '/', '', $absPath);

            return [
                'rel_path' => $relativePath,
                'errors'   => collect($info['messages'])->map(function ($error) use ($absPath, $urlTemplate) {
                    
                    $url = str_replace(
                        ['%%file%%', '%%line%%'],
                        [$absPath, $error['line']],
                        $urlTemplate
                    );

                    return [
                        'line'    => $error['line'],
                        'message' => $error['message'],
                        'url'     => $url,
                    ];
                })->toArray(),
            ];
        })->values();

        return view('phpstan-visualizer::index', [
            'totals' => $data['totals'] ?? ['file_errors' => 0],
            'files'  => $files
        ]);
    }
}