<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Institution;
use App\Raspunsuri;
use App\Answer;

class ImportFromOldDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import-sna {year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports from the sna DB to code4 DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    
    private $snaAvailableInstitutions;
    
    public function __construct()
    {
        parent::__construct();
        $snaAvailableInstitutions = array();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //TODO cleanup for that year in code4 table answers
        $year = $this->argument('year');
        $this->setSnaAvailableInstitutionsFor($year);
        $code4Institutions = $this->getAllCode4InstitutionsNormalized();
        
        foreach ($code4Institutions as $code4Institution) {
            $snaInstitution = $this->matchSnaInstitutionTo($code4Institution);
            if($snaInstitution != null) {
                $snaUserId = $snaInstitution->id_user;
                $snaAnswers = Raspunsuri::where('id_user', '=', $snaUserId)
                ->where('an', '=', $year)
                ->get();
                foreach ($snaAnswers as $snaAnswer) {
                    $code4Answer = new Answer();
                    //TODO set the values
                    $code4Answer->save();
                }
            }
        }
        
    }
    
    private function setSnaAvailableInstitutionsFor($year) {
        $this->snaAvailableInstitutions = Raspunsuri::select('id_user', 'raspuns')
        ->where('an', '=', $year)
        ->where('id_intrebare', '=', 1)
        ->get();
    }
    
    private function getAllCode4InstitutionsNormalized() {
        $institutions = Institution::all('id', 'name', 'type_id');
        //TODO normalize code4 institutions
        return $institutions;
    }
    
    private function matchSnaInstitutionTo($code4Institution) {
        foreach ($this->snaAvailableInstitutions as $snaInstitution) {
            if($code4Institution->name == $snaInstitution->name) {
                return $snaInstitution;
            }
        }
        return null;
    }
    
}
