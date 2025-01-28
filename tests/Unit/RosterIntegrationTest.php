<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\RosterEvent;

class RosterIntegrationTest extends TestCase
{
    use RefreshDatabase;

    private function htmlFile(){

      $htmlContent = <<<HTML
        <html>
            <body>
                <table id="ctl00_Main_activityGrid">
                    <tbody>
                        <tr id="ctl00_Main_activityGrid_-1" class="activity-table-header" style="font-weight:bold;">
                            <td class="lineLeft dontPrint collapse-icon" style="width:25px;">
                            <span id="collapseAllHeader" class="glyphicon glyphicon-minus-sign align-glyphicon" aria-hidden="true"></span>
                            </td>
                            <td class="lineLeft activitytablerow-date">Date</td>
                            <td class="activitytablerow-revision visible-none-custom">Rev</td>
                            <td class="activitytablerow-dc visible-sm-custom">DC</td>
                            <td class="activitytablerow-checkinlt">C/I(L)</td>
                            <td class="activitytablerow-checkinutc">C/I(Z)</td>
                            <td class="activitytablerow-checkoutlt">C/O(L)</td>
                            <td class="activitytablerow-checkoututc">C/O(Z)</td>
                            <td class="activitytablerow-activity">Activity</td>
                            <td class="activitytablerow-activityRemark">Remark</td>
                            <td class="lineLeft lineleft1"></td>
                            <td class="activitytablerow-fromstn">From</td>
                            <td class="activitytablerow-stdlt">STD(L)</td>
                            <td class="activitytablerow-stdutc">STD(Z)</td>
                            <td class="lineLeft lineleft2"></td>
                            <td class="activitytablerow-tostn">To</td>
                            <td class="activitytablerow-stalt">STA(L)</td>
                            <td class="activitytablerow-stautc">STA(Z)</td>
                            <td class="lineLeft lineleft3"></td>
                            <td class="activitytablerow-AC/Hotel">AC/Hotel</td>
                            <td class="activitytablerow-blockhours">BLH</td>
                            <td class="activitytablerow-flighttime visible-none-custom"><nobr>Flight Time</nobr></td>
                            <td class="activitytablerow-nighttime visible-none-custom"><nobr>Night Time</nobr></td>
                            <td class="activitytablerow-duration">Dur</td>
                            <td class="activitytablerow-counter1"><nobr>Ext</nobr></td>
                            <td class="lineLeft lineleft4"></td>
                            <td class="activitytablerow-Paxbooked visible-none-custom"><nobr>Pax booked</nobr></td>
                            <td class="activitytablerow-Tailnumber">ACReg</td>
                            <td class="activitytablerow-CrewMeal">CrewMeal</td>
                            <td class="lineLeft lineleft5"></td>
                            <td class="activitytablerow-Resources visible-none-custom">Resources</td>
                            <td class="activitytablerow-crewcodelist">CC</td>
                            <td class="activitytablerow-fullnamelist visible-none-custom">Name</td>
                            <td class="activitytablerow-positionlist">Pos.</td>
                            <td class="activitytablerow-BusinessPhoneList visible-none-custom"><nobr>Work Phone</nobr></td>
                            <td class="activitytablerow-OtherDHCrewCode"><nobr>DH Crew</nobr></td>
                            <td class="activitytablerow-DHFullNameList visible-none-custom"><nobr>DH Name</nobr></td>
                            <td class="activitytablerow-DHSeatingList visible-none-custom"><nobr>DH Seat</nobr></td>
                            <td class="activitytablerow-remarks">Remarks</td>
                            <td class="activitytablerow-ActualFdpTime"><nobr>Fdp Time</nobr></td>
                            <td class="activitytablerow-MaxFdpTime"><nobr>Max Fdp</nobr></td>
                            <td class="activitytablerow-RestCompletedTime visible-none-custom"><nobr>Rest Compl.</nobr></td>
                            <td class="lineRight lineright1"></td>
                        </tr>
                    
                        <tr id="ctl00_Main_activityGrid_0" class="lineTop">
                            <td class="lineLeft dontPrint expand-icon">
                            <span class="glyphicon glyphicon-plus-sign align-glyphicon"></span>
                            </td>
                            <td class="lineLeft activitytablerow-date"><nobr>Mon 17</nobr></td>
                            <td class="activitytablerow-revision visible-none-custom"></td>
                            <td class="activitytablerow-dc visible-sm-custom"></td>
                            <td class="activitytablerow-checkinlt">0845</td>
                            <td class="activitytablerow-checkinutc">0745</td>
                            <td class="activitytablerow-checkoutlt"></td>
                            <td class="activitytablerow-checkoututc"></td>
                            <td class="activitytablerow-activity">DX77</td>
                            <td class="activitytablerow-activityRemark">DX 0077</td>
                            <td class="lineLeft lineleft1"></td>
                            <td class="activitytablerow-fromstn">KRP</td>
                            <td class="activitytablerow-stdlt">0945</td>
                            <td class="activitytablerow-stdutc">0845</td>
                            <td class="lineLeft lineleft2"></td>
                            <td class="activitytablerow-tostn">CPH</td>
                            <td class="activitytablerow-stalt">1035</td>
                            <td class="activitytablerow-stautc">0935</td>
                            <td class="lineLeft lineleft3"></td>
                            <td class="activitytablerow-AC/Hotel">DO4
                            </td>
                            <td class="activitytablerow-blockhours"></td>
                            <td class="activitytablerow-flighttime visible-none-custom"></td>
                            <td class="activitytablerow-nighttime visible-none-custom"></td>
                            <td class="activitytablerow-duration"></td>
                            <td class="activitytablerow-counter1"></td>
                            <td class="lineLeft lineleft4"></td>
                            <td class="activitytablerow-Paxbooked visible-none-custom"></td>
                            <td class="activitytablerow-Tailnumber">OYJRY</td>
                            <td class="activitytablerow-CrewMeal"></td>
                            <td class="lineLeft lineleft5"></td>
                            <td class="activitytablerow-Resources visible-none-custom"></td>
                            <td class="activitytablerow-crewcodelist">
                            <nobr>JBN</nobr><br><nobr>THI</nobr><br><nobr>ILV</nobr>
                            </td>
                            <td class="activitytablerow-fullnamelist visible-none-custom">

                            </td>
                            <td class="activitytablerow-positionlist">
                            <nobr>CP (PIC)</nobr><br><nobr>FO</nobr><br><nobr>CA</nobr>
                            </td>
                            <td class="activitytablerow-BusinessPhoneList visible-none-custom">

                            </td>
                            <td class="activitytablerow-OtherDHCrewCode">

                            </td>
                            <td class="activitytablerow-DHFullNameList visible-none-custom">

                            </td>
                            <td class="activitytablerow-DHSeatingList visible-none-custom">
                            <br><br>
                            </td>
                            <td class="activitytablerow-remarks"></td>
                            <td class="activitytablerow-ActualFdpTime"></td>
                            <td class="activitytablerow-MaxFdpTime"></td>
                            <td class="activitytablerow-RestCompletedTime visible-none-custom"></td>
                            <td class="lineRight lineright1"></td>
                        
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        HTML;

        return $htmlContent;
    }

