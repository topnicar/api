<?php
 if (! defined( 'varovalka') ) {
   die('403');
 }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') :
   $insert = $conn->prepare( "INSERT INTO ribici (ime, priimek, kraj, prisotnost, nagrada) VALUES (:ime, :priimek, :kraj, :prisotnost, :nagrada);" );

     $insert->execute( array (
       ':ime'       => $_POST['ime'],
       ':priimek'   => $_POST['priimek'],
       ':kraj'      => $_POST['kraj'],
       ':prisotnost'=> intval($_POST['prisotnost']),
       ':nagrada'   => $_POST['nagrada']
     )  );

     $_SESSION['message'] = array(
      'text' => 'Uspešno vnešeni podatki',
      'type' => 'success'
    );

  endif; ?>



     Obrazec za vnos nove osebe
     <form method="POST">
      <input type="hidden" name="zeton" id="zeton" value="">
      ime: <input type="text" name="ime" id="ime" required><br>
      priimek: <input type="text" name="priimek" id="priimek" required><br>
      kraj: <input type="text" name="kraj" id="kraj" required><br>
      prisotnost:<br> <input type="time" name="prisotnost" id="pristnost"></br>
      nagrada:<br><input type="text" name="nagrada" id="nagrada" min="0" max="10"></br>
      <br>
      <br>
      <input type="submit" value="Dodaj">
    </form>
