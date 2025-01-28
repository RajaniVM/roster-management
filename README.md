# Roster Management System

This Laravel application provides functionality to upload, parse, and store airline crew roster data in a database. It supports HTML roster files and provides API endpoints for interaction.

## Features

- Upload and parse an HTML roster file.
- Extract event data (e.g., flight, standby) from the roster.
- Store parsed data into a database.
- Expose API endpoints for further interaction with the stored data.
- Custom error handling for invalid file types.

## Setup Instructions

### 1. Prerequisites

- **PHP**: 8.1 or higher
- **Composer**: 2.0 or higher
- **Laravel Framework**: 10.x
- **Database**: SQLite

### 2. Unzip the Solution

Unzip the Laravel project to your local machine.

### 3. Install Dependencies

Install the required PHP and JavaScript dependencies:

```bash
composer install
```

### 4. Configure Environment

Copy the `.env.example` file to `.env` and configure the environment variables:

```bash
cp .env.example .env
```

Update the following fields in `.env`:

```env
APP_NAME="Roster Management"
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database.sqlite
```

### 5. Create SQLite Database

If using SQLite, create the database file:

```bash
touch database/database.sqlite
```

### 6. Run Migrations

Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

### 7. Run the Development Server

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`.

## API Endpoints

### 1. Upload Roster

- **Method**: POST
- **URL**: `/api/upload-roster`
- **Description**: Upload an HTML roster file and store parsed events in the database.

#### Request:

- `form-data` key: `roster` (File input, must be `.html`).

#### Response:

```json
{
    "message": "Roster processed successfully",
    "events": [ /* Parsed event data */ ]
}
```

#### Error Example:

```json
{
    "message": "support of file type other than HTML is not enable for this assignment.",
    "errors": {
        "roster": ["support of file type other than HTML is not enable for this assignment."]
    }
}
```

### 2. Get All Events Between Dates

- **Method**: GET
- **URL**: `/api/events`
- **Query Parameters**:
  - `start` (required): Start date in `YYYY-MM-DD` format.
  - `end` (required): End date in `YYYY-MM-DD` format.
- **Description**: Fetch all events between two dates.

#### Response Example:

```json
[
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
]
```

### 3. Get Flights in the Next Week

- **Method**: GET
- **URL**: `/api/flights/next-week`
- **Description**: Fetch all flight events scheduled for the next week.

### 4. Get Standby Events in the Next Week

- **Method**: GET
- **URL**: `/api/standby/next-week`
- **Description**: Fetch all standby events scheduled for the next week.

### 5. Get Flights by Departure Location

- **Method**: GET
- **URL**: `/api/flights/location`
- **Query Parameters**:
  - `location` (required): The departure location (e.g., JFK).
- **Description**: Fetch all flights departing from the given location.

## Testing

### 1. Run Integration Tests

The application includes integration tests for roster uploads and parsing logic. To run the tests:

```bash
php artisan test
```

### 2. Example Test Output

```plaintext
PASS  Tests\Feature\RosterIntegrationTest
✓ roster upload and parsing
…
Time: 0.56s, Memory: 18.00MB
OK (1 test, 2 assertions)
```

## Folder Structure

- **`app/Http/Controllers/RosterEventController.php`**: Handles API requests and parsing logic.
- **`app/Models/RosterEvent.php`**: Model for interacting with the roster table.
- **`routes/api.php`**: Defines API routes.
- **`tests/Feature/RosterIntegrationTest.php`**: Contains integration tests.

