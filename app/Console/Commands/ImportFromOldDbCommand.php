<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Institution;
use App\Raspunsuri;
use App\Answer;
use App\Api\V1\Localization\Text\Normalizer;

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
        $year = $this->argument('year');
        $this->cleanupAnswersFor($year);
        $this->setSnaAvailableInstitutionsFor($year);
        $code4Institutions = $this->getAllCode4InstitutionsNormalized();
        
        foreach ($code4Institutions as $code4Institution) {
            $snaInstitution = $this->matchSnaInstitutionTo($code4Institution);
            if ($snaInstitution != null) {
                $snaUserId = $snaInstitution->id_user;
                $snaAnswers = Raspunsuri::where('id_user', '=', $snaUserId)->where('an', '=', $year)->get();
                foreach ($snaAnswers as $snaAnswer) {
                    $code4Answer = new Answer();
                    $code4Answer->question_id = $snaAnswer->id_intrebare;
                    $code4Answer->institution_id = $code4Institution->id;
                    $code4Answer->user_id = 1;
                    $code4Answer->value = $snaAnswer->raspuns;
                    $code4Answer->save();
                }
            }
        }
    }

    private function cleanupAnswersFor($year)
    {
        Answer::whereYear('created_at', '=', $year)->delete();
    }

    private function setSnaAvailableInstitutionsFor($year)
    {
        $this->snaAvailableInstitutions = Raspunsuri::select('id_user', 'raspuns')->where('an', '=', 2016)
            ->where('id_intrebare', '=', 1)
            ->get();
        foreach ($this->snaAvailableInstitutions as $snaAvailableInstitution) {
            $snaAvailableInstitution->raspuns = strtolower($snaAvailableInstitution->raspuns);
        }
    }

    private function getAllCode4InstitutionsNormalized()
    {
        $institutions = Institution::all('id', 'name');
        foreach ($institutions as $institution) {
            $institution->name = strtolower(Normalizer::normalize($institution->name));
        }
        return $institutions;
    }

    private function matchSnaInstitutionTo($code4Institution)
    {
        foreach ($this->snaAvailableInstitutions as $snaInstitution) {
            if (trim($code4Institution->name) == trim($snaInstitution->raspuns)) {
                return $snaInstitution;
            }
        }
        return null;
    }
}
