<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: index.php");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="de-de">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="WerkzeugVerwaltung.css">
    <title>WerkzeugVerwaltung</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
  </head>
  <body>
    <h1>WerkzeugVerwaltung</h1>
    <table> 
      <tr>
        <th> 
            <form action="WerkzeugVerwaltung.php">
               <input type="submit" value="WerkzeugVerwaltung" class="nav-buttons"/>
            </form> 
         </th>
         <th> 
            <form action="MitarbeiterVerwaltung.php">
               <input type="submit" value="MitarbeiterVerwaltung" class="nav-buttons"/>
            </form> 
         </th>
         <th> 
            <form action="KundenVerwaltung.php">
               <input type="submit" value="KundenVerwaltung" class="nav-buttons"/>
            </form> 
         </th>
         <th> 
            <form action="MietVerwaltung.php">
               <input type="submit" value="MietVerwaltung" class="nav-buttons"/>
            </form> 
         </th>
         <th> 
            <form action="GeschaefteVerwaltung.php">
               <input type="submit" value="GeschaefteVerwaltung" class="nav-buttons"/>
            </form> 
         </th>
         <th> 
            <form action="Logout.php">
               <input type="submit" value="Account Abmelden" class="nav-buttons"/>
            </form> 
         </th>
       </tr>
    </table> 
   
    <table>
        <tr>
        <th> W_Nr </th>
        <th> Kategoriename </th>
        <th> Bezeichnung </th>
        <th> Leihgebühren </th>
        <th> Bearbeiten </th>
        <th> Löschen </th>
        </tr>
        
        <?php
         require("Mysql.php");

         if(isset($_GET["del"])){
           if(!empty($_GET["del"])){
              $blub = $mysql->prepare("DELETE FROM t_werkzeuge where W_Nr = :id");
              $blub->execute(array(":id" => $_GET["del"]));
              ?>
              <p>Das Werkzeug wurde gelöscht</p>
              <?php
           }
         }

         $blub = $mysql->prepare("SELECT * FROM t_werkzeuge");
         $blub->execute();
        while($row = $blub->fetch()){
         $kategorie = $mysql->prepare("SELECT Kategoriename FROM t_kategorien WHERE Ka_Nr = $row[Ka_Nr]");
         $kategorie->execute();
            while($Krow = $kategorie->fetch()){
          ?> 
          <tr>
            <td><?php echo $row ["W_Nr"] ?></td>
            <td><?php echo $Krow ["Kategoriename"] ?></td> 
            <td><?php echo $row ["Bezeichnung"] ?></td> 
            <td><?php echo $row ["Leihgebuehren"] ?></td>  
            <td>
              <a href="WerkzeugEdit.php?id=<?php echo $row["W_Nr"] ?>">
              <i class="fas fa-edit" style="width: 80"></i></a> 
            </td>
            <td> 
              <a href="WerkzeugVerwaltung.php?del=<?php echo $row["W_Nr"] ?>">
              <i class="fas fa-trash-alt" style="width: 50"></i></a>
            </td>
          </tr>
         <?php
        }}
        ?>
        <tr> </tr>
        <tr> 
            <td> </td>
            <td> </td>
            <td> </td>
            <td> <a href="WerkzeugRegister.php"><i class="fas fa-plus"> </i></a></td>
        </tr>
    </table>  
  </body>
</html>