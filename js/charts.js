

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawweight2019);
google.charts.setOnLoadCallback(drawweight2020);
google.charts.setOnLoadCallback(drawweight2021);
google.charts.setOnLoadCallback(drawweight2022);
google.charts.setOnLoadCallback(drawweight2023);
google.charts.setOnLoadCallback(drawweightjan);
google.charts.setOnLoadCallback(drawweightfeb);
google.charts.setOnLoadCallback(drawweightmar);
google.charts.setOnLoadCallback(drawweightapr);
google.charts.setOnLoadCallback(drawweightmay);
google.charts.setOnLoadCallback(drawweightjun);
google.charts.setOnLoadCallback(drawweightjul);
google.charts.setOnLoadCallback(drawweightaug);
google.charts.setOnLoadCallback(drawweightsept);
google.charts.setOnLoadCallback(drawweightoct);
google.charts.setOnLoadCallback(drawweightnov);
google.charts.setOnLoadCallback(drawweightdec);
google.charts.setOnLoadCallback(drawweightgross);


function drawweight2019() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Weight'],
    ['Jan',  442890],
    ['Feb',  415268],
    ['Mar',  637060],
    ['Apr',  592732],
    ['May',  617422],
    ['Jun',  434418],
    ['Jul',  325415],
    ['Aug',  364229],
    ['Sept', 358016],
    ['Oct',  284569],
    ['Nov',  200572],
    ['Dec',  230566]
  ]);
  var options = {
    title: 'Gross Weight Monthly for the year 2019',
    hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };
  var chart = new google.visualization.AreaChart(document.getElementById('weight2019'));
  chart.draw(data, options);
}

function drawweight2020() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Weight'],
    ['Jan',  198668],
    ['Feb',  165580],
    ['Mar',  92268],
    ['Apr',  114227],
    ['May',  233724],
    ['Jun',  228603],
    ['Jul',  376232],
    ['Aug',  447104],
    ['Sept',  504566],
    ['Oct',  525167],
    ['Nov',  391139],
    ['Dec',  482416]
  ]);

  var options = {
    title: 'Gross Weight Monthly for the year 2020',
    hAxis: {title: 'Month', titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('weight2020'));
  chart.draw(data, options);
}

function drawweight2021() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Weight'],
    ['Jan',  251803],
    ['Feb',  244732],
    ['Mar',  412895],
    ['Apr',  458762],
    ['May',  352618],
    ['Jun',  277965],
    ['Jul',  323093],
    ['Aug',  254739],
    ['Sept', 206573],
    ['Oct',  238209],
    ['Nov',  324915],
    ['Dec',  257922]
  ]);

  var options = {
    title: 'Gross Weight Monthly for the year 2021',
    hAxis: {title: 'Month', titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('weight2021'));
  chart.draw(data, options);
}

function drawweight2022() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Weight'],
    ['Jan',  245225],
    ['Feb',  226112],
    ['Mar',  277044],
    ['Apr',  311290],
    ['May',  331191],
    ['Jun',  223981],
    ['Jul',  193836],
    ['Aug',  179871],
    ['Sept',  241699],
    ['Oct',  204484],
    ['Nov',  258903],
    ['Dec',  128595]
  ]);

  var options = {
    title: 'Gross Weight Monthly for the year 2022',
    hAxis: {title: 'Month', titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('weight2022'));
  chart.draw(data, options);
}

