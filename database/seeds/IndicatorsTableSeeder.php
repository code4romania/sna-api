<?php

use Illuminate\Database\Seeder;
use App\Indicator;

class IndicatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicators = [
            '',
            'Cod etic/deontologic/de conduită',
            'Declararea averilor',
            'Declararea cadourilor',
            'Conflicte de interese',
            'Consilier de etică/consilier pentru integritate',
            'Incompatibilități',
            'Transparență în pricesul decizional',
            'Acces la informații de interes public',
            'Protecția avertizorului de integritate',
            'Distribuirea aleatorie a sarcinilor de serviciu',
            'Interdicții după încheierea angajării în cadrul instituțiilor publice',
            'Registru abateri conduită ale demnitarilor, funcționarilor publici ' .
                'și personalului contractual, cu atribuții în domeniul protecției ' .
                'intereselor financiare ale UE',
            'Cod de conduită al personalului cu atribuții de control în domeniul' .
                'protecției intereselor financiare ale UE',
        ];
        $id = 0;
        foreach($indicators as $name) {
            $indicator = new Indicator();
            $indicator->id = $id;
            $indicator->name = $name;
            $indicator->save();
            $id++;
        }
    }
}
