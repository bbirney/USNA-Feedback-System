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

    function __construct($user, $do_well, $improve, $giver, $status, $time, $know) {
      $this->user = $user;
      $this->do_well = $do_well;
      $this->improve = $improve;
      $this->giver = $giver;
      $this->status = $status;
      $this->timestamp = $time;
      $this->know = $know;
    }

    function create_blurb() {
      $blurb =  "<div class=\"jumbotron ";
      if ($this->status == 1)      $blurb .= "bg-success\">";
      else if ($this->status == 0) $blurb .= "bg-danger\">";
      else $blurb .= "\">";

      $blurb .= ($this->user).": <br>";
      $blurb .= "What you do well:<br>";
      $blurb .= ($this->do_well)."<br>";
      $blurb .= "What you can improve:<br>";
      $blurb .= ($this->improve)."<br>";
      $blurb .= "<b>- ".($this->giver)."</b><br>";
      $blurb .= "<br>";
      $blurb .= ($this->timestamp)."<br>";
      $blurb .= "</div>";

      return $blurb;
    }
  }
?>
