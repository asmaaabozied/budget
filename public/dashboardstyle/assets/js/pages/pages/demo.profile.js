! function(c) { "use strict";

    function t() { this.$body = c("body"), this.charts = [] }
    t.prototype.respChart = function(t, e, r, a) { var o, n = Chart.controllers.bar.prototype.draw,
            i = (Chart.controllers.bar.draw = function() { n.apply(this, arguments); var t = this.chart.ctx,
                    e = t.fill;
                t.fill = function() { t.save(), t.shadowColor = "rgba(0,0,0,0.01)", t.shadowBlur = 20, t.shadowOffsetX = 4, t.shadowOffsetY = 5, e.apply(this, arguments), t.restore() } }, Chart.defaults.font.color = "#8391a2", Chart.defaults.scale.grid.color = "#8391a2", t.get(0).getContext("2d")),
            s = c(t).parent(); switch (t.attr("width", c(s).width()), e) {
            case "Line":
                o = new Chart(i, { type: "line", data: r, options: a }); break;
            case "Doughnut":
                o = new Chart(i, { type: "doughnut", data: r, options: a }); break;
            case "Pie":
                o = new Chart(i, { type: "pie", data: r, options: a }); break;
            case "Bar":
                o = new Chart(i, { type: "bar", data: r, options: a }); break;
            case "Radar":
                o = new Chart(i, { type: "radar", data: r, options: a }); break;
            case "PolarArea":
                o = new Chart(i, { data: r, type: "polarArea", options: a }) } return o }, t.prototype.initCharts = function() { var t;
        0 < c("#high-performing-product").length && ((t = document.getElementById("high-performing-product").getContext("2d").createLinearGradient(0, 500, 0, 150)).addColorStop(0, "#fa5c7c"), t.addColorStop(1, "#093af4"), t = { labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], datasets: [{ label: "Orders", backgroundColor: t, borderColor: t, hoverBackgroundColor: t, hoverBorderColor: t, data: [65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81] }, { label: "Revenue", backgroundColor: "#e3eaef", borderColor: "#e3eaef", hoverBackgroundColor: "#e3eaef", hoverBorderColor: "#e3eaef", data: [89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 65, 59] }] }, [].push(this.respChart(c("#high-performing-product"), "Bar", t, { maintainAspectRatio: !1, datasets: { bar: { barPercentage: .7, categoryPercentage: .5 } }, plugins: { legend: { display: !1 } }, scales: { y: { grid: { display: !1, color: "rgba(0,0,0,0.05)" }, stacked: !1, ticks: { stepSize: 20 } }, x: { stacked: !1, grid: { color: "rgba(0,0,0,0.01)" } } } }))) }, t.prototype.init = function() { var e = this;
        Chart.defaults.font.family = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif', e.charts = this.initCharts(), c(window).on("resize", function(t) { c.each(e.charts, function(t, e) { try { e.destroy() } catch (t) {} }), e.charts = e.initCharts() }) }, c.Profile = new t, c.Profile.Constructor = t }(window.jQuery),
function() { "use strict";
    window.jQuery.Profile.init() }();