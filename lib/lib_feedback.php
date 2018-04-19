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
    public $alpha;
    public $msg;
    public $giver;
    public $timestamp;
    public $status = 2;

    function __construct($alpha, $msg, $giver, $status, $time) {
      $this->alpha = $alpha;
      $this->msg = $msg;
      $this->giver = $giver;
      $this->status = $status;
      $this->timestamp = $time;
    }
  }

  function create_blurb($data) {
    $blurb =  "<div class=\"jumbotron ";
    if ($data->status == 1)      $blurb .= "bg-success\">";
    else if ($data->status == 0) $blurb .= "bg-danger\">";
    else $blurb .= "\">";

    $blurb .= ($data->alpha).": <br>";
    $blurb .= ($data->msg)."<br>";
    $blurb .= "<b>- ".($data->giver)."</b><br>";
    $blurb .= "<br>";
    $blurb .= ($data->timestamp)."<br>";
    $blurb .= "</div>";

    return $blurb;
  }
?>
