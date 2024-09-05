<?php

require_once 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    
	    $name = htmlspecialchars($_POST['name']);
	        $email = htmlspecialchars($_POST['email']);
	        
	        
	        $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
		    
		   
		    if ($stmt = $conn->prepare($sql)) {
			           
			            $stmt->bind_param("ss", $name, $email);
				            
				            
				            if ($stmt->execute()) {
						                echo "Data successfully saved!";
								        } else {
										            echo "Error: " . $stmt->error;
											            }
				            
				            
				            $stmt->close();
				        } else {
						        echo "Error: " . $conn->error;
							    }
		    
		    
		    $conn->close();
} else {
	    echo "Invalid request method.";
}
?>
