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

  function assoc_arr_to_table($result) {
    $table = "<table class=\"table table-striped table-bordered\"><tbody>";
    foreach ($result as $i => $val) {
      $table .= "<tr><td>".$i."</td>";
      foreach ($val as $key => $value) {
        $table .= "<td>".$value."</td>";
      }
      $table .= "</tr>";
    }
    $table .= "</tbody></table>";

    return $table;
  }

  if (isset($_REQUEST['query'])) {
    $stmt = build_query($db, $_REQUEST['query']);
    $data = stmt_to_assoc_array($stmt);
    $table = assoc_arr_to_table($data);
    echo $table;
    die();
  }
?>

<div class="container">
  <form id="myform">
    <textarea class="form-control" name="query" cols="80"></textarea><br>
    <button class="btn btn-default" type="submit">Submit</button>
  </form>
  <div id="output"></div>
</div>

<script type="text/javascript">
  $("#myform").submit(function(e){
  $.ajax({
    data: $("#myform").serialize(),
    success: function(result) {
      $("#output").html(result);
    }
  });
  e.preventDefault();
  });
</script>
