const pieData = {
  labels: ["Avance", "Pendiente"],
  datasets: [
    {
      data: [72, 28],
      backgroundColor: ["#4EADEB", "#3F86CB"],
      hoverOffset: 4,
    },
  ],
};

var myPieGraph = document.getElementById("myPieChart");
var pieCtx = myPieGraph.getContext("2d");

var myPieChart = new Chart(pieCtx, {
  /* IMPORTANTE: cargamos el complemento */
  plugins: [ChartDataLabels],
  type: "pie",
  data: pieData,
  options: {
    plugins: {
      datalabels: {
        /* anchor puede ser "start", "center" o "end" */
        anchor: "center",
        /* Podemos modificar el texto a mostrar */
        formatter: (dato) => dato + "%",
        /* Color del texto */
        color: "black",
        /* Formato de la fuente */
        font: {
          family: '"Times New Roman", Times, serif',
          size: "28",
          weight: "bold",
        },
        /* Formato de la caja contenedora */
        //padding: "4",
        //borderWidth: 2,
        //borderColor: "darkblue",
        //borderRadius: 8,
        //backgroundColor: "lightblue"
      },
    },
  },
});
