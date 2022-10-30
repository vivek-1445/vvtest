var options = {
    chart: { height: 360, type: "area", stacked: !0, toolbar: { show: !1 }, zoom: { enabled: !0 } },
    plotOptions: { bar: { horizontal: !1, columnWidth: "15%", endingShape: "rounded" } },
    dataLabels: { enabled: !1 },
    series: [
        { name: "Users", data: [44, 55, 41] },
        { name: "Partners", data: [13, 23, 20] },
        { name: "Revenue", data: [11, 17, 15] },
    ],
    xaxis: { categories: ["Jan", "Feb", "Mar"] },
    colors: ["#556ee6", "#f1b44c", "#34c38f"],
    legend: { position: "bottom" },
    fill: { opacity: 1 },
},
    chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options);
chart.render();

