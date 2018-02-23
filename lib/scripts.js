function debug(data, output) {
  console.log(data);
  var stuff = "<table class=\"table table-bordered\"><thead>"+
                  "<tr><th class=\"col-md-2 text-center\">Field</th><th class=\"col-md-9 text-center\">Value</th></tr></thead><tbody>";
        for(var key in data) {
          if (key == 'get' || key == 'post' || key == 'args' || key == 'user' || key == 'type') {
            stuff += "<tr><td class=\"col-md-2\">"+key+"</td><td> ";
            if (data[key] == "" || typeof data[key] == 'undefined') {
              stuff += "N/A ";
            } else {
              for (var datapoint in data[key]) {
                stuff+= " <b>"+datapoint+"</b>=\""+data[key][datapoint]+"\" ";
              }
            }
            stuff += "</td></tr>";
          } else {
            stuff += "<tr><td class=\"col-md-2\">"+key+"</td><td class=\"col-md-9\">"+data[key]+"</td></tr>";
          }
        }
      stuff += "</tbody></table>";
      document.getElementById(output).innerHTML = (stuff);
}

function error_log(data, output) {
  var stuff = "<br><table class=\"table table-bordered\"><thead>"+
              "<tr><th>No.</th><th>Error</th></tr>"
  for (var i = 0; i < data.length-1; i++) {
    stuff += "<tr><td>"+(i+1)+"</td><td>"+data[i]+"</td></tr>";
  }
  document.getElementById(output).innerHTML = stuff;
}

function universalAjax(form, func, action = '', method = 'post', output = 'output') {
  var xhttp = new XMLHttpRequest();
  if (form != null) {
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(xhttp.response);
        console.log(data);
        func(data, output);
      }
    };
    xhttp.open(form.method, form.action, true);
    xhttp.send(new FormData(form));

  } else {
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(xhttp.response);
        console.log(data);
        func(data, output);
      }
    };
    xhttp.open(method, action, true);
    xhttp.send(null);

  }

  return false;
}
