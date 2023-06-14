<?php

namespace App\Interfaces;

interface ParseFileInterface
{
    public function fileUpload($request): string;
    public function getFileData($path): array;
    public function insertRecordsToDB($data): void;

}
