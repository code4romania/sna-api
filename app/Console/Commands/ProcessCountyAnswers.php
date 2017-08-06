<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AggregatedCountiesAnswers;
use App\AnswersCounty;

class ProcessCountyAnswers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:process-county-answers {year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes the answers for the county through the view.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
        $aggregatedCountiesAnswers = AggregatedCountiesAnswers::get()->where('year', '=', $year)->all();
        foreach($aggregatedCountiesAnswers as $answer) {
            AnswersCounty::create([
                'institution_id' => $answer->county_id,
                'question_id' => $answer->question_id,
                'question_step' => $answer->question_step,
                'value' => $answer->value,
                'year' => $answer->year
            ]);
        }
    }
    
    private function cleanupAnswersFor($year)
    {
        AnswersCounty::where('year', '=', $year)->delete();
    }
}
