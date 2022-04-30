<?php

namespace App\Controllers;

use App\Models\QuestionsModel;

class MainController extends CoreController
{
    public function home()
    {
     
    }

    public function game() 
    {
        $questions = new QuestionsModel;
        $response = $questions->getAllQuestions();

        echo json_encode($response);
    }
}