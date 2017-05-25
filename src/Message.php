<?php

class Message
{
    private $id;
    public $author_id;
    public $receiver_id;
    public $content;
    private $seen;

    function __construct()
    {
        $this->id = -1;
        $this->author_id = -1;
        $this->receiver_id = -1;
        $this->content = "";
        $this->seen = 0;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function setReceiverId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function message(mysqli $connection) {
        $sql = "INSERT INTO messages(author_id, receiver_id, content, seen) VALUES (".$this->author_id . ", ". $this->receiver_id.", '". $this->content."', ".$this->seen.")";
        $result = $connection->query($sql);
        return $result;
    }

    public function loadAllMessagesByUserId(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM messages WHERE receiver_id =" . $id;
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true and $result->num_rows > 0) {
            foreach ($result as $row) {

                $loadedMess = new Message();
                $loadedMess->id = $row['id'];
                $loadedMess->author_id = $row['author_id'];
                $loadedMess->content = $row['content'];
                $loadedMess->receiver_id = $row['receiver_id'];
                $loadedMess->seen = $row['seen'];


                $ret []= $loadedMess;
            }
        }
        return $ret;
    }
}




