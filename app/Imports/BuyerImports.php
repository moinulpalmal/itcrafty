<?php


      namespace App\Imports;

      use App\Model\Buyer;
      use App\User;
      use Illuminate\Support\Facades\Hash;
      use Maatwebsite\Excel\Concerns\ToModel;

      class BuyerImports implements ToModel
      {
          /**
           * @param array $row
           *
           * @return Buyer|null
           */
          public function model(array $row)
          {
              return new Buyer([
                  'country_id'     => $row['BUYER_COUNTRY'],
                  'old_id'    => $row['ID'],
                  'name' => $row['BUYER_NAME'],
                  'short_name' => $row['BUYER_FOUR'],
                  'address' => $row['BUYER_ADDRESS'],
                  'status' => $row['ACTIVE']
                  //'name' => $row[2],
              ]);


          }
      }
