<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;

use DOMDocument;
use DOMXPath;

class RosterParser
{
    public function parse(string $filePath): array
    {
        $doc = new DOMDocument();
        @$doc->loadHTMLFile($filePath); // Suppress warnings for malformed HTML

        $xpath = new DOMXPath($doc);

        // Example: Extract rows from the activity table
        $rows = $xpath->query("//table[@id='ctl00_Main_activityGrid']/tr");

        $events = [];

        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');

            // Skip if it's not a valid data row
            if ($cells->length < 10) {
                continue;
            }

            $event = [
                'type' => $this->getEventType($cells->item(8)->nodeValue ?? ''),
                'flight_number' => $this->getFlightNumber($cells->item(8)->nodeValue ?? ''),
                'start_location' => $cells->item(11)->nodeValue ?? null,
                'end_location' => $cells->item(15)->nodeValue ?? null,
                'start_time' => $this->parseUTC($cells->item(5)->nodeValue ?? ''),
                'end_time' => $this->parseUTC($cells->item(7)->nodeValue ?? ''),
            ];

            $events[] = $event;
        }

        return $events;

      /*  // Load file and parse content (e.g., PDF or Excel)
        $content = Storage::get($filePath);

        // Extract and normalize events using regex
        $events = []; // Populate with parsed events

        return $events;*/
    }

    private function getEventType(string $activity): string
    {
        if (preg_match('/DX\d+/', $activity)) {
            return 'FLT'; // Flight
        } elseif (stripos($activity, 'SBY') !== false) {
            return 'SBY'; // Standby
        } elseif (stripos($activity, 'OFF') !== false) {
            return 'DO'; // Day Off
        }

        return 'UNK'; // Unknown
    }

    private function getFlightNumber(string $activity): ?string
    {
        if (preg_match('/(DX\d+)/', $activity, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function parseUTC(string $time): ?string
    {
        // Convert to standard datetime format if possible
        return $time ? now()->toDateString() . " $time:00 UTC" : null;
    }
}