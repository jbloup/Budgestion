<?php

namespace App\Imports;

use App\Models\Account;
use App\Models\Family;
use App\Models\Spent;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class SpentsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Spent|null
     */

    public function model(array $row)
    {
        $accounts = Account::where('name', $row[3])->get();
        $families = Family::where('name', $row[4])->get();

        foreach ($families as $family) {
            $family_id = $family->id;
        }
        foreach ($accounts as $account) {
            $account_id = $account->id;
        }
        $date = date('Y-m-d', strtotime($row[5]));

        $datetest = 2020-01-01;

        return new Spent([
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'account_id' => $account_id,
            'family_id' => $family_id,
            'date' => $datetest,
            'user_id' => Auth::user()->getAuthIdentifier(),
        ]);
    }
}
