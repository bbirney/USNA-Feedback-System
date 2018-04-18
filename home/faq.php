<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Give Feedback',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'give_feedback',
                      'position'   => 99,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
                      'access'     => array());
  ###############################################################

  $PAGE_TITLE = "FAQ";

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');
?>
  <h1 class="text-center">What is Good Feedback?</h1>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <br>
      <div class="jumbotron">
        <ol>
          <li>Be Direct
            <ul><li>
                People are often afraid of being direct with negative feedback
                and they try to cushion the negative feedback by not openly
                addressing problems. Be honest, direct, and respectful.
            </li></ul>
          </li>
          <li>Be Specific
            <ul><li>
                Always offer concrete examples or facts to back up feedback.
                Generalizations are good for evaluations; however the purpose
                of feedback is for the individual to improve. Providing
                specifics allows the receiver to better focus on the problem
                and remedy it.
            </li></ul>
          </li>
          <li>Positive feedback is equally important as  negative feedback
            <ul><li>
                The purpose of positive feedback is to allow a midshipman to
                identify what he/she is doing right and to capitalize on
                his/her strengths.
            </li><li>
                Positive feedback is not just "Good Job." Positive feedback is
                specifically identifying what the person is doing right. Ex:
                " You are a really good squad leader" is not feedback. "Good
                work in having weekly fire team meetings; those meetings promote
                unity among the squad and are good opportunities to train and
                pass word" is feedback.
            </li></ul>
          </li>
          <li>Goal referenced
            <ul><li>
                Feedback should always be in reference to an overall goal. For
                midshipmen, this goal is becoming commissioned officers. When
                identifying a problem, make sure to point out why it is
                counteractive to the goal the team is aiming for.
            </li></ul>
          </li>
          <li>Respect
            <ul><li>
                Keep things objective; injecting emotion or anger into feedback
                distracts from its meaning and often makes things less direct
                or vague. Attacking people for their faults will not help them
                improve; objectively pointing out what they need to work on
                will help them improve.
            </li></ul>
          </li>
        </ol>
    </div>
    </div>
  </div>

</body>
</html>
