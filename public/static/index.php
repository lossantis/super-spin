<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Tennis Coaches</title>
    <link rel="stylesheet" href="/static/css/main.css">
    <link rel="stylesheet" href="/static/css/input-text.css">
    <link rel="stylesheet" href="/static/css/dropdown.css">
    <link rel="stylesheet" href="/static/css/button.css">
    <link rel="stylesheet" href="/static/css/table.css">
    <link rel="stylesheet" href="/static/css/coach-table.css">
</head>
<body>
<div class="container">
    <h1>Table Tennis Coaches</h1>
    <div class="search-sort">
        <label>
            <input type="text" class="search-bar" placeholder="Search by name or location...">
        </label>
        <label>
            <select class="sort-dropdown">
                <option value="">Sort by hourly rate</option>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </label>

        <button type="button" class="send-button">Send</button>
    </div>
    <table id="coachesTable" role="table">
        <thead role="rowgroup">
            <tr role="row">
                <th role="columnheader">&nbsp;</th>
                <th role="columnheader">Name</th>
                <th role="columnheader">Experience (years)</th>
                <th role="columnheader">Hourly Rate ($)</th>
                <th role="columnheader">Country</th>
                <th role="columnheader">City</th>
                <th role="columnheader">Joined</th>
            </tr>
        </thead>
        <tbody role="rowgroup">
        <!-- Table rows will be dynamically injected here -->
        </tbody>
    </table>
</div>

<script src="/static/scripts/coach.js"></script>
</body>
</html>
