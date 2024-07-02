const hamburger = document.querySelector("#drop");

hamburger.addEventListener("click", function(){
    document.querySelector(".dropdown").classList.toggle("drop");
})

document.addEventListener('DOMContentLoaded', () => {
    const monthlyData = [
        { period: 'January', attendance: 20 },
        { period: 'February', attendance: 18 },
        { period: 'March', attendance: 22 },
        { period: 'April', attendance: 15 },
        { period: 'May', attendance: 25 },
        { period: 'June', attendance: 19 },
        { period: 'July', attendance: 21 },
        { period: 'August', attendance: 23 },
        { period: 'September', attendance: 17 },
        { period: 'October', attendance: 20 },
        { period: 'November', attendance: 18 },
        { period: 'December', attendance: 22 }
    ];

    const yearlyData = [
        { period: '2019', attendance: 240 },
        { period: '2020', attendance: 180 },
        { period: '2021', attendance: 220 },
        { period: '2022', attendance: 250 },
        { period: '2023', attendance: 230 }
    ];

    const chart = document.getElementById('attendance-chart');
    const monthlyBtn = document.getElementById('monthly-btn');
    const yearlyBtn = document.getElementById('yearly-btn');

    function renderChart(data) {
        chart.innerHTML = '';
        const maxAttendance = Math.max(...data.map(item => item.attendance));
        const containerHeight = 100;

        data.forEach(item => {
            const bar = document.createElement('div');
            bar.className = 'bar';
            const barHeight = (item.attendance / maxAttendance) * containerHeight;
            bar.style.height = `${barHeight}px`;
            bar.setAttribute('data-value', item.attendance);

            const label = document.createElement('span');
            label.textContent = item.period;
            bar.appendChild(label);

            chart.appendChild(bar);
        });
    }

    monthlyBtn.addEventListener('click', () => {
        renderChart(monthlyData);
    });

    yearlyBtn.addEventListener('click', () => {
        renderChart(yearlyData);
    });


    renderChart(monthlyData);
});

