<?php
  if ( ! defined( 'varovalka' ) ) {
    die( '403' );
  }

  try {
    // $sql = $conn->prepare( "SELECT * FROM ribici WHERE status = 1 ORDER BY priimek ASC" );
    // $sql->execute();
    // $array = $sql->fetchAll();
  } catch ( PDOException $e ) {
    $_SESSION['message'] = array(
      'text' => $e->getMessage(),
      'type' => 'error'
    );
  }

?>

  <!-- Cel seznam ribici ribici -->
  Cel seznam






    <table border="1">
      <tr>
        <th>Ime</th>
        <th>Priimek</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <?php
        $js = '';

        // foreach ( $array as $index => $ribic ) : ?>
          <tr>

            <td><a href="<?php echo  getvar( 'APP_URL' ); ?>/app/view/<?php echo  $ribic['id']; ?>">&#8689;</a></td>
            <td><a href="<?php echo  getvar( 'APP_URL' ); ?>/app/edit/<?php echo  $ribic['id']; ?>">&#9998;</a></td>
            <td>
              <button id="izbrisi-<?php echo  $index; ?>">&#128465;</button>
              <a id="izbrisi-ok-<?php echo  $index; ?>" style="display: none;" href=<?php echo  getvar( 'APP_URL' ); ?>/app/delete/<?php echo  $ribici['id']; ?>">&#10004;</a>
              <button id="izbrisi-cancel-<?php echo $index; ?>" style="display: none;">&#10006;</button>
            </td>
          </tr>
        <?php


        $js .= '

      });
      ';

      // endforeach; ?>
  </table>
  <script>
    $(function () {
      <?php echo  $js; ?>
    })
  </script>
