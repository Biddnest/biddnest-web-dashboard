<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Sentiment\Analyzer;
use App\Models\Review;
use App\Models\ReviewSentiment;
use App\Enums\ReviewSentimentEnum;

class SentimentalAnalysis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sentiment:analyze {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {

        $model = $this->argument('model');
        $this->info("Analyzing Sentiments From $model Model");

        if(!in_array($model, ["review"])) {
            $this->error("Invalid Model $model. Supported model are - 'review'");
            exit;
        }


        Review::chunk(100, function ($reviews) use($model){
            foreach ($reviews as $review){
                if(!ReviewSentiment::where("review_id", $review->id)->first() && !empty($review->desc)){
                    switch($model){
                        case "review":
                        $analyzer = new Analyzer();
                        $sentiment = $analyzer->getSentiment($review->desc);
                        $summary = ReviewSentimentEnum::$REVIEW_SUMMARY[array_search(max($sentiment),$sentiment)];
                        $score = new ReviewSentiment;
                        $score->review_id = $review->id;
                        $score->neutrality_score = $sentiment['neu'];
                        $score->positivity_score = $sentiment['pos'];
                        $score->negativity_score = $sentiment['neg'];
                        $score->compound_score = $sentiment['compound'];
                        $score->summary = $summary;
                        $score->save();

                        $this->info("Analyzed Review #$review->id: '".$review->desc."' ==> ".$summary);
                        break;

                        default:
                            $this->error("Invalid Model $model. Supported model are - 'review'");
                        break;
                    }
                }
            }
        });
    }
}
