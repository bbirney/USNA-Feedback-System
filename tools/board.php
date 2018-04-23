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
                      'guest'      => true,
                      'access'     => array());
  ###############################################################

  $PAGE_TITLE = "View Feedback";

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');

  function update_board() {
  }


  class Message {
    public $name;
    public $msg;
    public $time;

    function __construct($name, $msg, $time) {
      $this->name = $name;
      $this->msg = $msg;
      $this->time = $time;
    }

    function create_blurb() {
      $blurb =  "<div class=\"jumbotron mb\"";
      $blurb .= ($this->msg);
      $blurb .= "</div>";
      $blurb .= ($this->name)." (".($this->time).")<br>";

      return $blurb;
    }
  }
?>
<br><br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="row scrollable" id="content"></div>
      <form id='myform'>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Message: </span>
          <input type="text" class="form-control" name="myinfo" aria-describedby="basic-addon3">
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
  setInterval(function() {
    $('#content').load('../api/<?php echo retrieve_apikey($db, USER['user'])['apikey']; ?>/board');
  }, 5000);
</script>
