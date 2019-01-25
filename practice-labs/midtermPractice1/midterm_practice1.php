<?php
    /*
Planning: 
- Create a form 
- Handle the form data
- generate a calendar 
- randomly show things on the calendar (depending on what the user selected on form )
- Show summary of the user's form selection at the top 


Step 1: 
- Generate a calendar every time the page loads [DONE]

Step 2: 
- Show the right number of dates depending what month they selected   [DONE]

Step 3:
- Show random images in the calendar (3 different images) [DONE]

Step 4:
- Show the specific number of random images based on the user's form selection [DONE]

Step 5: 
- Show different images based on the country that they select  [DONE]


Step 6: 
- Error checking



*/

// print_r($_POST); 

$months = array(
    'January' => 31, 
    'February' => 28, 
    'November' => 30,
    'December' => 31
    );
    
$countriesAndImages = array(
    'Mexico' => array('acapulco', 'cabos', 'cancun', 'chichenitza', 'huatulco'), 
    'USA' => array('chicago', 'hollywood', 'las_vegas', 'ny', 'washington_dc'), 
    'France' => array('bordeaux', 'le_havre', 'lyon', 'montepellier', 'paris')
    ); 
    

function getDestinationForCountry($country) {
    global $countriesAndImages; 
    shuffle($countriesAndImages[$country]); 
    $location = array_pop($countriesAndImages[$country]); 
    
    $imgURL = "./img/$country/" . $location . ".png";
    return array(
        "imgURL" => $imgURL, 
        "location" => $location
    ); 
}



function createRandomMappings($numDaysInMonth, $numSiteSeeingDays, $country) {
    
    
    $mappings = array(); 
    
    // initialize all the days to be false 
    for ($i = 0; $i < $numDaysInMonth; $i++) {
        array_push($mappings, false); 
    }
    
    // set the siteSeeingDays to have images
    for ($i = 0; $i < $numSiteSeeingDays; $i++) {
        $mappings[$i] = array(
            'destination' => getDestinationForCountry($country) 
            ); 
    }
    

    shuffle($mappings);  
    
/*
    Mappings has this shape: 
    
   [ 
    [ destionation => [imgURL => xyz, location => xyz]], 
    [ destionation => [imgURL => xyz, location => xyz]], 
    [ destionation => [imgURL => xyz, location => xyz]], 
    ...
    
    
   ]
    
*/
    return $mappings; 
    
    
    
}
    
function generateCalendar() {
    global $months; 
    
    $month = $_POST['month']; 
    $daysInMonth = $months[$month]; 
    
    echo "DAYS = $daysInMonth !!!!!!!!!! <br/>"; 
    
    echo "<table>"; 
    
    
    $mappings = createRandomMappings($daysInMonth, $_POST['num-site-seeing-days'], $_POST['country']); 
    
    
    // echo "MAPPINGS: >.............................. <br/>"; 
    // print_r($mappings); 
    // echo "<br/>"; 
    
    $date = 1; 
    
    for ($week = 0; $week < 5; $week++) {
        echo "<tr>"; 
        for ($day = 0; $day < 7; $day++) {
            echo "<td>"; 
            echo "$date";
            
            if ($mappings[$date-1]) {
                echo "<img src='" . $mappings[$date-1]['destination']['imgURL'] . "'>";
                echo "<div>". $mappings[$date-1]['destination']['location'] ."</div>";  
            }
            
            echo "</td>"; 
            $date++; 
            
            if ($date > $daysInMonth)
                break; 
        }
        echo "</tr>"; 
        
        if ($date > $daysInMonth)
             break; 
    }
    echo "</table>"; 
    
}


// grab the month info from the form

function getErrors() {
    $errors = array(); 
    
    if ($_POST['month'] == "Select") {
        array_push($errors, "Must select month"); 
    } 
    
    if (!isset($_POST['num-site-seeing-days'])) {
        array_push($errors, "Must select number of day"); 
    } 
    
    return $errors; 
}

function displayErrors($errors) {
    echo "<ul>"; 
    foreach ($errors as $error) {
        echo "<li>$error</li>"; 
    }
    echo "</ul>"; 
}
?>

<html>
    <head>
        <title>Winter Vacation Planner</title>
        <meta char="utf-8"/>
    </head>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <body>
        <div class="heading">
            <h1>Winter Vacation Planner!</h1>
        </div>
        
        <div class="container">
            
            <form method="POST">
                
                <br> <br/> Select Month:
                <select name="month">
                    <option value="Select">Select</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                </select>
                
                <br> <br/> Number of Locations:
                <input type="radio" name="num-site-seeing-days" id="buttons" value="3">
                    <label for="buttons">Three</label>
                <input type="radio" name="num-site-seeing-days" id="buttons" value="4">
                    <label for="buttons">Four</label>
                <input type="radio" name="num-site-seeing-days" id="buttons" value="5">
                    <label for="buttons">Five</label> 
                    
                <br> <br/> Select Country:
                <select name="country">
                    <option value="Usa">USA</option>
                    <option value="Mexico">Mexico</option>
                    <option value="France">France</option>
                </select>
                
                <br> <br/> Visit location on alphabetical order:
                <input type="radio" name="alphabetical" id="button" value="1">
                    <label for="button">A-Z</label>
                <input type="radio" name="alphabetical" id="button" value="2">
                    <label for="button">Z-A</label>
                    
                <br> <br/>
                <input type="submit" value="Create Itinerary" name="travel-info-submit-btn"/>
            </form>
        </div>
        
        <div class="createFunction">
            <?php 
            // only call generateCalendar if the form is submitted properly
            if(isset($_POST['travel-info-submit-btn'])) {
                $errors = getErrors(); 
                
                if (count($errors) > 0) {
                    displayErrors($errors); 
                } else {
                    generateCalendar(); 
                }
            }
            ?>
        </div>
        
    </body>
</html>