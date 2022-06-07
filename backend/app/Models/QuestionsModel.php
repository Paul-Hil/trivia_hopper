<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;


class QuestionsModel {    
    private $id;
    public $question;
    public $response;


    public function getQuestions($Nb_QuestionsSelected) {
        $pdo = Database::getPDO();

        $sql = 'SELECT id, question, response_type FROM questions
        INNER JOIN response_type ON questions.response = response_type.id_response
        ORDER BY RAND () LIMIT :Nb_QuestionsSelected';
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(':Nb_QuestionsSelected', $Nb_QuestionsSelected, PDO::PARAM_INT);
        
        $pdoStatement->execute();

        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        $questionsList = [];

        foreach($results as $value) {
            $questionsList['questions'][] = $value['question'];
            $questionsList['responses'][] = $value['response_type'];
        }
        return ($questionsList);
    }

    public static function getNumberMaxOfQuestions() {
        $pdo = Database::getPDO();

        $sql = 'SELECT id, question, response_type FROM questions
        INNER JOIN response_type ON questions.response = response_type.id_response
        ORDER BY id DESC';
        
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getLeaderboard() {
        $pdo = Database::getPDO();

        $sql = "SELECT username, score
        FROM users
        INNER JOIN scoreboard ON users.id = scoreboard.user_id
        ORDER BY `score` DESC LIMIT 10";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUserScore($username, $score) {

        $pdo = Database::getPDO();

        // Ajout de l'utilisateur
        $sql = "INSERT INTO `users` (`username`)
        VALUES (:username);";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindParam(':username', $username, PDO::PARAM_STR);
        $pdoStatement->execute();


        // Récupère son ID
        $sql = "SELECT id FROM users WHERE username = :username";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(':username', $username, PDO::PARAM_STR);
        
        $pdoStatement->execute();

        $user_id = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        // Ajout du score
        $sql = "INSERT INTO `scoreboard` (`user_id`, `score`)
        VALUES (:user_id, :score);";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindParam(':user_id', $user_id['id'], PDO::PARAM_INT);
        $pdoStatement->bindParam(':score', $score, PDO::PARAM_INT);

        $result = $pdoStatement->execute();

        return $result;


    }

    public static function getAllQuestions() {
        $pdo = Database::getPDO();

        $sql = 'SELECT id, question, response_type FROM questions
        INNER JOIN response_type ON questions.response = response_type.id_response
        ORDER BY id DESC';
        
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newQuestion($labelQuestion, $response) {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `questions` (`question`, `response`, `theme`)
        VALUES (:question, :response, NULL);";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(':question', $labelQuestion, PDO::PARAM_STR);
        $pdoStatement->bindParam(':response', $response, PDO::PARAM_STR);

    
        $result = $pdoStatement->execute();

        if($result) return json_encode(true);
        
        return false;
    }

    public function deleteQuestion($questionId) {

        $pdo = Database::getPDO();

        $sql = "DELETE FROM `questions`
        WHERE ((`id` = :questionId));";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(':questionId', $questionId, PDO::PARAM_STR);
    
        $result = $pdoStatement->execute();

        if($result) return json_encode(true);
        
        return false;
    }

    public function editQuestion($questionId, $question_label, $response) {
        $pdo = Database::getPDO();

        $sql = "UPDATE `questions` SET
        `question` = :questionLabel,
        `response` = :response,
        `theme` = NULL
        WHERE `id` = :questionId;";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(':questionLabel', $question_label, PDO::PARAM_STR);
        $pdoStatement->bindParam(':response', $response, PDO::PARAM_INT);
        $pdoStatement->bindParam(':questionId', $questionId, PDO::PARAM_INT);
    
        $result = $pdoStatement->execute();

        if($result) return json_encode(true);
        
        return false;
    }
}