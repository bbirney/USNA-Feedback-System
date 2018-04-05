<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Demo for Pt. 1',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'matchups',
                      'position'   => 83,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
                      'access'     => array());
  ###############################################################

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in the NavBar
  require_once(WEB_PATH.'navbar.php');

?>
<div class="container">
  <div class="row text-center">
    <h1>Example Query (Part 1)</h1>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>API Retrieve Data Instructions:</strong><br>
      <ul>
          <li>All URL's are in format: api/KEY/SCRIPT/SpecificCharacter</li>
          <li>Script run is character.php</li>
      </ul>
      <strong>Examples below have these URL's:</strong><br/>
      <ul>
        <li>
          api/[apikey]/character/fox
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center">
      <h3>Fox Matchup Spread</h3>
      <canvas id="myChart" width="400" height="400"></canvas>
    </div>
  </div>
</div>

<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Peach", "Falco", "Falcon", "Sheik", "Marth", "Ice Climbers"],
        datasets: [{
            label: 'Wins (out of 100)',
            data: [23, 69, 89, 63, 42, 86],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    max:100
                }
            }]
        }
    }
});
</script>
