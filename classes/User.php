<?php
    /*
    include       - include again and agian every time you refresh the page
    include_once  - include only once

    require       - require again and again and will stop the script when theres an error
    require_once  - require once onlt and will stop the script when theres error
    */
    require_once "Database.php";

    class User extends Database
    {
        public function store($request)//collect information entered in the form [form action="../actions/register.php] from register.php in views folder
        {
            $first_name  = $request['first_name'];
            $last_name   = $request['last_name'];
            $username    = $request['username'];
            $password    = $request['password'];

            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (first_name, last_name, username, password) VALUES ('$first_name', '$last_name', '$username', '$password')";//collected information is inserted into sql

            if($this->conn->query($sql)){
                header('location: ../views');
                exit;
            } else {
                die('Error creating the user: ' . $this->conn->error);
            }
        }

        public function login($request)
        {
            $username = $request['username'];
            $password = $request['password'];

            $sql = "SELECT * FROM users WHERE username = '$username'";

            $result = $this->conn->query($sql);

            #check the username
            if($result->num_rows == 1){
                #check if the password is correct
                $user = $result->fetch_assoc();

                if(password_verify($password, $user['password'])){
                    #create session variable for future use
                    session_start();

                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];

                    header('location: ../views/dashboard.php');
                    exit;
                } else {
                    die('Password is incorrect. ');
                }
                } else {
                    die('Username not found. ');
                }            
        }

        public function logout()
        {
            session_start();
            session_unset();//remove values from session variable
            session_destroy();//stop the session

            header('location: ../views');//redirected to log in page
            exit;
        }

        public function getAllUsers()
        {
            $sql = "SELECT id, first_name, last_name, username, photo FROM users";

            if($result = $this->conn->query($sql)){
                return $result;
            } else {
                die('Error retrieving all users:' . $this->conn->error);
            }
        }

        public function getUser($id)//retrieve specific user to edit the user info
        {
            $sql = "SELECT * FROM users WHERE id = $id";

            if($result = $this->conn->query($sql)){
                return $result->fetch_assoc();
            } else {
                die('Error retrieving the user:' . $this->conn->error);
            }
        }

        public function update($request, $files)
        {
            session_start();
            $id = $_SESSION['id'];
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];
            $photo = $files['photo']['name'];
            $tmp_photo = $files['photo']['tmp_name'];//tmp name given before going into destination and images folder

            $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE id = $id";

            if($this->conn->query($sql)){
                $_SESSION['username'] = $username;
                $_SESSION['full_name'] = "$first_name $last_name";

                # if there is an uploaded photo, save it to the db and save the file to images folder
                if($photo){
                    $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
                    $destination = "../assets/images/$photo";

                    //save the image name to db
                    if($this->conn->query($sql)){
                        //save the file to images folder
                        if(move_uploaded_file($tmp_photo, $destination)){
                            header('location: ../views/dashboard.php');
                            exit;
                        } else {
                            die('Error moving the photo. ');
                        }
                    } else {
                        die('Error uploading the photo: ' . $this->conn->error);
                    }
                }
                header('location: ../views/dashboard.php');
                exit;
            } else {
                die('Error updating the user: ' . $this->conn->error);
            }
        }

        public function delete()
        {
            session_start();

            $id = $_SESSION['id'];

            $sql = "DELETE FROM users WHERE id = $id";

            if($this->conn->query($sql)){
                $this->logout();
            } else {
                die('Error deleting your account: ' . $this->conn->error);
            }
        }
    }

        



    


?>