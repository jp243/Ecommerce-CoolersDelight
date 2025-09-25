<?php
require_once 'dbconfig.php';
    $or = $_POST['ornumber'];
    // Query to fetch image records from the database
    $query = "SELECT * FROM payments WHERE ornumber='$or'";
    $stmt = $pdo->query($query);

    if ($stmt->rowCount() > 0) {
        // Iterate through the fetched records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imagePath = $row['image_path'];
            $imageId = $row['img_id'];
            // Display the image
            echo '
            <div class="col-md-3">
                <div class="card product-card">
                    <img src="' .$imagePath.'" class="card-img-top" alt="'.$imageId.'">
                    <div class="card-body">   
                        <div>
                            <h5 class="card-title">' .$imageId. '</h5>
                            <p class="card-text">' . $imagePath . '</p>
                        </div>  
                        <div class="d-grid">
                            <a href="#" class="btn btn-primary btn-block">Add to Cart</a> 
                        </div>          
                    </div>                    
                </div> 
            </div>       
                ';            
        }
    } else {
        echo 'No images found.';
    }
?>
