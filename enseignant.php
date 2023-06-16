<!DOCTYPE html>
<html>
<head>
    <title>Consultation de la table Enseignant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .container label {
            display: block;
            margin-bottom: 10px;
        }
        
        .container input[type="text"],
        .container input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Consultation de la table Enseignant</h2>
        <br><br><br><br>
        <form method="post" action="">
        &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
        <button onclick="displayTableField('select')">Select</button>
        <br><br><br>
            <label for="matricule">Matricule de l'enseignant :</label>
            <input type="text" name="matricule" id="matricule" required>
            <br><br><br><br>
            <input type="submit" name="submit" value="Select">
        </form>
        
        <?php
        if (isset($_POST['submit'])) {
            // Récupération du matricule saisi
            $matricule = $_POST['matricule'];
            
            // Connexion à la base de données
            $servername = 'localhost';
            $username = '';
            $password = '';
            $dbname = '';
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connexion échouée : " . $conn->connect_error);
            }
            
            // Requête pour sélectionner les informations de l'enseignant avec le matricule donné
            $sql = "SELECT * FROM Enseignant WHERE matricule_ens = '$matricule'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // Affichage des résultats dans un tableau
                echo '<table>';
                echo '<tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>Âge</th></tr>';
                
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['matricule_ens'] . '</td>';
                    echo '<td>' . $row['nom_ens'] . '</td>';
                    echo '<td>' . $row['prenom_ens'] . '</td>';
                    echo '<td>' . $row['age'] . '</td>';
                    echo '</tr>';
                }
                
                echo '</table>';
            } else {
                echo 'Aucun enseignant trouvé avec le matricule donné.';
            }
            
            // Fermeture de la connexion à la base de données
            $conn->close();
        }
        ?>
    </div>
</body>
<script>
        function displayTableField(action) {
            var form = document.getElementById('tableForm');
            form.style.display = 'block';
            
            var tableNameField = document.getElementById('tableName');
            tableNameField.value = '';
            tableNameField.placeholder = 'Nom de la table pour ' + action;
            
            form.onsubmit = function(event) {
                event.preventDefault();
                
                var tableName = tableNameField.value;
                if (tableName.trim() !== '') {
                    // Rediriger ou effectuer l'action souhaitée en fonction du bouton sélectionné
                    if (action === 'select') {
                        // Redirection vers la page d'insertion avec le nom de la table
                        window.location.href = 'select.php?table=' + tableName;
                    }         }
            };
        }
    </script>
</html>