function drawweight2023() {
  var data = google.visualization.arrayToDataTable([
      ['Month', 'Weight'],
    ['Jan',  170558],
    ['Feb',  222985],
    ['Mar',  199176],
    ['Apr',  296054],
    ['May',  284596],
    ['Jun',  278157],
    ['Jul',  237389],
    ['Aug',  63410],
    ['Sept', 86353],
    ['Oct',  305817],
    ['Nov',  148203],
    ['Dec',  128595]
  ]);

  var options = {
    title: 'Gross Weight Monthly for the year 2023',
    hAxis: {title: 'Month', titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('weight2023'));
  chart.draw(data, options);
}

function drawweightjan() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Jan 2019',  442890],
      ['Jan 2020',  198668],
      ['Jan 2021',  251803],
      ['Jan 2022',  245225],
      ['Jan 2023',  170558],
    
    ]);
  
    var options = {
      title: 'Gross Weight January',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightjan'));
    chart.draw(data, options);
  }
  
  function drawweightfeb() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Feb 2019',  415268],
      ['Feb 2020',  165580],
      ['Feb 2021',  255732],
      ['Feb 2022',  226112],
      ['Feb 2023',  222985],
    
    ]);
  
    var options = {
      title: 'Gross Weight February',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightfeb'));
    chart.draw(data, options);
  }
  
  function drawweightmar() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Mar 2019',  637060],
      ['Mar 2020',  92268],
      ['Mar 2021',  412895],
      ['Mar 2022',  277044],
      ['Mar 2023',  199176],
    
    ]);
  
    var options = {
      title: 'Gross Weight March',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightmar'));
    chart.draw(data, options);
  }

  function drawweightapr() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Apr 2019',  592732],
      ['Apr 2020',  114227],
      ['Apr 2021',  0],
      ['Apr 2022',  311290],
      ['Apr 2023',  296054],
    
    ]);
  
    var options = {
      title: 'Gross Weight April',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightapr'));
    chart.draw(data, options);
  }

  function drawweightmay() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['May 2019',  117412],
      ['May 2020',  233724],
      ['May 2021',  352618],
      ['May 2022',  331191],
      ['May 2023',  284596],
    
    ]);
  
    var options = {
      title: 'Gross Weight May',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightmay'));
    chart.draw(data, options);
  }

  function drawweightjun() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['June 2019',  434418],
      ['June 2020',  228603],
      ['June 2021',  277965],
      ['June 2022',  223981],
      ['June 2023',  278157],
    
    ]);
  
    var options = {
      title: 'Gross Weight June',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightjun'));
    chart.draw(data, options);
  }

  function drawweightjul() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['July 2019',  0],
      ['July 2020',  376232],
      ['July 2021',  323093],
      ['July 2022',  193836],
      ['July 2023',  237389],
    
    ]);
  
    var options = {
      title: 'Gross Weight July',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightjul'));
    chart.draw(data, options);
  }

  function drawweightaug() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Aug 2019',  364229],
      ['Aug 2020',  447104],
      ['Aug 2021',  254739],
      ['Aug 2022',  179871],
      ['Aug 2023',  63410],
    
    ]);
  
    var options = {
      title: 'Gross Weight Auguest',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightaug'));
    chart.draw(data, options);
  }

  function drawweightsept() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Sept 2019',  35816],
      ['Sept 2020',  504566],
      ['Sept 2021',  206573],
      ['Sept 2022',  241699],
      ['Sept 2023',  86353],
    
    ]);
  
    var options = {
      title: 'Gross Weight September',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightsept'));
    chart.draw(data, options);
  }

  function drawweightoct() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Oct 2019',  284569],
      ['Oct 2020',  525167],
      ['Oct 2021',  238209],
      ['Oct 2022',  204484],
      ['Oct 2023',  305817],
    
    ]);
  
    var options = {
      title: 'Gross Weight October',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightoct'));
    chart.draw(data, options);
  }

  function drawweightnov() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Nov 2019',  200572],
      ['Nov 2020',  525167],
      ['Nov 2021',  238209],
      ['Nov 2022',  258903],
      ['Nov 2023',  148203],
    
    ]);
  
    var options = {
      title: 'Gross Weight November',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightnov'));
    chart.draw(data, options);
  }

  function drawweightdec() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Weight'],
      ['Dec 2019',  230566],
      ['Dec 2020',  482416],
      ['Dec 2021',  257922],
      ['Dec 2022',  158018],
      ['Dec 2023',  128595],
    
    ]);
  
    var options = {
      title: 'Gross Weight December',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('weightdec'));
    chart.draw(data, options);
  }





function drawweightgross() {
  var data = google.visualization.arrayToDataTable([
    ['Year', 'Weight'],
    ['2019',  4903157],
    ['2020',  3759694],
    ['2021',  3604226],
    ['2022',  2851654],
    ['2023',  2421293]
  ]);

  var options = {
    title: 'Gross Weight yearly',
    hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('weight_gross'));
  chart.draw(data, options);
}
