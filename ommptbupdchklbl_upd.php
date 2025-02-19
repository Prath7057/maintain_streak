
<?php
include_once 'ommpfndv.php';
require_once 'ommpincr.php';
?>
    while ($rowMetalPurDetails = mysqli_fetch_array($resMetalPurDetails)) {
        $label_field_name = $rowMetalPurDetails['label_field_name'];
        $labelType = $rowMetalPurDetails['label_type'];

        // Get the latest entry ID
        $latestEntryQuery = "SELECT label_id FROM labels WHERE label_field_name = '$label_field_name' AND label_type = '$labelType' ORDER BY label_id DESC LIMIT 1";
        $resultLatestEntry = mysqli_query($conn, $latestEntryQuery) or die(mysqli_error($conn));
        
        if ($row = mysqli_fetch_assoc($resultLatestEntry)) {
            $lastId = $row['label_id'];
           
        }
    }
}
 
?>
