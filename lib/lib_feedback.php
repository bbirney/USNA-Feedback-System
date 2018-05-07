<?php
  function notify($to, $from, $feedback) {
    $to      .= '@usna.edu';
    $subject = 'the subject';
    $msg = $from.' has left you feedback via Feedback v3.0. ';
    $msg .= "Content of message:\n $feedback\n";
    $msg .= "Check it out at midn.cs.usna.edu/~m200516/Lab11/home/welcome_page.php";
    $headers = "From: m200516@usna.edu\r\n".
    "Reply-To: m200516@usna.edu\r\n".
    "X-Mailer: PHP/".phpversion();

    mail($to, $subject, $msg, $headers);
  }

  class Feedback {
    public $user;
    public $do_well;
    public $improve;
    public $giver;
    public $status = 2;
    public $timestamp;
    public $know = 3;
    public $id;
    public $approval = 42;

    function __construct($user, $do_well, $improve, $giver, $status, $time, $know, $id) {
      $this->user = $user;
      $this->do_well = $do_well;
      $this->improve = $improve;
      $this->giver = $giver;
      $this->status = $status;
      $this->timestamp = $time;
      $this->know = $know;
      $this->id = $id;
    }

    function create_blurb($user) {
      $blurb =  "<div class=\"jumbotron ";
      if ($this->status == 1)      $blurb .= "bg-success\">";
      else if ($this->status == 0) $blurb .= "bg-danger\">";
      else $blurb .= "\">";

      $blurb .= "<b>".($this->user).": </b><br>";
      $blurb .= "<b>This person knows you as well as (1-5 scale): </b>".($this->know)."<br><br>";
      $blurb .= "<b>What you do well:</b><br>";
      $blurb .= ($this->do_well)."<br>";
      $blurb .= "<b>What you can improve:</b><br>";
      $blurb .= ($this->improve)."<br><br>";
      $blurb .= "<b>- ".($this->giver)."</b>";
      $blurb .= "<br>";
      $blurb .= ($this->timestamp)."<br>";

      if ($this->approval == 42 && ($this->giver != $user)) {
        //NOTE: Configure 3 buttons (one for good, another for bad, a third for report) THIS WILL BE A FORM
        $blurb .=
        "
        <div class=\"btn-group blurb-icon\">
          <button name=\"helpful\" title=\"This Feedback Was Helpful\" class=\"blurb-icon btn btn-default\" onclick=\"submit_form('1-".$this->id."')\">
            <i class=\"glyphicon glyphicon-thumbs-up blurb-icon\">  </i>
          </button>
          <button name=\"helpful\" title=\"This Feedback Was Not Helpful\" class=\"blurb-icon btn btn-default\" onclick=\"submit_form('0-".$this->id."')\" value=\"0-".$this->id."\">
            <i class=\"glyphicon glyphicon-thumbs-down blurb-icon\"></i>
          </button>
          <button name=\"helpful\" title=\"Report This Feedback\" class=\"blurb-icon btn btn-default\" onclick=\"submit_form('2-".$this->id."')\" value=\"2-".$this->id."\">
            <i class=\"glyphicon glyphicon-warning-sign blurb-icon\"></i>
          </button>
        </div>
        ";
      } else if ($this->approval == 0) {
        //NOTE: Configure 1 glyphicon with a thumbs down
        $blurb .= "<i title=\"This was Bad Feedback\" class=\"glyphicon glyphicon-thumbs-down blurb-icon bad\"></i>";
      } else if ($this->approval == 1) {
        //NOTE: Configure 1 glyphicon with a thumbs up
        $blurb .= "<i title=\"This was Good Feedback\" class=\"glyphicon glyphicon-thumbs-up blurb-icon good\"></i>";
      } else if ($this->approval == 2) {
        //NOTE: Feedback will have been reported, so it won't be shown
        return "";
      } else {
        $blurb .= "<i title=\"Feedback Not Yet Seen\" class=\"glyphicon glyphicon-eye-close blurb-icon\"></i>";
      }

      $blurb .= "</div>";

      return $blurb;
    }

    function setApp($approval) {
      $this->approval = $approval;
    }
  }
?>
