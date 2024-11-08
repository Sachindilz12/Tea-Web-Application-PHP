
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawsales2019);
google.charts.setOnLoadCallback(drawsales2020);
google.charts.setOnLoadCallback(drawsales2021);
google.charts.setOnLoadCallback(drawsales2022);
google.charts.setOnLoadCallback(drawsales2023);
google.charts.setOnLoadCallback(drawsalesjan);
google.charts.setOnLoadCallback(drawsalesfeb);
google.charts.setOnLoadCallback(drawsalesmar);
google.charts.setOnLoadCallback(drawsalesapr);
google.charts.setOnLoadCallback(drawsalesmay);
google.charts.setOnLoadCallback(drawsalesjun);
google.charts.setOnLoadCallback(drawsalesjul);
google.charts.setOnLoadCallback(drawsalesaug);
google.charts.setOnLoadCallback(drawsalessept);
google.charts.setOnLoadCallback(drawsalesoct);
google.charts.setOnLoadCallback(drawsalesnov);
google.charts.setOnLoadCallback(drawsalesdec);
google.charts.setOnLoadCallback(drawsalesgross);


function drawsales2019() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Sales'],
    ['Jan',  77690290],
    ['Feb',  63490510],
    ['Mar',  59043160],
    ['Apr', 73220330],
    ['May',  58873110],
    ['Jun',  35394960],
    ['Jul',  51119275],
    ['Aug',  9282470],
    ['Sept',  26574670],
    ['Oct',  42534310],
    ['Nov',  28052340],
    ['Dec',  36586220]
  ]);
  var options = {
    title: 'Gross Sales Monthly for the year 2019',
    hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };
  var chart = new google.visualization.AreaChart(document.getElementById('sales2019'));
  chart.draw(data, options);
}

function drawsales2020() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Sales'],
    ['Jan',  26987800],
    ['Feb',  23189210],
    ['Mar',  17759250],
    ['Apr',  20094895],
    ['May',  14227390],
    ['Jun',  25003610],
    ['Jul',  28955660],
    ['Aug',  36938130],
    ['Sept',  59309280],
    ['Oct',  49369700],
    ['Nov',  57404750],
    ['Dec',  50918540]
  ]);
  var options = {
    title: 'Gross Sales Monthly for the year 2020',
    hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };
  var chart = new google.visualization.AreaChart(document.getElementById('sales2020'));
  chart.draw(data, options);
}

function drawsales2021() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Sales'],
    ['Jan',  54337540],
    ['Feb',  31413470],
    ['Mar',  40283020],
    ['Apr',  35178500],
    ['May',  21011580],
    ['Jun',  28574350],
    ['Jul',  28198770],
    ['Aug',  38634910],
    ['Sept',  25048970],
    ['Oct',  21754480],
    ['Nov',  32836390],
    ['Dec',  22539450]
  ]);
  var options = {
    title: 'Gross Sales Monthly for the year 2021',
    hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };
  var chart = new google.visualization.AreaChart(document.getElementById('sales2021'));
  chart.draw(data, options);
}
function drawsales2022() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Sales'],
    ['Jan',  37443150],
    ['Feb',  34158880],
    ['Mar',  45042370],
    ['Apr',  43362550],
    ['May',  72740910],
    ['Jun',  68717080],
    ['Jul',  72311780],
    ['Aug',  54974770],
    ['Sept',  52065230],
    ['Oct',  58273320],
    ['Nov',  53919830],
    ['Dec',  47805410]
  ]);
  var options = {
    title: 'Gross Sales Monthly for the year 2022',
    hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };
  var chart = new google.visualization.AreaChart(document.getElementById('sales2022'));
  chart.draw(data, options);
}

function drawsales2023() {
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Sales'],
    ['Jan',  60606820],
    ['Feb',  42381140],
    ['Mar',  43002080],
    ['Apr',  26360200],
    ['May',  54703680],
    ['Jun',  56953610],
    ['Jul',  45875390],
    ['Aug',  46365020],
    ['Sept',  18841960],
    ['Oct',  24260870],
    ['Nov',  44255710],
    ['Dec',  27808450]
  ]);
  var options = {
    title: 'Gross Sales Monthly for the year 2023',
    hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };
  var chart = new google.visualization.AreaChart(document.getElementById('sales2023'));
  chart.draw(data, options);
}

