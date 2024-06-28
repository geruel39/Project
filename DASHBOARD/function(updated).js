const hamburger = document.querySelector("#drop");

hamburger.addEventListener("click", function(){
    document.querySelector(".dropdown").classList.toggle("drop");
})

//COUNTER
let pendingCount = 0; 
let finishedCount = 0; 
let projectsCount = 0;
let fprojectsCount = 0;


document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('pendingCount').textContent = pendingCount;
    document.getElementById('finishedCount').textContent = finishedCount;
    document.getElementById('projectsCount').textContent = projectsCount;
    document.getElementById('fprojectsCount').textContent = fprojectsCount;
});


function incrementPending() {
    pendingCount += 1;
    document.getElementById('pendingCount').textContent = pendingCount;
}

function incrementFinished() {
    finishedCount += 1;
    document.getElementById('finishedCount').textContent = finishedCount;
}

function incrementProjects() {
    projectsCount += 1;
    document.getElementById('projectsCount').textContent = projectsCount;
}

function incrementfProjects() {
    fprojectsCount += 1;
    document.getElementById('fprojectsCount').textContent = fprojectsCount;
}





document.addEventListener("DOMContentLoaded", function() {
    const employees = [
        { name: 'Alice', finishedTasks: 45 },
        { name: 'Bob', finishedTasks: 30 },
        { name: 'Charlie', finishedTasks: 50 },
        { name: 'David', finishedTasks: 20 },
        { name: 'Sarah', finishedTasks: 21 }
    ];

    
    employees.sort((a, b) => b.finishedTasks - a.finishedTasks);

    
    const tableBody = document.getElementById('employeeTableBody');

    
    employees.forEach((employee, index) => {
        const row = document.createElement('tr');
        
        
        const rankCell = document.createElement('td');
        rankCell.textContent = index + 1;
        row.appendChild(rankCell);
        
       
        const nameCell = document.createElement('td');
        nameCell.textContent = employee.name;
        row.appendChild(nameCell);
        
        
        const tasksCell = document.createElement('td');
        tasksCell.textContent = employee.finishedTasks;
        row.appendChild(tasksCell);
        
        
        tableBody.appendChild(row);
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const tasks = [
        { name: 'Design Mockup', dueDate: '2024-07-01', status: 'In Progress' },
        { name: 'Client Proposal', dueDate: '2024-07-03', status: 'Not Started' },
        { name: 'Code Review', dueDate: '2024-07-05', status: 'Completed' },
        { name: 'Marketing Plan', dueDate: '2024-06-25', status: 'Overdue' },
        { name: 'Testing', dueDate: '2024-07-07', status: 'In Progress' }
    ];

    const today = new Date();

    function getStatusClass(dueDate) {
        const taskDate = new Date(dueDate);
        if (taskDate < today) {
            return 'overdue';
        } else if ((taskDate - today) / (1000 * 60 * 60 * 24) <= 3) {
            return 'due-soon';
        } else {
            return 'on-time';
        }
    }

    const tableBody = document.getElementById('taskTableBody');

    tasks.forEach((task) => {
        const row = document.createElement('tr');
        row.className = getStatusClass(task.dueDate);

        const nameCell = document.createElement('td');
        nameCell.textContent = task.name;
        row.appendChild(nameCell);

        const dueDateCell = document.createElement('td');
        dueDateCell.textContent = task.dueDate;
        row.appendChild(dueDateCell);

        const statusCell = document.createElement('td');
        statusCell.textContent = task.status;
        row.appendChild(statusCell);

        tableBody.appendChild(row);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const employees = [
        { name: 'Design Mockup', dueDate: '2024-07-01', status: 'In Progress' },
        { name: 'Client Proposal', dueDate: '2024-07-03', status: 'Not Started' },
        { name: 'Code Review', dueDate: '2024-07-05', status: 'Completed' },
        { name: 'Marketing Plan', dueDate: '2024-06-25', status: 'Overdue' },
        { name: 'Testing', dueDate: '2024-07-07', status: 'In Progress' }
    ];

    
    employees.sort((a, b) => b.finishedTasks - a.finishedTasks);

    
    const tableBody = document.getElementById('employeeprojectRankingTableBody');

    
    employees.forEach((employee, index) => {
        const row = document.createElement('tr');
        
        
        const rankCell = document.createElement('td');
        rankCell.textContent = index + 1;
        row.appendChild(rankCell);
        
       
        const nameCell = document.createElement('td');
        nameCell.textContent = employee.name;
        row.appendChild(nameCell);
        
        
        const tasksCell = document.createElement('td');
        tasksCell.textContent = employee.finishedTasks;
        row.appendChild(tasksCell);
        
        
        tableBody.appendChild(row);
    });
});


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

