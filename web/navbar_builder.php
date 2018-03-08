<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <?php
        echo "<ul class=\"nav navbar-nav\">";

        for ($i = 0; $i < sizeof($NAVBAR); $i++) {
          //safe guards for php error wall / EVIL users
          if (!isset($NAVBAR[$i]['caret'])) { $NAVBAR[$i]['caret'] = 0;    }
          if (!isset($NAVBAR[$i]['caret'])) { $NAVBAR[$i]['action'] = '#'; }
          if (!isset($NAVBAR[$i]['text']))  { $NAVBAR[$i]['text'] = '';    }
          if (!isset($NAVBAR[$i]['title'])) { $NAVBAR[$i]['title'] = '';   }
          if (!isset($NAVBAR[$i]['icon']))  { $NAVBAR[$i]['icon'] = '';    }
          if (!isset($NAVBAR[$i]['type']))  { $NAVBAR[$i]['type'] = '';    }
          if (!isset($NAVBAR[$i]['url']))   { $NAVBAR[$i]['url'] = '#';    }
          if (!isset($NAVBAR[$i]['field'])) { $NAVBAR[$i]['field'] = '';   }
          if (!isset($NAVBAR[$i]['rtext'])) { $NAVBAR[$i]['rtext'] = '';   }
          if (!isset($NAVBAR[$i]['ltext'])) { $NAVBAR[$i]['ltext'] = '';   }

          if ($NAVBAR[$i]['type'] == "dropdown") {
            echo "<li class=\"dropdown\">";
            echo    "<a href=\"".$NAVBAR[$i]['url']."\" title=\"".$NAVBAR[$i]['title']."\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">";
            echo      $NAVBAR[$i]['ltext']." <span class=\"glyphicon ".$NAVBAR[$i]['icon']."\" aria-hidden=\"true\"></span>";
            if ($NAVBAR[$i]['caret'] == 1) {
            echo      "<span class=\"caret\"></span>";
            }
            echo $NAVBAR[$i]['rtext'];
            echo    "</a>";
            echo    "<ul class=\"dropdown-menu  scrollable-menu\">";

            for ($j=0; $j < sizeof($NAVBAR[$i]['options']); $j++) {
              if ($NAVBAR[$i]['options'][$j]['type'] == "url") {
                echo  "<li><a title=\"".$NAVBAR[$i]['options'][$j]['title']."\" href='".$NAVBAR[$i]['options'][$j]['url']."'>".$NAVBAR[$i]['options'][$j]['text']."</a></li>";
              } else {
                echo   "<li class=\"text-center\"><hr></li>";
              }
            }
            echo     "</ul>";
            echo "</li>";
          } elseif ($NAVBAR[$i]['type'] == "url") {
            echo "<li class=\"url\">
                    <a title=\"".$NAVBAR[$i]['title']."\" href=\"".$NAVBAR[$i]['url']."\">
                      ".$NAVBAR[$i]['ltext'];
                      if (isset($NAVBAR[$i]['icon'])) {echo "<span class=\"glyphicon ".$NAVBAR[$i]['icon']."\" aria-hidden=\"true\"></span>";}
            echo      $NAVBAR[$i]['rtext']."
                    </a>
                  </li>";
          } elseif ($NAVBAR[$i]['type'] == "direct") {
            foreach ($NAVBAR[$i]['text'] as $key => $value) {
              echo "<li class=\"direct\">$value</li>";
            }
          } elseif ($NAVBAR[$i]['type'] == "seperator") {
            echo "</ul>";
            echo "<ul class=\"nav navbar-nav navbar-right\">";
          } elseif ($NAVBAR[$i]['type'] == "search") {
            echo "<li><form method=\"post\" class=\"navbar-form\" role=\"search\" action=\"".$NAVBAR[$i]['action']."\">
              <div class=\"input-group\">
                  <input type=\"text\" class=\"form-control\" placeholder=\"Search\" name=\"".$NAVBAR[$i]['field']."\">
                  <div class=\"input-group-btn\">
                    <button title=\"".$NAVBAR[$i]['title']."\" class=\"btn btn-default form-control\" type=\"submit\"><i class=\"glyphicon ".$NAVBAR[$i]['icon']."\"></i></button>
                  </div>
              </div>
            </form></li>";
          }
        }

        echo "</ul>";
      ?>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br><br><br>
