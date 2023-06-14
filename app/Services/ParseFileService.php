<?php

namespace App\Services;

use App\Interfaces\ParseFileInterface;
use App\Models\Row;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ParseFileService implements ParseFileInterface
{
    public function fileUpload($request): string
    {
        return $request->data->storeAs('files', $request->data->getClientOriginalName());
    }

    public function getFileData($path): array
    {
        DB::disableQueryLog();
        DB::table('rows')->truncate();

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(storage_path('app/'. $path));
        $reader->setReadDataOnly(true);

        return $spreadsheet->getActiveSheet()->toArray();
    }

    public function insertRecordsToDB($data): void
    {
        $collection = collect($data);

        $collection
            ->skip(1)
            ->chunk(1000)
            ->each(function (Collection $chunk) {
                $records = $chunk->map(function ($row) {
                    return [
                        'external_id' => $row[0],
                        'name' => $row[1],
                        'date' => $row[2]
                    ];
                })->toArray();

                DB::table('rows')->insert($records);
            });

    }
}
