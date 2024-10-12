

  
        <?php
            $servername = 'localhost';
            $username = 'root';
            $password = "";
            
            //On essaie de se connecter
            try{
                $pdo = new PDO("mysql:host=$servername;dbname=gestion_stagedb", $username, $password);
                
                
            }
            catch(PDOException $e){
              echo "Erreur de connexion : " . $e->getMessage();
            }
        ?>