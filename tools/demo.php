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
?>
<br><br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 revealable">
      <span class="content">   The answer is 42</span>
    </div>
  </div>

</body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    var $body = $('.revealable').find('.content');
    $body.before('<span class="showme"><i class="glyphicon glyphicon-plus" style="color:blue"></i></span>');
    $body.hide();
  });



  $('.revealable').click(function() {
    var $body = $(this).closest('.revealable').find('.content');
    $('.content').show('slow', 'linear');
  });
</script>
