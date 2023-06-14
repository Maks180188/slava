<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Interfaces\ParseFileInterface;
use App\Jobs\ProcessParseFile;
class ParseFileController extends Controller
{
    public function __construct(
        private readonly ParseFileInterface $parseFileService
    )
    {
    }

    public function handle(FileRequest $request)
    {
        $path = $this->parseFileService->fileUpload($request);
        $job = new ProcessParseFile($path);

        dispatch($job);

        return response()->json(['status' => 200, 'data' => 'file processing started']);
    }
}
