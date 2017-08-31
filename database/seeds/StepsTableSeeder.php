<?php

use Illuminate\Database\Seeder;
use App\Step;

class StepsTableSeeder extends Seeder
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
            'Consilier de etică',
            'Incompatibilități',
            'Transparență în procesul decizional',
            'Acces la informații de interes public',
            'Protecția avertizorului de integritate',
            'Distribuirea aleatorie a dosarelor/sarcinilor de serviciu',
            'Interdicții după încheierea angajării în cadrul instituțiilor publice ' .
                '(Pantouflage)',
            'Funcții sensibile',
        ];
        $id = 0;
        foreach($indicators as $name) {
            $indicator = new Step();
            $indicator->id = $id;
            $indicator->name = $name;
            $indicator->save();
            $id++;
        }
    }
}
