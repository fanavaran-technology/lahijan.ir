<?php

namespace App\Imports;

use App\Models\NewsImage;
use Maatwebsite\Excel\Concerns\ToModel;

class NewsImageImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NewsImage([
            'id'    =>  $row[1],  
            'image' =>  $row[2]
        ]);
    }
}
