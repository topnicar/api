<?php
  if ( ! defined( 'varovalka' ) ) {
    die( '403' );
  }


  try {
    $sql = $conn->prepare( "SELECT * FROM ribici WHERE id = :id AND status = 1 LIMIT 1" );
    $sql->execute( array( ':id' => intval( $_GET['id'] ) ) );
    $ribic = $sql->fetch();

    if ( empty( $ribic ) ) {
      $_SESSION['message'] = array(
        'text' => 'Ni podatkov',
        'type' => 'error'
      );

      header( 'Location: ' . getvar( 'APP_URL' ) . '/app/' );
    }

  } catch ( PDOException $e ) {
    $_SESSION['message'] = array(
      'text' => $e->getMessage(),
      'type' => 'error'
    );
  }

?>
<!-- Več o posamezneme ribici/ribici -->
Samo en ribic/ribici
|
<a href="<?php echo  getvar( 'APP_URL' ); ?>/app/edit/<?php echo  $ribic['id']; ?>">&#9998;</a>
|
<button id="izbrisi">&#128465;</button>
<a id="izbrisi-ok" style="display: none;" href="<?php echo  getvar( 'APP_URL' ); ?>/app/delete/<?php echo  $ribic['id']; ?>">&#10004;</a>
<button id="izbrisi-cancel" style="display: none;">&#10006;</button>
<script>
  $(function () {
    $('#izbrisi').click(function () {
      $('#izbrisi').hide();
      $('#izbrisi-ok').show();
      $('#izbrisi-cancel').show();
    })
    $('#izbrisi-cancel').click(function () {
      $('#izbrisi').show();
      $('#izbrisi-ok').hide();
      $('#izbrisi-cancel').hide();
    })
  })
</script>

<table>
  <tr>
    <td>Ime:</td>
    <td><<?php echo $ribic['ime']; ?></td>
  </tr>
  <tr>
    <td>Priimek:</td>
    <td><<?php echo  $ribic['priimek']; ?></td>
  </tr>
  <tr>
    <td>Kraj:</td>
    <td><?php echo  $ribic['kraj']; ?></td>
  </tr>
  <tr>
    <td>Prisotnost:</td>
    <td><?php echo  $ribic['prisotnost']; ?></td>
  </tr>
  <tr>
    <td>Nagrada:</td>
    <td><?php echo  $ribic['kraj']; ?></td>
  </tr>
</table>
