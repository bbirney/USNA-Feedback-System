<?php
  if (!isset($API_PATH)) die();

  if (isset($_REQUEST['msg'])) {
    $query_fields = array(USER['user'], $_REQUEST['msg']);
    $stmt = build_query($db, "INSERT INTO message_board (user, msg) VALUES (?, ?)", $query_fields);
    $stmt->close();
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
      $blurb .= "<div class=\"contain\"";
      if ($this->name == USER['user']) $blurb .= "style=\"text-align:right;\"";
      $blurb .= ">";
      $blurb .= ($this->name)."<br>";
      $blurb .=  "<div class=\"jumbotron mb ";
      if ($this->name == USER['user']) $blurb .= "bg-active";
      $blurb .= "\">";
      $blurb .= ($this->msg);
      $blurb .= "</div><br>";
      $blurb .= "</div>";
      if ($this->name == USER['user']) $blurb .= "<br>";

      return $blurb;
    }
  }


  $stmt = build_query($db, "SELECT * FROM message_board", array());
  $stmt->bind_result($user, $time, $msg);

  $mb_content = array();
  for ($i=0;$stmt->fetch();$i++) {
    $mb_content[$i] = new Message($user, $msg, $time);
  }

  for ($i=0;$i<sizeof($mb_content); $i++) {
    echo $mb_content[$i]->create_blurb();
  }


  die();
?>
