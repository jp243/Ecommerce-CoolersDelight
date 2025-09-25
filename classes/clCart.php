<?php

class Cart{
    
    private $conn;
    private $table = 'cart';

    //post properties
    public $id;
    public  $prod_id;
    public $user_id;
    public $quantity;
    public $total;
    public $date;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        //create query
        $query = '
            SELECT * FROM ' .$this->table;

        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        //create query
        $query = '
            SELECT * FROM ' .$this->table.' WHERE user_id=:userId
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userId", $this->user_id);
        //execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->prod_id = $row['prod_id'];
        $this->user_id = $row['user_id'];
        $this->quantity = $row['quantity'];
        $this->total = $row['total'];
        $this->date = $row['date'];
    }

    public function read_singleWithParam(){
        //create query
        $query = '
            SELECT * FROM ' .$this->table.' WHERE user_id=:userId
        ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userId", $this->user_id);
        //execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;

    }

    public function confirm_order(){
        //create query
        $query = '
        INSERT INTO sales_items(prod_id, sales_qty, total) SELECT prod_id, quantity, total 
        FROM cart 
        WHERE user_id =:userId"
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userId", $this->user_id);
        //execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->prod_id = $row['prod_id'];
        $this->user_id = $row['user_id'];
        $this->quantity = $row['quantity'];
        $this->total = $row['total'];
        $this->date = $row['date'];

        
    }

    public function create(){
        //create a query
        $query = 'INSERT INTO '.$this->table. ' SET prod_id =: prod_id, user_id =:user_id, quantity=:quantity, total=:total, date=:date';
        //prepare the statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->prod_id  = htmlspecialchars(strip_tags($this->prod_id));
        $this->user_id  = htmlspecialchars(strip_tags($this->user_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->total    = htmlspecialchars(strip_tags($this->total));
        $this->date     = htmlspecialchars(strip_tags($this->date));
        //binding of parameters
        $stmt->bindParam(':prod_id', $this->prod_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':date', $this->date);
        //execute the query
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    public function update(){
        //create a query
        $query = 'UPDATE '.$this->table. ' SET prod_id =: prod_id, user_id =:user_id, quantity=:quantity, total=:total, date=:date
         WHERE id=:id';
        //prepare the statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->prod_id  = htmlspecialchars(strip_tags($this->prod_id));
        $this->user_id  = htmlspecialchars(strip_tags($this->user_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->total    = htmlspecialchars(strip_tags($this->total));
        $this->date     = htmlspecialchars(strip_tags($this->date));
        //binding of parameters
        $stmt->bindParam(':prod_id', $this->prod_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':id', $this->id);
        //execute the query
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }
        
    //
    public function delete(){
        //create query
        $query = 'DELETE FROM '.$this->table.' WHERE id=:id';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean the data
        $this->id  = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        //execute the query
        if($stmt->execute()){
            return true;
        }
        printf("Error %s. \n", $stmt->error);
        return false;

    }

}


?>