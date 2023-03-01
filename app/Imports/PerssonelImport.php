<?php

namespace App\Imports;

use App\Models\Clarification\Perssonel;
use Maatwebsite\Excel\Concerns\ToModel;

class PerssonelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Perssonel([
            'first_name'     => $row[0],
            'last_name'     => $row[1],
            'job'    => $row[2],
        ]);
    }
}
