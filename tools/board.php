<?php
  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Give Feedback',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'give_feedback',
                      'position'   => 2,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => false,
                      'access'     => array());
  ###############################################################

  $PAGE_TITLE = "Message Board";

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');

  if (isset($_REQUEST['msg'])) {
    $query_fields = array(USER['user'], $_REQUEST['msg']);
    $stmt = build_query($db, "INSERT INTO message_board (user, msg) VALUES (?, ?)", $query_fields);
    $stmt->close();
    unset($_REQUEST);
  }

  $api_data = retrieve_apikey($db, USER['user']);

  if (count($api_data) < 1) {
    generate_apikey($db, USER['user']);
    $api_data = retrieve_apikey($db, USER['user']);
  }
?>
<br><br>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="row scrollable" id="content"></div>
      <form id='myform'>
        <div class="input-group">
          <input type="text" class="form-control" name="msg" aria-describedby="basic-addon3" placeholder="Type a Message...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Submit</button>
          </span>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#content').load('../api/<?php echo $api_data['apikey']; ?>/board');
    setInterval(
      function(){
        $('#content').load('../api/<?php echo $api_data['apikey']; ?>/board');
      },
      5000);

      window.setInterval(function() {
        var board = $('#content');
        board.scrollTop = board.scrollHeight;
      }, 10000);

      $('#myform').submit(function(e){
        $.ajax({
          url: '../api/<?php echo $api_data['apikey']; ?>/board',
          data: $("#myform").serialize(),
          success: function(result) {
            $('#content').html(result);
            $('input[type="text"], textarea').val('');
            $('input[type="text"], textarea').focus();
            $('#content').scrollTo(0,$('#content').scrollHeight);
            var board = document.getElementById('content');
            board.scrollTop = board.scrollHeight;
          }
        });
        e.preventDefault();
    });
  });

</script>
