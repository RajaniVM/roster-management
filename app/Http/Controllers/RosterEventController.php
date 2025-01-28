<?php

namespace App\Http\Controllers;


use App\Models\RosterEvent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use DOMDocument;
use DOMXPath;

class RosterEventController extends Controller
{

    /**
     * Upload and parse the roster file.
     */
    public function uploadRoster(Request $request)
    {
         // Validate the file input
         $request->validate(
            [
            'roster' => 'required|file|mimes:html',
            ],
            [
            'roster.mimes' => 'support of file type other than HTML is not enable for this assignment.',
            ]
    );

    
        $file = $request->file('roster');
        $path = $file->store('uploads', 'public');
        $url = Storage::url($path);
        $content = file_get_contents($file->getPathname());
        $htmlfile = html_entity_decode($content);
        // var_dump($htmlfile);
      //  $rows = explode("\n", $content);
        
        // Load the HTML file
        // $fileContent = file_get_contents($request->file('rosters')->getPathname());
        $dom = new DOMDocument();
        @$dom->loadHTML($htmlfile);
        // echo $dom->saveHTML();
       // libxml_use_internal_errors(true);
       // @$dom->loadHTMLFile('C:\Users\mogal\CAE\airline-roster\files\Roster - CrewConnex.html');
        //   echo $dom->saveHTML(); 
        // libxml_clear_errors();
      


        $xpath = new DOMXPath($dom);
       
        // Define the table row selector
        $rows = $xpath->query("//table[@id='ctl00_Main_activityGrid']/tbody/tr");
        $events = [];
        
        foreach ($rows as $index => $row) { 
            // Skip the header row
            // var_dump($row);
            if ($index === 0) {
                continue;
            }
            
            $columns = $xpath->query('td', $row);
            // var_dump($columns->item(4)->nodeValue);
            if($columns->item(1)->nodeValue) {
                $short_date = explode(" ", $columns->item(1)->nodeValue);
                $date =  "2022-01-".$short_date[1];
            } else {
                $date = null;
            }
            $events[] = [
                'date' => $date,
                'checkin_local' => $columns->item(4)->nodeValue ?? null,
                'checkin_utc' => $columns->item(5)->nodeValue ?? null,
                'checkout_local' => $columns->item(6)->nodeValue ?? null,
                'checkout_utc' => $columns->item(7)->nodeValue ?? null,
                'activity_type' => $this->getActivityType($columns->item(8)->nodeValue),
                'activity' => $columns->item(8)->nodeValue ?? null,
                'from_station' => $columns->item(11)->nodeValue ?? null,
                'std_local' => $columns->item(12)->nodeValue ?? null,
                'std_utc' => $columns->item(13)->nodeValue ?? null,
                'to_station' => $columns->item(15)->nodeValue ?? null,
                'sta_local' => $columns->item(16)->nodeValue ?? null,
                'sta_utc' => $columns->item(17)->nodeValue ?? null,
            ];
        }

        // Save to database
        foreach ($events as $eventData) {
            RosterEvent::create($eventData);


        }

        return response()->json(['message' => 'Roster processed successfully']);
    


    }

    private function getActivityType(string $activity){
        // Regular expression: first two characters must be letters, followed by one or more digits
        $pattern = '/^[A-Za-z]{2}\d+$/';  
        if (preg_match($pattern, $activity)) { return "FLT"; } 
        switch($activity)
        {
            case "OFF": return "DO";
            case "SBY": return "SBY";
            default: return "UNK";
              
        }
    }

    /**
     * Get all events between two dates.
     */
    public function getEventsBetweenDates(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $events = RosterEvent::whereBetween('date', [$request->start, $request->end])->get();

        return response()->json($events);
    
    }

    /**
     * Get all flights for the next week.
     */
    public function getFlightsNextWeek(Request $request)
    {
        // Set hard coded value to 14 Jan 2022
        // $start = Carbon::now();
        $start = Carbon::create(2022, 1, 14);
        $end = Carbon::now()->addWeek();

        $flights = RosterEvent::where('activity_type', 'FLT')
            ->whereBetween('date', [$start, $end])
            ->get();

        return response()->json($flights);
    }

    /**
     * Get all standby events for the next week.
     */
    public function getStandbyNextWeek()
    {
         // Set hard coded value to 14 Jan 2022
        // $start = Carbon::now();
        $start = Carbon::create(2022, 1, 14);
        $end = Carbon::now()->addWeek();

        $standbyEvents = RosterEvent::where('activity_type', 'SBY')
            ->whereBetween('date', [$start, $end])
            ->get();

        return response()->json($standbyEvents);
    }

    /**
     * Get all flights starting from a specific location.
     */
    public function getFlightsByLocation(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
        ]);

        $flights = RosterEvent::where('activity_type', 'FLT')
            ->where('from_station', $request->from)
            ->get();

        return response()->json($flights);
    }    
}

