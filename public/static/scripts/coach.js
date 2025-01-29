const currentHost = window.location.host;
const protocol = window.location.protocol;

const apiEndpoint = `${protocol}//${currentHost}/api/coach`;

function get(search = "", sortBy = "", sort = "") {
    return fetch(`${apiEndpoint}?search=${search}&sort_by=${sortBy}&sort=${sort}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok " + response.statusText);
            }
            return response.json();
        })
        .catch(error => {
            console.error("There has been a problem with your fetch operation:", error);
        });
}

function show(coaches) {
    const tableBody = document.querySelector('#coachesTable tbody');
    tableBody.innerHTML = '';

    if (!Array.isArray(coaches.data)) {
        console.error("Expected an array of coaches but received:", coaches);
        return;
    }

    coaches.data.forEach(coach => {
        const row = document.createElement('tr');
        row.setAttribute('role', 'row')
        row.innerHTML = `
                    <td role="cell">${coach.name}</td>
                    <td role="cell">${coach.years_of_experience}</td>
                    <td role="cell">${coach.hourly_rate}</td>
                    <td role="cell">${coach.country}</td>
                    <td role="cell">${coach.city}</td>
                    <td role="cell">${new Date(coach.start_date).toLocaleDateString()}</td>
                `;
        tableBody.appendChild(row);
    });
}

function filter() {
    const searchText = document.querySelector('.search-bar').value
    const sort = document.querySelector('.sort-dropdown').value;

    get(searchText, "hourly_rate", sort).then(data => {
        if (data) show(data);
    });
}

document.querySelector('.send-button').addEventListener('click', filter);
document.querySelector('.search-bar').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        filter();
    }
});
document.querySelector('.sort-dropdown').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        filter();
    }
});

get().then(data => {
    if (data) show(data);
});
