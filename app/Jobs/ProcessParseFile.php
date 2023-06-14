<?php

namespace App\Jobs;

use App\Http\Requests\FileRequest;
use App\Services\ParseFileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessParseFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected string $path;
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = new ParseFileService();
        $fileData = $service->getFileData($this->path);
        $service->insertRecordsToDB($fileData);
    }
}
