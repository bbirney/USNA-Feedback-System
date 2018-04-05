<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Make-A-Query',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'tools',
                      'position'   => 0,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
                      'access'     => array(/*'admin', 'db' */));
  ###############################################################

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  require_once(WEB_PATH.'navbar.php');

  $key = retrieve_apikey($db, USER['user']);
?>
<script>
  $(document).ready(function(){
    $("#form").submit(function(e){
      $.ajax({
        url: "../api/<?php echo $key['apikey'] ?>/query",
        method: "post",
        data: $("#form").serialize(),
        success: function(result) {
          console.log(result);
          $("#output").html(data_to_table(result));
          $("#input").html("");
        }
      });
      e.preventDefault();
    });
  });
  
  function data_to_table(arr) {
    var table = "<table><thead><tr>";

    for (var key in arr.keys()) {
      table += "<td>"+key+"</td>";
    }

    table += "</tr></thead><tbody>";

    for (var key in arr) {
      table += "<tr>";
      for (var val in key) {
        table += "<td>"+val+"</td>";
      }
      table += "</tr>";
    }

    table += "</tbody></table>";

    return table;
  }
</script>
  <br><br><br>
  <div class="row" id="input">
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
</body>
</html>
