<?php
class FeedbackForm
{
    public $userId;
    public $message;
    public $submittedAt;

    public function __construct($userId, $message)
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->submittedAt = date("Y-m-d H:i:s");
    }

    public function updateMessage($message)
    {
        $this->message = $message;
    }
}