    private function htmlFileWithSBY() {
        $htmlWithSBY = <<<HTML
        <html>
            <body>
                <table id="ctl00_Main_activityGrid">
                    <tbody>
                        <tr id="ctl00_Main_activityGrid_-1" class="activity-table-header" style="font-weight:bold;">
                            <td class="lineLeft dontPrint collapse-icon" style="width:25px;">
                            <span id="collapseAllHeader" class="glyphicon glyphicon-minus-sign align-glyphicon" aria-hidden="true"></span>
                            </td>
                            <td class="lineLeft activitytablerow-date">Date</td>
                            <td class="activitytablerow-revision visible-none-custom">Rev</td>
                            <td class="activitytablerow-dc visible-sm-custom">DC</td>
                            <td class="activitytablerow-checkinlt">C/I(L)</td>
                            <td class="activitytablerow-checkinutc">C/I(Z)</td>
                            <td class="activitytablerow-checkoutlt">C/O(L)</td>
                            <td class="activitytablerow-checkoututc">C/O(Z)</td>
                            <td class="activitytablerow-activity">Activity</td>
                            <td class="activitytablerow-activityRemark">Remark</td>
                            <td class="lineLeft lineleft1"></td>
                            <td class="activitytablerow-fromstn">From</td>
                            <td class="activitytablerow-stdlt">STD(L)</td>
                            <td class="activitytablerow-stdutc">STD(Z)</td>
                            <td class="lineLeft lineleft2"></td>
                            <td class="activitytablerow-tostn">To</td>
                            <td class="activitytablerow-stalt">STA(L)</td>
                            <td class="activitytablerow-stautc">STA(Z)</td>
                            <td class="lineLeft lineleft3"></td>
                            <td class="activitytablerow-AC/Hotel">AC/Hotel</td>
                            <td class="activitytablerow-blockhours">BLH</td>
                            <td class="activitytablerow-flighttime visible-none-custom"><nobr>Flight Time</nobr></td>
                            <td class="activitytablerow-nighttime visible-none-custom"><nobr>Night Time</nobr></td>
                            <td class="activitytablerow-duration">Dur</td>
                            <td class="activitytablerow-counter1"><nobr>Ext</nobr></td>
                            <td class="lineLeft lineleft4"></td>
                            <td class="activitytablerow-Paxbooked visible-none-custom"><nobr>Pax booked</nobr></td>
                            <td class="activitytablerow-Tailnumber">ACReg</td>
                            <td class="activitytablerow-CrewMeal">CrewMeal</td>
                            <td class="lineLeft lineleft5"></td>
                            <td class="activitytablerow-Resources visible-none-custom">Resources</td>
                            <td class="activitytablerow-crewcodelist">CC</td>
                            <td class="activitytablerow-fullnamelist visible-none-custom">Name</td>
                            <td class="activitytablerow-positionlist">Pos.</td>
                            <td class="activitytablerow-BusinessPhoneList visible-none-custom"><nobr>Work Phone</nobr></td>
                            <td class="activitytablerow-OtherDHCrewCode"><nobr>DH Crew</nobr></td>
                            <td class="activitytablerow-DHFullNameList visible-none-custom"><nobr>DH Name</nobr></td>
                            <td class="activitytablerow-DHSeatingList visible-none-custom"><nobr>DH Seat</nobr></td>
                            <td class="activitytablerow-remarks">Remarks</td>
                            <td class="activitytablerow-ActualFdpTime"><nobr>Fdp Time</nobr></td>
                            <td class="activitytablerow-MaxFdpTime"><nobr>Max Fdp</nobr></td>
                            <td class="activitytablerow-RestCompletedTime visible-none-custom"><nobr>Rest Compl.</nobr></td>
                            <td class="lineRight lineright1"></td>
                        </tr>
                    
                        <tr id="ctl00_Main_activityGrid_0" class="lineTop">
                            <td class="lineLeft dontPrint expand-icon">
                            <span class="glyphicon glyphicon-plus-sign align-glyphicon"></span>
                            </td>
                            <td class="lineLeft activitytablerow-date"><nobr>Mon 17</nobr></td>
                            <td class="activitytablerow-revision visible-none-custom"></td>
                            <td class="activitytablerow-dc visible-sm-custom"></td>
                            <td class="activitytablerow-checkinlt">0845</td>
                            <td class="activitytablerow-checkinutc">0745</td>
                            <td class="activitytablerow-checkoutlt"></td>
                            <td class="activitytablerow-checkoututc"></td>
                            <td class="activitytablerow-activity">SBY</td>
                            <td class="activitytablerow-activityRemark">DX 0077</td>
                            <td class="lineLeft lineleft1"></td>
                            <td class="activitytablerow-fromstn">KRP</td>
                            <td class="activitytablerow-stdlt">0945</td>
                            <td class="activitytablerow-stdutc">0845</td>
                            <td class="lineLeft lineleft2"></td>
                            <td class="activitytablerow-tostn">CPH</td>
                            <td class="activitytablerow-stalt">1035</td>
                            <td class="activitytablerow-stautc">0935</td>
                            <td class="lineLeft lineleft3"></td>
                            <td class="activitytablerow-AC/Hotel">DO4
                            </td>
                            <td class="activitytablerow-blockhours"></td>
                            <td class="activitytablerow-flighttime visible-none-custom"></td>
                            <td class="activitytablerow-nighttime visible-none-custom"></td>
                            <td class="activitytablerow-duration"></td>
                            <td class="activitytablerow-counter1"></td>
                            <td class="lineLeft lineleft4"></td>
                            <td class="activitytablerow-Paxbooked visible-none-custom"></td>
                            <td class="activitytablerow-Tailnumber">OYJRY</td>
                            <td class="activitytablerow-CrewMeal"></td>
                            <td class="lineLeft lineleft5"></td>
                            <td class="activitytablerow-Resources visible-none-custom"></td>
                            <td class="activitytablerow-crewcodelist">
                            <nobr>JBN</nobr><br><nobr>THI</nobr><br><nobr>ILV</nobr>
                            </td>
                            <td class="activitytablerow-fullnamelist visible-none-custom">

                            </td>
                            <td class="activitytablerow-positionlist">
                            <nobr>CP (PIC)</nobr><br><nobr>FO</nobr><br><nobr>CA</nobr>
                            </td>
                            <td class="activitytablerow-BusinessPhoneList visible-none-custom">

                            </td>
                            <td class="activitytablerow-OtherDHCrewCode">

                            </td>
                            <td class="activitytablerow-DHFullNameList visible-none-custom">

                            </td>
                            <td class="activitytablerow-DHSeatingList visible-none-custom">
                            <br><br>
                            </td>
                            <td class="activitytablerow-remarks"></td>
                            <td class="activitytablerow-ActualFdpTime"></td>
                            <td class="activitytablerow-MaxFdpTime"></td>
                            <td class="activitytablerow-RestCompletedTime visible-none-custom"></td>
                            <td class="lineRight lineright1"></td>
                        
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        HTML;

        return $htmlWithSBY;
    }
    
   
    /**
     * Test uploading and parsing the roster file, and verify database storage.
     */
    public function testRosterUploadAndParsing()
    {
       
        // Create a fake uploaded file
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFile());

