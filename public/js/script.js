(function () {
    var clockElement = document.getElementById( "clock" );

    function updateClock ( clock ) {
      clock.innerHTML = new Date().toLocaleTimeString();
    }

    setInterval(function () {
        updateClock( clockElement );
    }, 1000);

}());

// Fungsi untuk mengambil data dari elemen HTML
function getDataFromHTML() {
    const dataValues = [0, 0, 0, 0, 0, 0, 0];
    const labels = [];

    // Mengambil data dari elemen HTML
    const dateElements = document.querySelectorAll('#count-date-values span');

    dateElements.forEach(element => {
        const date = element.getAttribute('data-date');
        const count = parseInt(element.getAttribute('data-count'));
        const index = labels.length;

        labels.push(date);
        dataValues[index] = count;
    });

    return { labels, dataValues };
}

// Fungsi untuk menggambar chart
function drawChart() {
    const { labels, dataValues } = getDataFromHTML();

    // Data untuk chart
    const data = {
        labels: labels,
        datasets: [{
            label: 'Completed Task',
            data: dataValues,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    // Mengambil elemen canvas
    const ctx = document.getElementById('myChart').getContext('2d');

    // Membuat objek Chart
    new Chart(ctx, {
        type: 'line',
        data: data,
    });
}

// Memanggil fungsi untuk menggambar chart
drawChart();

document.addEventListener('DOMContentLoaded', function () {
    // Mendapatkan id accordion yang terbuka saat ini dari cookie atau localStorage
    const openAccordionId = localStorage.getItem('openAccordionId');

    // Jika ada accordion yang terbuka sebelumnya, buka kembali accordion tersebut
    if (openAccordionId) {
        const openAccordion = document.getElementById(openAccordionId);
        if (openAccordion) {
            const accordionButton = openAccordion.querySelector('.accordion-button');
            const collapseTarget = openAccordion.querySelector('.accordion-collapse');

            if (accordionButton && collapseTarget) {
                accordionButton.classList.toggle('collapsed', false); // Hapus kelas 'collapsed'
                accordionButton.setAttribute('aria-expanded', 'true');
                collapseTarget.classList.add('show');
            }
        }
    }

    // Menangani klik pada accordion-button
    document.querySelectorAll('.accordion-button').forEach(function (button) {
        button.addEventListener('click', function () {
            // Mendapatkan id accordion yang terklik
            const accordionId = this.closest('.accordion-item').id;

            // Menyimpan id accordion yang terbuka saat ini ke cookie atau localStorage
            localStorage.setItem('openAccordionId', accordionId);
        });
    });
});