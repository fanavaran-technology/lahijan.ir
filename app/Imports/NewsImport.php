<?php

namespace App\Imports;

use App\Models\Content\News;
use Maatwebsite\Excel\Concerns\ToModel;

class NewsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new News([
            'id'           =>  $row[0],
            'title'        =>  $row[1],
            'body'         =>  $row[2],
            'image'        =>  "images".DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."news".DIRECTORY_SEPARATOR."no-photo.png",
            'view_count'   =>  $row[3],
            'user_id'      =>  1,
            'created_at'   =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])
        ]);
    }
}