        // Send a POST request to the upload endpoint
        $response = $this->postJson('/api/upload-roster', [
            'roster' => $file,
        ]);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains a success message
        $response->assertJson(['message' => 'Roster processed successfully']);

        // Assert that the datas are stored in the database
        $this->assertDatabaseHas('rosters', [
            "date" => "2022-01-17",
            "checkin_local" => "0845",
            "checkin_utc" => "0745",
            "checkout_local" => "",
            "checkout_utc" =>  "",
            "activity_type" => "FLT",
            "activity" => "DX77",
            "from_station" => "KRP",
            "std_local" => "0945",
            "std_utc" => "0845",
            "to_station" => "CPH",
            "sta_local" => "1035",
            "sta_utc" => "0935",

        ]);
    
    }

    public function testNonHtmlFile(){
        $textContent = "This is a Text File. ";

        $file = UploadedFile::fake()->createWithContent('roster.txt', $textContent);
        
        $response = $this->postJson('/api/upload-roster', [
            'roster' => $file,
        ]);

        // Assert: Validation Error
        $response->assertStatus(422)
              ->assertJsonValidationErrors(['roster']);

        // Assert that the response contains a success message
        $response->assertJson([
            "message" => "support of file type other than HTML is not enable for this assignment.",
            "errors" => [
                "roster" => [
                    "support of file type other than HTML is not enable for this assignment."
                ]
            ]
        ]);
    }

    public function testEventsBetweenDates() {
        // Create a fake uploaded file
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFile());

        $this->post('/api/upload-roster', [
            'roster' => $file,
        ]);
        
        // GET events data between dates
        $response = $this->get('/api/events?start=2022-01-14&end=2022-01-28');

         // Assert that the response status is 200 (OK)
         $response->assertStatus(200)         
            ->assertJsonFragment([
                'id' => 1,
                "date" => "2022-01-17",
                "checkin_local" => "0845",
                "checkin_utc" => "0745",
                "checkout_local" => "",
                "checkout_utc" =>  "",
                "activity_type" => "FLT",
                "activity" => "DX77",
                "from_station" => "KRP",
                "std_local" => "0945",
                "std_utc" => "0845",
                "to_station" => "CPH",
                "sta_local" => "1035",
                "sta_utc" => "0935",
                
            ]);

    }

    //
    public function testNoEventsBetweenDates() {
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFile());

        $this->post('/api/upload-roster', [
            'roster' => $file,
        ]);
        
    // GET events data between dates
        $response = $this->getJson('/api/events?start=2022-01-22&end=2022-01-28');
       
        $response->assertStatus(200)->assertJsonFragment([]);
    }


    public function testFlightsNextWeek() {
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFile());

        $uploadResponse = $this->postJson('/api/upload-roster', [
            'roster' => $file,
        ]);
        
        $uploadResponse->assertStatus(200);
                       
        $nextWeekResponse = $this->getJson('/api/flights/next-week');
        $nextWeekResponse->assertStatus(200)
            ->assertJsonFragment([
                'id' => 1,
                "date" => "2022-01-17",
                "checkin_local" => "0845",
                "checkin_utc" => "0745",
                "checkout_local" => "",
                "checkout_utc" =>  "",
                "activity_type" => "FLT",
                "activity" => "DX77",
                "from_station" => "KRP",
                "std_local" => "0945",
                "std_utc" => "0845",
                "to_station" => "CPH",
                "sta_local" => "1035",
                "sta_utc" => "0935",          
            ]);

    }

    public function testStandbyNextWeek() {
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFileWithSBY());

        $uploadResponse = $this->postJson('/api/upload-roster', [
            'roster' => $file,
        ]);

        $uploadResponse->assertStatus(200);
        $nextWeekResponse = $this->getJson('/api/standby/next-week');
        
        $nextWeekResponse->assertStatus(200)
            ->assertJsonFragment([
                'id' => 1,
                "date" => "2022-01-17",
                "checkin_local" => "0845",
                "checkin_utc" => "0745",
                "checkout_local" => "",
                "checkout_utc" =>  "",
                "activity_type" => "SBY",
                "activity" => "SBY",
                "from_station" => "KRP",
                "std_local" => "0945",
                "std_utc" => "0845",
                "to_station" => "CPH",
                "sta_local" => "1035",
                "sta_utc" => "0935",
                
            ]);

    }

    public function testNoStandbyNextWeek() {
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFile());

        $uploadResponse = $this->postJson('/api/upload-roster', [
            'roster' => $file,
        ]);

        $uploadResponse->assertStatus(200);
        $nextWeekResponse = $this->getJson('/api/standby/next-week');
        
        $nextWeekResponse->assertStatus(200)->assertJsonFragment([]);

    }

    public function testNoFlightsByLocation() {
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFileWithSBY());

        $uploadResponse = $this->postJson('/api/upload-roster', [
            'roster' => $file,
        ]);

        $uploadResponse->assertStatus(200);
        $locationResponse = $this->getJson('/api/flights/location?from=CPH');
       
        $locationResponse->assertStatus(200)->assertJsonFragment([]);
    }

    public function testFlightsByLocation() {
        $file = UploadedFile::fake()->createWithContent('roster.html',  $this->htmlFile());

        $uploadResponse = $this->postJson('/api/upload-roster', [
            'roster' => $file,
        ]);

        $uploadResponse->assertStatus(200);
        $locationResponse = $this->getJson('/api/flights/location?from=KRP');
       
        $locationResponse->assertStatus(200)
            ->assertJsonFragment([
                'id' => 1,
                "date" => "2022-01-17",
                "checkin_local" => "0845",
                "checkin_utc" => "0745",
                "checkout_local" => "",
                "checkout_utc" =>  "",
                "activity_type" => "FLT",
                "activity" => "DX77",
                "from_station" => "KRP",
                "std_local" => "0945",
                "std_utc" => "0845",
                "to_station" => "CPH",
                "sta_local" => "1035",
                "sta_utc" => "0935",       
            ]);
    }

}