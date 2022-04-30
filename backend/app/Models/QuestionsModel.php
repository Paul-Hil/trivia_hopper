<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;


class QuestionsModel {    
    private $id;
    public $question;
    public $response;

    public function getAllQuestions() {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM questions
        INNER JOIN response_type ON questions.response = response_type.id
        ORDER BY RAND () LIMIT 10';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        $questionsList = [];

        foreach($results as $value) {
            $questionsList['questions'][] = $value['question'];
            $questionsList['responses'][] = $value['response'];
        }
        return ($questionsList);
    }
}