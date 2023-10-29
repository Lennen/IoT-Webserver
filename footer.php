</main>
    </div>
  </div>
 

  <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <script src="/dashboard.js"></script>
  
  <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
  <style>
          .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            text-transform: uppercase;
          }

          .btn-link {
            font-weight: 700;
            color: #000000;
            color: #525050;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 20px;
          }

          .btn-link:hover {
            text-decoration: none;
            color: #525050;
          }

          .badge-primary {
            background: #5351B9;
          }
        </style>
  <script>
    // Instantiate bar chart and container
    const barChart2 = britecharts.donut();
    const legend2 = britecharts.legend();
    const container2 = d3.select('.bar-container2');
    const legendContainer2 = d3.select('.js-chart-legend2');

    barData2 = [{
        quantity: 1,
        percentage: 10,
        name: 'От 1 года',
        id: 1
      },
      {
        quantity: 10,
        percentage: 90,
        name: 'Из 10 лет возможного стажа',
        id: 1
      },
    ];
    // Create Dataset with proper shape

    // Configure chart
    var containerWidth = 250;
    barChart2
      .highlightSliceById(1)
      .isAnimated(true)
      .percentageFormat('0.0f')
      .margin({
        left: 100
      })
      .height(containerWidth)
      .width(containerWidth)
      .externalRadius(containerWidth / 2)
      .internalRadius(containerWidth / 3)
      .on('customMouseOver', function(data) {
        legend2.highlight(data.data.id);
      })
      .on('customMouseOut', function() {
        legend2.clearHighlight();
      });

    legend2
      .width(containerWidth * 2)
      .height(containerWidth * 0.8)
      .numberFormat('.0f');

    container2.datum(barData2).call(barChart2);
    legendContainer2.datum(barData2).call(legend2);
  </script>

  <script>
    // Instantiate bar chart and container
    const barChart3 = britecharts.donut();
    const legend3 = britecharts.legend();
    const container3 = d3.select('.bar-container3');
    const legendContainer3 = d3.select('.js-chart-legend3');

    barData3 = [{
        quantity: 1,
        percentage: 10,
        name: 'Заполнение конструкторской документации',
        id: 1
      },
      {
        quantity: 5,
        percentage: 50,
        name: 'Написание кода на C++',
        id: 2
      },
      {
        quantity: 2,
        percentage: 20,
        name: 'Участие в планерках',
        id: 3
      },
      {
        quantity: 1,
        percentage: 20,
        name: 'Поиск новых путей развития компании',
        id: 3
      }
    ];
    // Create Dataset with proper shape

    // Configure chart
    var containerWidth = 250;
    barChart3
      .isAnimated(true)
      .margin({
        left: 100
      })
      .height(containerWidth)
      .width(containerWidth)
      .externalRadius(containerWidth / 2)
      .internalRadius(containerWidth / 3)
      .on('customMouseOver', function(data) {
        legend3.highlight(data.data.id);
      })
      .on('customMouseOut', function() {
        legend3.clearHighlight();
      });

    legend3
      .width(containerWidth * 2)
      .height(containerWidth * 0.8)
      .numberFormat('.0f');

    container3.datum(barData3).call(barChart3);
    legendContainer3.datum(barData3).call(legend3);
  </script>

  <script>
    // Instantiate bar chart and container
    const barChart4 = britecharts.donut();
    const legend4 = britecharts.legend();
    const container4 = d3.select('.bar-container4');
    const legendContainer4 = d3.select('.js-chart-legend4');

    barData4 = [{
        quantity: 20,
        percentage: 20,
        name: 'С++',
        id: 1
      },
      {
        quantity: 30,
        percentage: 30,
        name: 'STM32F407',
        id: 2
      },
      {
        quantity: 30,
        percentage: 30,
        name: 'GitHub',
        id: 2
      },
      {
        quantity: 20,
        percentage: 20,
        name: 'Пайка SMD',
        id: 2
      },
    ];
    // Create Dataset with proper shape

    // Configure chart
    var containerWidth = 250;
    barChart4
      .highlightSliceById(1)
      .isAnimated(true)
      .percentageFormat('0.0f')
      .margin({
        left: 100
      })
      .height(containerWidth)
      .width(containerWidth)
      .externalRadius(containerWidth / 2)
      .internalRadius(containerWidth / 3)
      .on('customMouseOver', function(data) {
        legend4.highlight(data.data.id);
      })
      .on('customMouseOut', function() {
        legend4.clearHighlight();
      });

    legend4
      .width(containerWidth * 2)
      .height(containerWidth * 0.8)
      .numberFormat('.0f');

    container4.datum(barData4).call(barChart4);
    legendContainer4.datum(barData4).call(legend4);
  </script>

  <script>
    // Instantiate bar chart and container
    const barChart5 = britecharts.donut();
    const legend5 = britecharts.legend();
    const container5 = d3.select('.bar-container5');
    const legendContainer5 = d3.select('.js-chart-legend5');

    barData5 = [{
        quantity: 30,
        percentage: 30,
        name: 'Командная работа',
        id: 1
      },
      {
        quantity: 20,
        percentage: 20,
        name: 'Коммуникабельность',
        id: 2
      },
      {
        quantity: 40,
        percentage: 40,
        name: 'Ответственность',
        id: 3
      },
      {
        quantity: 10,
        percentage: 10,
        name: 'Лояльность',
        id: 1
      },
    ];
    // Create Dataset with proper shape

    // Configure chart
    var containerWidth = 250;
    barChart5
      .highlightSliceById(1)
      .isAnimated(true)
      .percentageFormat('0.0f')
      .margin({
        left: 100
      })
      .height(containerWidth)
      .width(containerWidth)
      .externalRadius(containerWidth / 2)
      .internalRadius(containerWidth / 3)
      .on('customMouseOver', function(data) {
        legend5.highlight(data.data.id);
      })
      .on('customMouseOut', function() {
        legend5.clearHighlight();
      });

    legend5
      .width(containerWidth * 2)
      .height(containerWidth * 0.8)
      .numberFormat('.0f');

    container5.datum(barData5).call(barChart5);
    legendContainer5.datum(barData5).call(legend5);
  </script>

</body>

</html>