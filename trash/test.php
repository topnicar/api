$query = "SELECT * FROM ribici ORDER BY ime asc";
$result = mysqli_query($conn, $query);
$array = mysqli_fetch_all($result);



<?php
define( 'varovalka', true );
//include 'shared.php';
include 'db_conn.php';


?>


<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8"
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/main.css">
<title>Seznam Drustva ribicov</title>
</head>
<body>
<h1><a href="<?php echo getvar('APP_URL'); ?>/">Seznam</a></h1>
<h1><a href="<?php echo getvar('APP_URL'); ?>/index.php?task=add">Dodaj novega ribic/ribic</a></h1>
<?php
  if ( isset( $_GET['vec'] ) && $_GET['vec'] >=1 ) :
  try {
    $sql = $conn->prepare("SELECT * FROM ribici WHERE id = :id");
    $sql->execute(array(':id' => intval($_GET['vec'])));
    $ribic = $sql->fetch();;
  } catch (PDOException $e) {
    echo "Napaka pri tabeli: " . $e->getMessage();
  }

?>
  <!-- Samo en ribic/ribici -->

    <tr>
      <th>Ime:</th>
    <th><?php echo $ribic['ime']; ?></th>
    </tr>
    <tr>
      <th>Priimek:</th>
      <th><?php echo $ribic['priimek']; ?></th>
    </tr>
    <tr>
      <th>Kraj:</th>
      <th><?php echo $ribic['kraj']; ?></th>
    </tr>
    <tr>
      <th>Prisotnost:</th>
      <th><?php echo $ribic['prisotnost']; ?></th>
    </tr>
    <tr>
      <th>Nagrada:</th>
      <th><?php echo $ribic['nagrada']; ?></th>
    </tr>
  </table>



 <?php elseif ( isset($_GET['task']) &&  $_GET['task'] === 'add' ) :
   if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) :
    $insert = $conn->prepare("INSERT INTO ribici (`ime`, `priimek`, `kraj`, `prisotnost`, `nagrada`) VALUES (:ime, :priimek, :kraj, :prisotnost, :nagrada);");

       $insert->execute(array(
       ':ime'       => $_POST['ime'],
       ':priimek'   => $_POST['priimek'],
       ':kraj'      => $_POST['kraj'],
       ':prisotnost'=> intval($_POST['prisotnost']),
       ':nagrada'   => $_POST['nagrada'],
     ));

     echo "New record created successfully";
      else : ?>

  <h1>Obrazec za vnos nove osebe</h1>
   <form class="input" method="POST">
     <br>ime:<br> <input type="text" name="ime" id="ime"></br>
     <br>priimek:<br> <input type="text" name="priimek" id="priimek"></br>
     <br>kraj:<br> <input type="text" name="kraj" id="kraj"></br>
     <br>prisotnost:<br> <input type="time" name="prisotnost" id="pristnost"></br>
     <br>nagrada:<br><input type="text" name="nagrada" id="nagrada" min="0" max="10"></br>
     <br><input type="submit" value="Dodaj"></br>

</form>

<?php
 endif ;
else :
  try {
    $sql = $conn->prepare("SELECT * FROM ribici ");
    $sql->execute();
    $array = $sql->fetchAll();
  } catch (PDOEexception $e) {
    echo "Napaka pri tabeli :" . $e ->getMessage();
  }
?>

  <?php foreach($array as $index => $ribici) : ?>
  <table class="tabelca">
    <tr class="data">
      <td><?=$index + 1; ?></td>
      <td><?=$ribici['ime'] ?></td>
      <td><?=$ribici['priimek'] ?></td>
      <td><a href="<?php echogetvar('APP_URL'); ?>/app/index.php?vec=<?=$ribici['id']; ?>">Preberi več</a></td>
    </tr>
  <?php endforeach;?>
  </table>
<?php endif; ?>
</body>
 </html>

 <?php
  $conn = NULL;
  ?>
  <?php
  define( 'varovalka', true );
  include 'update_db.php';
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8"
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="ribici">
    <link rel="stylesheet" href="css/main.css">
    <title>Seznam Drustva ribicov</title>
  </head>
    <body>
      <h1><a href="<?php echo getvar('APP_URL'); ?>/">Seznam</a></h1>
      <h1><a href="<?php echo getvar('APP_URL'); ?>/index.php?task=add">Dodaj novega ribic/ribic</a></h1>
      <?php if (isset($_GET['vec'] ) && $_GET['vec'] >= 0):?>
        <!-- Samo en ribic/ribici -->
        <?php $results = mysqli_query($conn, "SELECT * FROM ribici");?>

        <h2>Ribič: <?php echo$array[$_GET['vec']]['1']; ?></h2>
        <table>
          <tr>
            <td>Priimek:</td>
            <td><?php echo$array[$_GET['vec']]['2']; ?></td>
          </tr>
          <tr>
            <td>Kraj:</td>
            <td><?php echo$array[$_GET['vec']]['3']; ?></td>
          </tr>
          <tr>
            <td>Prisotnost:</td>
            <td><?php echo$array[$_GET['vec']]['4']; ?></td>
          </tr>
          <tr>
            <td>Nagrada:</td>
            <td><?php echo$array[$_GET['vec']]['5']; ?></td>
          </tr>
          <tr>
            <td>Status:</td>
            <td><?php echo$array[$_GET['vec']]['6']; ?></td>
          </tr>
          <tr>
            <td>created_at</td>
            <td> <?php echo$array[$_GET['vec']]['7'];  ?></td>
          </tr>
          <tr>
            <td>updated_at</td>
            <td> <?php echo$array[$_GET['vec']]['8'];  ?></td>
          </tr>
          <tr>
            <td>deleted_at</td>
            <td> <?php echo$array[$_GET['vec']]['9'];  ?></td>
          </tr>
        </table>
      </div>
        <?php else :?>

        <center> <h2>Besedilo</h2> </center>
        <table>
          <tr>
            <th>Številka</th>
            <th>Ime</th>
            <th>Priimek</th>
            <th>Kraj</th>
            <th>Prisotnost</th>
            <th>Nagrada</th>
            <th>Več</th>
          </tr>
          <?php foreach ($array as $index => $array):
            ?>
          <tr>
            <th><?php echo$index + 1;?></th>
            <th><?php echo$array['3']; ?></th>
            <th><?php echo$array['1'];?></th>
            <th><?php echo$array['4'];?></th>
            <th><?php echo$array['5'];?></th>
            <th><a class="" href="localhost/app?vec=<?php echo$index; ?>"><i class="fa fa-edit">vec</a></th>
          </tr>
          <?php endforeach;?>
        </table>
       <?php endif;?>
    </body>
  </html>
  <?php mysqli_close($conn); ?>
