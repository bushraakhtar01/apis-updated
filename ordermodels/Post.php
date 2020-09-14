<?php
class Post{

private $conn;
private $table ='cart';
public $order_id;
public $id;
public $email;
public $firstName;
public $lastName;
public $prod_name;
public $prod_code;
public $prod_brand;
public $prod_price;
public $prod_saleprice;
public $quantity;
public $prod_image;
public $prod_color;
public $prod_type;
public $prod_category;
public $prod_size;
public $address;
public $payment;

public function __construct($db){
    $this->conn=$db;
}

public function read(){

    $query='SELECT
u.email as email,
u.firstName as firstName,
u.lastname as lastName,
    p.order_id,
    p.id,
    p.prod_name,
    p.prod_code,
    p.prod_brand,
    p.prod_price,
    p.prod_saleprice,
    p.prod_image,
    p.quantity,
    p.prod_type,
    p.prod_category,
    p.prod_color,
    p.prod_size,
    p.address,
    p.payment
    FROM
    ' . $this->table . ' p
    LEFT JOIN
    users u ON p.id=u.id';

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;   
}

public function read_single(){

    $query='SELECT
u.email as email,
u.firstName as firstName,
u.lastname as lastName,
    p.order_id,
    p.id,
    p.prod_name,
    p.prod_code,
    p.prod_brand,
    p.prod_price,
    p.prod_saleprice,
    p.prod_image,
    p.quantity,
    p.prod_type,
    p.prod_category,
    p.prod_color,
    p.prod_size
    FROM
    ' . $this->table . ' p
    LEFT JOIN
    users u ON p.id=u.id
   WHERE 
   p.id =?';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1,$this->id);
    
    $stmt->execute();

    return $stmt;
//     $stmt->execute();
//   $row=$stmt->fetch(PDO::FETCH_ASSOC);
//    $this->order_id=$row['order_id'];
//    $this->prod_name=$row['prod_name'];
//    $this->prod_brand=$row['prod_brand'];
//    $this->prod_code=$row['prod_code'];
//    $this->prod_price=$row['prod_price'];
//    $this->prod_saleprice=$row['prod_saleprice'];
//    $this->quantity=$row['quantity'];
//    $this->prod_image=$row['prod_image'];




}
public function create(){
    $query = ' INSERT INTO ' . $this->table . '
    SET
      id=:id,
      prod_name = :prod_name,
      prod_code = :prod_code,
      prod_brand = :prod_brand, 
      prod_price = :prod_price,
     prod_saleprice=:prod_saleprice,
     prod_image=:prod_image,
     quantity=:quantity,
     prod_type=:prod_type,
     prod_size=:prod_size,
     prod_color=:prod_color,
     prod_category=:prod_category';

      $stmt = $this->conn->prepare($query);
      $this->id=htmlspecialchars(strip_tags($this->id));
      $this->prod_name=htmlspecialchars(strip_tags($this->prod_name));
      $this->prod_code=htmlspecialchars(strip_tags($this->prod_code));
      $this->prod_brand=htmlspecialchars(strip_tags($this->prod_brand));
      $this->prod_price=htmlspecialchars(strip_tags($this->prod_price));
      $this->prod_saleprice=htmlspecialchars(strip_tags($this->prod_saleprice));
      $this->prod_image=htmlspecialchars(strip_tags($this->prod_image));
      $this->quantity=htmlspecialchars(strip_tags($this->quantity));
      $this->prod_color=htmlspecialchars(strip_tags($this->prod_color));
      $this->prod_type=htmlspecialchars(strip_tags($this->prod_type));
      $this->prod_size=htmlspecialchars(strip_tags($this->prod_size));
      $this->prod_category=htmlspecialchars(strip_tags($this->prod_category));

 



      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':prod_name', $this->prod_name);
      $stmt->bindParam(':prod_code', $this->prod_code);
      $stmt->bindParam(':prod_brand', $this->prod_brand);
      $stmt->bindParam(':prod_price', $this->prod_price);
      $stmt->bindParam(':prod_saleprice', $this->prod_saleprice);
      $stmt->bindParam(':prod_image', $this->prod_image);
      $stmt->bindParam(':quantity', $this->quantity);
      $stmt->bindParam(':prod_color', $this->prod_color);
      $stmt->bindParam(':prod_type', $this->prod_type);
      $stmt->bindParam(':prod_size', $this->prod_size);
      $stmt->bindParam(':prod_category', $this->prod_category);





      if($stmt->execute()){
          return true;
      }
          printf("Error: %s.\n", $stmt->error);
          return false;
      
}

public function update(){
    $query = 'UPDATE ' . $this->table . '
    SET
 
      address=:address,
      payment=:payment


     WHERE
     id = :id';
     

      $stmt = $this->conn->prepare($query);

     
      $stmt = $this->conn->prepare($query);
      $this->id=htmlspecialchars(strip_tags($this->id));
      
      $this->address=htmlspecialchars(strip_tags($this->address));
      $this->payment=htmlspecialchars(strip_tags($this->payment));





      $stmt->bindParam(':id', $this->id);

      $stmt->bindParam(':address', $this->address);
      $stmt->bindParam(':payment', $this->payment);






 

      if($stmt->execute()){
          return true;
      }
          printf("Error: %s.\n", $stmt->error);
          return false;
      
}

public function delete(){
    $query = ' DELETE FROM ' . $this->table . ' WHERE order_id = :order_id';

    $stmt = $this->conn->prepare($query);

    $this->order_id = htmlspecialchars(strip_tags($this->order_id));

    $stmt->bindParam(':order_id' , $this->order_id);

    
    if($stmt->execute()){
        return true;
    }
        printf("Error: %s.\n", $stmt->error);
        return false;
    


}
}