<?php
class Post
{
    private $id;
    private $author_id;
    private $content;
    private $date;

    public function __construct()
    {
        $this->id = -1;
        $this->author_id = -1;
        $this->content = "";
        $this->date = "";
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function post(mysqli $connection) {
        $sql = "INSERT INTO posts(author_id, content, date) VALUES ($this->author_id, '$this->content', NOW())";
        $result = $connection->query($sql);
        return $result;
    }

    static public function loadAllPosts(mysqli $connection)
    {
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true and $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedPost = new Post();
                $loadedPost->id = $row['id'];
                $loadedPost->author_id = $row['author_id'];
                $loadedPost->content = $row['content'];
                $loadedPost->date = $row ['date'];

                $ret[] = $loadedPost;
            }

        }
        return $ret;
    }

    static public function loadPostById(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM posts where email = $id";
        $result = $connection->query($sql);
        if ($result == true and $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedPost = new Post();
            $loadedPost->id = $row['id'];
            $loadedPost->author_id = $row['author_id'];
            $loadedPost->content = $row['content'];
            $loadedPost->date = $row['date'];
        }
    }

    public function loadAllPostsByUserId(mysqli $connection)
    {
        $sql = "SELECT * FROM posts WHERE author_id = $this->author_id";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true and $result->num_rows > 0) {
            foreach ($result as $row) {

                $loadedPost = new Post();
                $loadedPost->id = $row['id'];
                $loadedPost->author_id = $row['author_id'];
                $loadedPost->content = $row['content'];
                $loadedPost->date = $row['date'];

                $ret []= $loadedPost;
            }

        }
        return $ret;
    }

}
