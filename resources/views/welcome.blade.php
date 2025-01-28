<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roster Management System</title>
</head>
<body>
    <h1>Roster Management System</h1>
    <p>This Laravel application provides functionality to upload, parse, and store airline crew roster data in a database. It supports HTML roster files and provides API endpoints for interaction.</p>

    <h2>Features</h2>
    <ul>
        <li>Upload and parse an HTML roster file.</li>
        <li>Extract event data (e.g., flight, standby) from the roster.</li>
        <li>Store parsed data into a database.</li>
        <li>Expose API endpoints for further interaction with the stored data.</li>
        <li>Custom error handling for invalid file types.</li>
    </ul>

    <h2>Setup Instructions</h2>
    <h3>1. Prerequisites</h3>
    <ul>
        <li>PHP: 8.1 or higher</li>
        <li>Composer: 2.0 or higher</li>
        <li>Laravel Framework: 10.x</li>
        <li>Database: SQLite</li>
    </ul>

    <h3>2. Unzip the Solution</h3>
    <p>Unzip the Laravel project to your local machine.</p>

    <h3>3. Install Dependencies</h3>
    <p>Install the required PHP and JavaScript dependencies:</p>
    <pre><code>composer install</code></pre>

    <h3>4. Configure Environment</h3>
    <p>Copy the <code>.env.example</code> file to <code>.env</code> and configure the environment variables:</p>
    <pre><code>cp .env.example .env</code></pre>
    <p>Update the following fields in <code>.env</code>:</p>
    <pre><code>APP_NAME="Roster Management"
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database.sqlite</code></pre>

    <h3>5. Create SQLite Database</h3>
    <p>If using SQLite, create the database file:</p>
    <pre><code>touch database/database.sqlite</code></pre>

    <h3>6. Run Migrations</h3>
    <p>Run the database migrations to create the necessary tables:</p>
    <pre><code>php artisan migrate</code></pre>

    <h3>7. Run the Development Server</h3>
    <p>Start the Laravel development server:</p>
    <pre><code>php artisan serve</code></pre>
    <p>The application will be available at <code>http://127.0.0.1:8000</code>.</p>

    <h2>API Endpoints</h2>
    <h3>1. Upload Roster</h3>
    <ul>
        <li><strong>Method:</strong> POST</li>
        <li><strong>URL:</strong> /api/upload-roster</li>
        <li><strong>Description:</strong> Upload an HTML roster file and store parsed events in the database.</li>
    </ul>
    <p><strong>Request:</strong></p>
    <pre><code>form-data key: roster (File input, must be .html).</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
    "message": "Roster processed successfully",
    "events": [ /* Parsed event data */ ]
}</code></pre>
    <p><strong>Error Example:</strong></p>
    <pre><code>{
    "message": "support of file type other than HTML is not enable for this assignment.",
    "errors": {
        "roster": ["support of file type other than HTML is not enable for this assignment."]
    }
}</code></pre>

    <h3>2. Get All Events Between Dates</h3>
    <ul>
        <li><strong>Method:</strong> GET</li>
        <li><strong>URL:</strong> /api/events</li>
        <li><strong>Query Parameters:</strong></li>
        <ul>
            <li>start (required): Start date in YYYY-MM-DD format.</li>
            <li>end (required): End date in YYYY-MM-DD format.</li>
        </ul>
        <li><strong>Description:</strong> Fetch all events between two dates.</li>
    </ul>
    <p><strong>Response Example:</strong></p>
    <pre><code>[
    {
        "id": 1,
        "date": "2023-01-14",
        "checkin_local": "12:00",
        "checkin_utc": "11:00",
        "activity": "Flight",
        "from_station": "JFK",
        "to_station": "LAX",
        "tail_number": "N12345",
        "created_at": "2023-01-15T10:00:00.000000Z"
    }
]</code></pre>

    <h3>3. Get Flights in the Next Week</h3>
    <ul>
        <li><strong>Method:</strong> GET</li>
        <li><strong>URL:</strong> /api/flights/next-week</li>
        <li><strong>Description:</strong> Fetch all flight events scheduled for the next week.</li>
    </ul>

    <h3>4. Get Standby Events in the Next Week</h3>
    <ul>
        <li><strong>Method:</strong> GET</li>
        <li><strong>URL:</strong> /api/standby/next-week</li>
        <li><strong>Description:</strong> Fetch all standby events scheduled for the next week.</li>
    </ul>

    <h3>5. Get Flights by Departure Location</h3>
    <ul>
        <li><strong>Method:</strong> GET</li>
        <li><strong>URL:</strong> /api/flights/location</li>
        <li><strong>Query Parameters:</strong></li>
        <ul>
            <li>location (required): The departure location (e.g., JFK).</li>
        </ul>
        <li><strong>Description:</strong> Fetch all flights departing from the given location.</li>
    </ul>

    <h2>Testing</h2>
    <h3>1. Run Integration Tests</h3>
    <p>The application includes integration tests for roster uploads and parsing logic. To run the tests:</p>
    <pre><code>php artisan test</code></pre>
    <h3>2. Example Test Output</h3>
    <pre><code>PASS  Tests\Feature\RosterIntegrationTest
✓ roster upload and parsing
…
Time: 0.56s, Memory: 18.00MB
OK (1 test, 2 assertions)</code></pre>

    <h2>Folder Structure</h2>
    <ul>
        <li><strong>app/Http/Controllers/RosterEventController.php:</strong> Handles API requests and parsing logic.</li>
        <li><strong>app/Models/RosterEvent.php:</strong> Model for interacting with the roster table.</li>
        <li><strong>routes/api.php:</strong> Defines API routes.</li>
        <li><strong>tests/Feature/RosterIntegrationTest.php:</strong> Contains integration tests.</li>
    </ul>
</body>
</html>