function drawsalesjan() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Jan 2019',  77690290],
      ['Jan 2020',  26987800],
      ['Jan 2021',  54337540],
      ['Jan 2022',  37443150],
      ['Jan 2023',  60606820],
      ['Jan 2024',  38966850]
    ]);
  
    var options = {
      title: 'Gross Sales January',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesjan'));
    chart.draw(data, options);
  }

  function drawsalesfeb() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Feb 2019',  63490510],
      ['Feb 2020',  23189210],
      ['Feb 2021',  31413470],
      ['Feb 2022',  34158880],
      ['Feb 2023',  42381140],
    
    ]);
  
    var options = {
      title: 'Gross Sales February',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesfeb'));
    chart.draw(data, options);
  }

  function drawsalesmar() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Mar 2019',  63490510],
      ['Mar 2020',  23189210],
      ['Mar 2021',  31413470],
      ['Mar 2022',  34158880],
      ['Mar 2023',  42381140],
    
    ]);
  
    var options = {
      title: 'Gross Sales March',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesmar'));
    chart.draw(data, options);
  }

  function drawsalesapr() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Apr 2019',  73220330],
      ['Apr 2020',  20094895],
      ['Apr 2021',  35178500],
      ['Apr 2022',  43362550],
      ['Apr 2023',  26360200],
    
    ]);
  
    var options = {
      title: 'Gross Sales April',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesapr'));
    chart.draw(data, options);
  }

  function drawsalesmay() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['May 2019',  58873110],
      ['May 2020',  14227390],
      ['May 2021',  21011580],
      ['May 2022',  72740910],
      ['May 2023',  54703680],
    
    ]);
  
    var options = {
      title: 'Gross Sales May',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesmay'));
    chart.draw(data, options);
  }

  function drawsalesjun() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['June 2019',  73220330],
      ['June 2020',  20094895],
      ['June 2021',  35178500],
      ['June 2022',  43362550],
      ['June 2023',  26360200],
    
    ]);
  
    var options = {
      title: 'Gross Sales June',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesjun'));
    chart.draw(data, options);
  }

  function drawsalesjul() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['July 2019',  51119275],
      ['July 2020',  28955660],
      ['July 2021',  28198770],
      ['July 2022',  72311780],
      ['July 2023',  45875390],
    
    ]);
  
    var options = {
      title: 'Gross Sales July',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesjul'));
    chart.draw(data, options);
  }

  function drawsalesaug() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Aug 2019',  9282470],
      ['Aug 2020',  36938130],
      ['Aug 2021',  38634910],
      ['Aug 2022',  54974770],
      ['Aug 2023',  46365020],
    
    ]);
  
    var options = {
      title: 'Gross Sales Auguest',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesaug'));
    chart.draw(data, options);
  }

  function drawsalessept() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Sept 2019',  73220330],
      ['Sept 2020',  20094895],
      ['Sept 2021',  35178500],
      ['Sept 2022',  43362550],
      ['Sept 2023',  26360200],
    
    ]);
  
    var options = {
      title: 'Gross Sales September',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salessept'));
    chart.draw(data, options);
  }

  function drawsalesoct() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Oct 2019',  42534310],
      ['Oct 2020',  49369700],
      ['Oct 2021',  21754480],
      ['Oct 2022',  58273320],
      ['Oct 2023',  24260870],
    
    ]);
  
    var options = {
      title: 'Gross Sales October',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesoct'));
    chart.draw(data, options);
  }

  function drawsalesnov() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Nov 2019',  28052340],
      ['Nov 2020',  57404750],
      ['Nov 2021',  32836390],
      ['Nov 2022',  53919830],
      ['Nov 2023',  44255710],
    
    ]);
  
    var options = {
      title: 'Gross Sales November',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesnov'));
    chart.draw(data, options);
  }

  function drawsalesdec() {
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
      ['Dec 2019',  36586220],
      ['Dec 2020',  50918540],
      ['Dec 2021',  22539450],
      ['Dec 2022',  47805410],
      ['Dec 2023',  27808450],
    
    ]);
  
    var options = {
      title: 'Gross Sales December',
      hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
  
    var chart = new google.visualization.AreaChart(document.getElementById('salesdec'));
    chart.draw(data, options);
  }

  function drawsalesgross() {
  var data = google.visualization.arrayToDataTable([
    ['Year', 'Sales'],
    ['2019',  561861645],
    ['2020',  410158215],
    ['2021',  379811430],
    ['2022',  640815280],
    ['2023',  491414930]
    
  ]);
  var options = {
    title: 'Gross Sales Yearly',
    hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };
  var chart = new google.visualization.AreaChart(document.getElementById('sales_gross'));
  chart.draw(data, options);
  
}