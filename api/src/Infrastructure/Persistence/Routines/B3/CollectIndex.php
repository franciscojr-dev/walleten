<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Routines\B3;

use GuzzleHttp\Client;
use App\Domain\Index\Index;
use App\Domain\IndexComposition\IndexComposition;

$client = new Client();

$list_index = [
    'IBOV',
    'IFIX'
];

foreach ($list_index as $index) {
    $response = $client->request('GET', 'http://cotacao.b3.com.br/mds/api/v1/IndexComposition/'.$index);
    
    $data = $response->getBody()->getContents();
    if (!empty($data)) {
        $data = json_decode($data, true);
        
        $index_id = Index::firstOrCreate(
            ['name' => $index]
        );
        
        if (!empty($index_id)) {
            foreach ($data['UnderlyingList'] as $values) {
                try {
                    $insert = [
                        'index_id' => $index_id['id'],
                        'name' => $values['symb'],
                        'theoretical_qtd' => $values['indexTheoreticalQty'],
                        'percentage' => $values['indxCmpnPctg'],
                    ];
                    IndexComposition::updateOrCreate(
                        ['name' => $insert['name']],
                        $insert
                    );
                } catch(\PDOException $e) {
                    echo $e->getMessage();
                    echo PHP_EOL;
                    print_r($insert);
                    break;
                }
            }
        }
    }
}
