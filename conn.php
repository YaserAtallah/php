<?php
class conn
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "myucas";
    protected $conn = "";

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error PDOException" . $e->getMessage();
        }
    }

    public function addUser($email, $password, $date, $phone, $Yearofjoining)
    {

        $sql = "INSERT INTO users (email, password,date,phone,Yearofjoining) VALUES ('$email','$password','$date','$phone','$Yearofjoining')";

        if ($this->conn->query($sql)) {
        } else {
            echo "Error: " . $sql . "<br>";
        }
    }

    public function Users()
    {
        $query = "SELECT * FROM users";
        $result = $this->conn->query($query, PDO::FETCH_NUM);
        return $result;
    }
    public function deleteUser($id)
    {

        $query = "DELETE FROM users WHERE id=$id";
        $data = $this->conn->query($query, PDO::FETCH_NUM);
        if (!$data->rowCount()) {
            $Message = "Deletion failed";
            $status = 0;
            header("Location:admin.php?Message={$Message}&status={$status}");
        } else {
            $Message = "This user Deleted";
            $status = 1;
            header("Location:admin.php?Message={$Message}&status={$status}");
        }
    }

    public function edit($id)
    {
        $query = "select * from users where id=$id";
        $data = $this->conn->query($query, PDO::FETCH_NUM);
        return $data;
    }
    public function update($id, $email, $password, $date, $phone, $Yearofjoining)
    {
        # code...
        $sql = "update users set  email = '$email', password = '$password',date = '$date',phone = '$phone',Yearofjoining = '$Yearofjoining' WHERE id='$id'";
        $str = $this->conn->query($sql, PDO::FETCH_NUM);
    }

}

?>


<!-- This is Style ... -->
<style>
.button {
    background-color: #4CAF50;
    /* Green */
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
}

.button1 {
    background-color: #4CAF50;
}

/* Green */
.button2 {
    background-color: #008CBA;
}

/* Blue */
.button3 {
    background-color: #f44336;
}

/* Red */
.button4 {
    background-color: #e7e7e7;
    color: black;
}

/* Gray */
.button5 {
    background-color: #555555;
}

/* Black */
</style>
