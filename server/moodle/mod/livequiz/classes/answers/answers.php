<?php

namespace mod_livequiz\answers;

use dml_exception;
use dml_transaction_exception;
use mod_livequiz\questions_answers_relation\questions_answers_relation;
use mod_livequiz\quiz_questions_relation\quiz_questions_relation;

class answers
{

    // Usage: $answer = new answers(1, 'beskrivelse', 'forklaring', 9);

    private $correct;

    private $description;

    private $explanation;

    /**
     * Constructor for the answers class. Inserts a new answer into the database.
     * Appends the answer to a question, given the question id.
     *
     * @param $correct
     * @param $description
     * @param $explanation
     * @param $question_id
     * @throws dml_exception
     * @throws dml_transaction_exception
     */
    public function __construct($correct, $description, $explanation, $question_id)
    {
        global $DB;
        try{
            $transaction = $DB->start_delegated_transaction();

            $this->correct = $correct;
            $this->description = $description;
            $this->explanation = $explanation;

            $answerData = [
                'correct' => $this->correct,
                'description' => $this->description,
                'explanation' => $this->explanation,
            ];

            // Insert answer into database
            $answer_id = $DB->insert_record('livequiz_answers', $answerData);

            // Append answer to question
            questions_answers_relation::append_answer_to_question($question_id, $answer_id);

            $transaction->allow_commit();
        } catch (dml_exception $e) {
            $transaction->rollback($e);
        }
        return $answer_id;
    }

    /**
     * TODO: Implement this method
     *
     * @param $id
     * @return mixed
     */
    public static function update_answer($answer)
    {
        global $DB;
        return $DB->update_record('livequiz_answers', ['id' => $answer->id]);
    }

    /**
     * Get an answer from its id
     *
     * @param $id
     * @return mixed
     * @throws dml_exception
     */
    public static function get_answer_from_id($id): mixed
    {
        global $DB;
        return $DB->get_record('livequiz_answers', ['id'=>$id]);
    }
}

    // TODO Discuss deletion
//    public static function delete_answer($answer)
//    {
//        global $DB;
//        $id = $answer->id;
//        $DB->delete_records('livequiz_answers', ['id'=>$id]);
//    }
//}