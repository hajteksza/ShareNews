<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $hashedPassword;

    public function __construct()
    {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }


    public function getId()
    {
        return $this->id;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword($password)
    {
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $sql = "INSERT INTO users(email, username, hashed_password) VALUES ('$this->email', '$this->username', '$this->hashedPassword')";
            $result = $connection->query($sql);
            var_dump($result);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE users SET email = '$this->email', username = '$this->username', hashed_password = '$this->hashedPassword' WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    public function delete(mysqli $connection)
    {
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id= $this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

    public function login()
    {
        $_SESSION['user_id'] = $this->id;
    }

    public function loadUser(mysqli $connection, $email, $password)
    {
        $sql = "SELECT * FROM users where email = '$email'";
        $result = $connection->query($sql);
        if ($result) {
            if ($result == true and $result->num_rows == 1) {
                $row = $result->fetch_assoc();

                if (password_verify($password, $row['hashed_password'])) {
                    $this->id = $row['id'];
                    $this->email = $row['email'];
                    $this->username = $row['username'];
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function loadUserById(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM users where id= $id";
        $result = $connection->query($sql);
        if ($result == true and $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->email = $row['email'];
            $loadedUser->hashedPassword = $row ['hashed_password'];

            return $loadedUser;
        }
    }

    static public function loadAllUsers(mysqli $connection)
    {
        $sql = "SELECT * FROM users";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true and $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->email = $row['email'];
                $loadedUser->hashedPassword = $row ['hashed_password'];

                $ret[] = $loadedUser;
            }

        }
        return $ret;
    }
}

