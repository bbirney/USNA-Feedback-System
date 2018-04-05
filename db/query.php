<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Make-A-Query',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'tools',
                      'position'   => 100,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => false,
                      'access'     => array('admin' => 'db'));
  ###############################################################

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');
  require_once("../web/navbar.php");
  if (!isset($_POST['query'])) {
?>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <form method="post" id="form">
        <textarea class="form-control" rows="8" name="query"></textarea><br>
        <button type="submit" class="btn">Submit</button>
      </form>
    </div>
    <div class="col-md-2"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" id="output"></div>
    <div class="col-md-2"></div>
  </div>
<?php
  } else {
    $stmt = build_query($db, $_POST['query'], array());
    $stmt->execute();
    $result = stmt_to_assoc_array($stmt);

    echo "<table class=\"table table-striped\" style=\"width:60%;margin-left:auto;margin-right:auto;\">";
    $keys = array_keys($result);
    echo "<thead>";
    echo "</thead><tbody>";

    foreach ($result as $i) {
      echo "<tr>";
      foreach ($i as $key => $value) {
        echo "<td>".$value."</td>";
      }
      echo "</tr>";
    }
    echo "</tbody></table>";
?>
    <script>
      $("#input").html("");
    </script>

<?php
  }
?>

</body>
</html>
