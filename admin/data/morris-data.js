$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2017 Q1',
            PHP : 20,
            CSharp: 30,
            cplus: 24
        }, {
            period: '2017 Q2',
            PHP: 33,
            CSharp: 44,
            cplus: 55
        }, {
            period: '2017 Q3',
            PHP: 64,
            C: 22,
            cplus: 33
        }, {
            period: '2017 Q4',
            PHP: 44,
            CSharp: 23,
            cplus: 56
        }, {
            period: '2018 Q1',
            PHP: 74,
            CSharp: 22,
            cplus: 33
        }],
        xkey: 'period',
        ykeys: ['PHP', 'CSharp', 'cplus'],
        labels: ['PHP', 'CSharp', 'cplus'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });
Morris.Line({
  element: 'morris-line-chart',
  data: [
    { y: '2006', a: 1},
    { y: '2007', a: 2},
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Series A']
});
});
