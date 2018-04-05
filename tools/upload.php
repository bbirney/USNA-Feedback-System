<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Upload File',
                      'version'    => 1.0,
                      'display'    => '99',
                      'tab'        => 'tools',
                      'position'   => 100,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
                      'access'     => array());
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

  if ((isset($_FILES)) && (sizeof($_FILES) > 0)) {
    try {
      $i=-1;
      while($_FILES['myfiles']['type'][++$i] != "text/csv");

      $data = read_csv();

    } catch (Exception $e) {
      if ($i == 0) {

      } else {
        echo "Datatables only for csv-formatted files";
        die();
      }
    }


    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    die();
  }
?>

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1 text-center">
      <form id="myform" method="post" enctype="multipart/form-data">
        <div class="col-md-6 col-md-offset-3 text-center">
          <div id="drop_zone" class="jumbotron text-center" title="Drop Files Here..." style="height:250px;border:5px dashed grey;padding:10px;text-align:center;vertical-align:middle;">
            <input type="file" id="drop_zone" name="myfiles[]" style="margin-left:auto;margin-right:auto;width:50%" multiple>
          </div>
          <button class="btn btn-default" type="submit">Upload File(s)</button>
        </div>
      </form>
    </div>
  </div>
  <div id="output">
  </div>
</div>

<script type="text/javascript">
  $("#myform").submit(function(e){
    var formData = new FormData($(this)[0]);
    $.ajax({
      type: 'POST',
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      success: function (response) {
        $("#output").html(response);
      }
    });
    e.preventDefault();
  });
</script>
