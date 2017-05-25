<?php

/**
 * Created by PhpStorm.
 * User: kajetanszafran
 * Date: 27.04.2017
 * Time: 15:17
 */
class Comment
{
    private $id;
    private $author_id;
    private $post_id;
    private $comment;

    function __construct()
    {
        $this->id = -1;
        $this->author_id = -1;
        $this->post_id = -1;
        $this->comment = "";
        $this->date = "";
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    public function comment(mysqli $connection) {
        $sql = "INSERT INTO comments(author_id, comment, date, post_id) VALUES ($this->author_id, '$this->comment', NOW(), $this->post_id)";
        $result = $connection->query($sql);
        return $result;
    }

    static public function loadCommentsByPostId(mysqli $connection, $post_id)
    {
        $sql = "SELECT * FROM posts where post_id = $post_id";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true and $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedComment = new Comment();
            $loadedComment->comment = $row['comment'];
            $loadedComment->author_id = $row['author_id'];
            $loadedComment->date = $row['date'];
            $ret []= $loadedComment;
        }
        return $ret;
    }


}