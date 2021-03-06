<?php

namespace App\Controllers;

use App\Models\QuestionsModel;
use App\Models\UsersModel;

class MainController
{
    public function game() 
    {
        $Nb_QuestionsSelected = $_GET['numberOfQuestions'];
        $questionModel = new QuestionsModel;
        $response = $questionModel->getQuestions($Nb_QuestionsSelected);

        echo json_encode($response);
    }

    public function getAllQuestions() 
    {
        $response = QuestionsModel::getAllQuestions();

        echo json_encode($response);
    }

    public function numberMaxOfQuestions() 
    {
        $response = QuestionsModel::getNumberMaxOfQuestions();
        
        echo count($response);
    }

    public function loginAdmin() {
        $username = $_POST['username'];
        $pswUser = $_POST['password'];

        $userModel = new UsersModel;
        $pswHash = $userModel->checkUser($username);

        if($pswHash) {
            $response = password_verify($pswUser, $pswHash);
                if($response) {
                    echo 'true';   
                } else {
                    echo 'Error: Password incorrect';
                }
        } else {
            echo 'Error: No user find with this username';
        }   
    }

    public function newQuestion() {
        $labelQuestion = $_POST['newQuestionLabel'];
        $response = $_POST['response'];

        if($response === 'true') {
            $response = 1;
        }

        if($response === 'false') {
            $response = 2;
        }

        if($labelQuestion && $response) {
            $questionsModel = new QuestionsModel;
            $result = $questionsModel->newQuestion($labelQuestion, $response);
        } else {
            $result = 'Error: argument manquant';
        }

        echo $result;
    }

    public function deleteQuestion() {
        $questionId = $_POST['questionId'];

        if($questionId) {
            $questionsModel = new QuestionsModel;
            $result = $questionsModel->deleteQuestion($questionId);
        } else {
            $result = 'Error: argument manquant';
        }

        echo $result;
    }

    public function editQuestion() {
        $questionId = $_POST['questionId'];
        $question_label = $_POST['question_label'];
        $response = $_POST['response'];

        if($response === 'true') {
            $response = 1;
        }

        if($response === 'false') {
            $response = 2;
        }

        if($questionId && $question_label && $response) {
            $questionsModel = new QuestionsModel;
            $result = $questionsModel->editQuestion($questionId, $question_label, $response);
        } else {
            $result = 'Error: argument manquant';
        }

        echo $result;
    }

    public function leaderboard() {

        echo  json_encode(QuestionsModel::getLeaderboard());
    }

    public function addUserScore() {
        $username = $_POST['username'];
        $score = $_POST['score'];

        if($username && $score) {
            $questionModel = new QuestionsModel;

            if($questionModel->addUserScore($username, $score)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}