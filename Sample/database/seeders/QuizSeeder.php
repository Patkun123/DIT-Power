<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $easy = \App\Models\Quiz::create(['level'=>1,'title'=>'Easy','description'=>'Basics','time_limit_seconds'=>120]);
        $q1 = $easy->questions()->create(['text'=>'What is 2+2?','type'=>'multiple_choice']);
        $q1->options()->createMany([
            ['text'=>'3'], ['text'=>'4','is_correct'=>true], ['text'=>'5']
        ]);

        $q2 = $easy->questions()->create(['text'=>'What color is the sky?','type'=>'fill_in_blank','correct_answer'=>'blue']);
        // create more questions...

        \App\Models\Quiz::create(['level'=>2,'title'=>'Medium','description'=>'Intermediate','time_limit_seconds'=>180]);
        \App\Models\Quiz::create(['level'=>3,'title'=>'Hard','description'=>'Advanced','time_limit_seconds'=>300]);
    }

}
