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
                      'access'     => array('admin'=>'db'));
  ###############################################################

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');
  require_once("../web/navbar.php");


  function assoc_arr_to_table($data, $header=false) {
    $table = "<table class=\"table table-striped table-bordered\">";

    if ($header) {
      $table .= "<thead><tr>";

      $keys = array_keys($data);
      for ($i=0;$i<sizeof($keys);$i++) $table .= "<th>".$keys[$i]."</th>";

      $table .= "</tr></thead>";
    }

    $table .= "<tbody>";
    foreach ($data as $i => $val) {
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
      while(isset($_FILES['myfiles']['type'][++$i]) && $_FILES['myfiles']['type'][$i] != "text/csv");

      if (!isset($_FILES['myfiles']['type'][$i])) throw new Exception();

      $data = read_csv($_FILES['myfiles']['tmp_name'][0], false, false);
      $table = assoc_arr_to_table($data);
      echo $table;
      die();

    } catch (Exception $e) {
      if ((!isset($_FILES['myfiles']['type'][0])) && ($_FILES['myfiles']['type'] != "text/csv")) {
        echo "Datatables only for csv-formatted files";
        die();
      } else if ($_FILES['myfiles']['type'] == "text/csv") {
        $data = read_csv($_FILES['myfiles']['tmp_name'][$i]);
        $table = assoc_arr_to_table($data, true);
        echo $table;
        die();
      } else {
        echo "Datatables only for csv-formatted files";
        die();
      }
    }


    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    // die();
  }
?>
<br>

<div class="row">
  <div class="col-md-10 col-md-offset-1 text-center">
    <form id="myform" method="post" enctype="multipart/form-data">
       <input type="file" id="myfiles" name="myfiles[]" multiple>
       <button class="btn btn-default" type="submit">Upload File(s)</button>
    </form>
  </div>
</div>
<div id="output"></div>

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
