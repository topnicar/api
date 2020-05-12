<?php
  if ( ! defined( 'varovalka' ) ) {
    die( '403' );
  }

  if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) :

    try {
      $update = $conn->prepare( "UPDATE udelezenec02.imdb SET ime=:ime, priimek=:priimek, kraj_id=:kraj, zanri=:zanri, ocena=:ocena, filmi=:filmi, nagrade=:nagrade, updated_at=now() WHERE id = :id AND status = 1" );
      $update->execute( array(
        ":id"      => intval( $_POST['id'] ),
        ":ime"     => $_POST['ime'],
        ":priimek" => $_POST['priimek'],
        ":kraj"    => intval( $_POST['kraj'] ),
        ":zanri"   => $_POST['zanri'],
        ":ocena"   => intval( $_POST['ocena'] ),
        ":filmi"   => $_POST['filmi'],
        ":nagrade" => $_POST['nagrade']
      ) );

      $_SESSION['message'] = array(
        'text' => 'Uspešno posodobljeni podatki',
        'type' => 'success'
      );

      header( 'Location: ' . getvar( 'APP_URL' ) . '/app/view/' . intval( $_POST['id'] ) );
    } catch ( PDOException $e ) {
      $_SESSION['message'] = array(
        'text' => $e->getMessage(),
        'type' => 'error'
      );
    }

  endif;

  try {
    $sql = $conn->prepare( "SELECT * FROM udelezenec02.imdb WHERE id = :id AND status = 1 LIMIT 1" );
    $sql->execute( array( ':id' => intval( $_GET['id'] ) ) );
    $en = $sql->fetch();

    $kraji = $conn->query( "SELECT * FROM udelezenec02.imdb_kraji ORDER BY kraj ASC" )->fetchAll();

    if ( empty( $en ) || empty( $kraji ) ) {
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
Uredi podatke igralca/igrallke
|
<a href="<?php echo getvar( 'APP_URL' ); ?>/app/view/<?php echo intval( $_GET['id'] ); ?>">&#8689;</a>
|
<button id="izbrisi">&#128465;</button>
<a id="izbrisi-ok" style="display: none;" href="<?php echo getvar( 'APP_URL' ); ?>/app/delete/<?php echointval( $_GET['id'] ); ?>">&#10004;</a>
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

<form method="POST">
  <input type="hidden" name="zeton" id="zeton" value="">
  <input type="hidden" name="id" id="id" value="<?php echo['id']; ?>">
  ime: <input type="text" name="ime" id="ime" value="<?php echo['ime']; ?>" required><br>
  priimek: <input type="text" name="priimek" id="priimek" value="<?php echo['priimek']; ?>" required><br>
  kraj: <select name="kraj" id="kraj">
    <?php foreach ( $kraji as $kraj ) : ?>
      <option value="<?php echo$kraj['kraj_id'] ?>" <?php echo['kraj_id'] == $kraj['kraj_id'] ? 'selected' : ''; ?>><?php echo$kraj['kraj'] ?></option>
    <?php endforeach; ?>
  </select><br>
  pristnost: <input type="text" name="prisotnost" id="pristnost" value="<?php echo['prisotnost']; ?>" required><br>
  nagrada: <input type="text" name="nagrada" id="nagrada" value="<?php echo['nagrada']; ?>" required><br>
  ustvarjeno: <input type="text" value="<?php echo date( 'j. n. Y, G:i:s', strtotime( $en['created_at'] ) ); ?>" disabled><br>
  posodobljeno: <input type="text" value="<?php echo sdate( 'j. n. Y, G:i:s', strtotime( $en['updated_at'] ) ); ?>" disabled><br>
  <br>
  <input type="submit" value="Posodobi">
</form>
