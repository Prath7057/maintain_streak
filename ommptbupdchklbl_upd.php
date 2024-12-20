<?php

/*
 * **************************************************************************************
 * @tutorial: // Delete all old entries except the latest one in label @shreya
 * **************************************************************************************
 * 
 * Created on 11 DEC 2024
 *
 * @FileName: ommptbupdchklbl_upd.php
 * @Author: SoftwareGen Developement Team
 * @AuthorEmailId:  info@softwaregen.com
 * @ProjectName: omunim
 * @version 1.0.1
 * @Copyright (c) 2010 www.softwaregen.com
 * @All rights reserved
 *  Copyright 2012 SoftwareGen, Inc
 *
 * @ModificaionHistory
 *  MODIFICATION DATE:
 *  AUTHOR:@shreya
 *  REASON:
 *
 */
?>
<?php
include 'system/omsachsc.php';
include 'ommprspc.php';
include_once 'ommpfndv.php';
include_once 'ommpnmwd.php';
require_once 'ommpincr.php';
include_once 'ommpfunc.php';
?>
<?php
$qMetalPurDetails = "SELECT DISTINCT(label_field_name), label_type FROM labels WHERE label_type IN ('SellPurchase', 'GoldSellPurchase', 'SilverSellPurchase', 'SUPPILER_INVOICE', 'RawMetalPurchase', 'estimateSell', 'APPROVAL', 'sellReturn', 'PurchaseReturn', 'ROUGH_ESTIMATE', 'PendingOrderInvoice')";
$resMetalPurDetails = mysqli_query($conn, $qMetalPurDetails) or die(mysqli_error($conn));
$totalPurCounter = mysqli_num_rows($resMetalPurDetails);

if ($totalPurCounter > 0) {
    while ($rowMetalPurDetails = mysqli_fetch_array($resMetalPurDetails)) {
        $label_field_name = $rowMetalPurDetails['label_field_name'];
        $labelType = $rowMetalPurDetails['label_type'];

        // Get the latest entry ID
        $latestEntryQuery = "SELECT label_id FROM labels WHERE label_field_name = '$label_field_name' AND label_type = '$labelType' ORDER BY label_id DESC LIMIT 1";
        $resultLatestEntry = mysqli_query($conn, $latestEntryQuery) or die(mysqli_error($conn));
        
        if ($row = mysqli_fetch_assoc($resultLatestEntry)) {
            $lastId = $row['label_id'];
           
            // Delete all old entries except the latest one
            $deleteOldEntriesQuery = "DELETE FROM labels WHERE label_field_name = '$label_field_name' AND label_type = '$labelType' AND label_id != '$lastId'";
            mysqli_query($conn, $deleteOldEntriesQuery) or die(mysqli_error($conn));
        }
    }
}
 
?>