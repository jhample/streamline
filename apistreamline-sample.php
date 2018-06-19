<?php
   /**

NOTES:

1) Streamline - Enter a list of Reservation Confirmation Numbers into $clients array. (Method GetReservationInfo)
2) Streamline - It will grab most of the client data from the reservation info and store as vars.
3) Streamline - For Each Reservation, using Email Address as the "key", add up the price_nightly and total becomes lifetime spend. (Method GetAllReservationsByEmail)
4) Streamline - Get Reservation Flags for newest / most recent Reservation (Method GetReservationFlags)
5) SharpSpring - Populate Client record with contact information and info from most recent Reservation (Method createLeads)

   **/

$token_key="123456789";
$token_secret="123456789";

$clients=array(
"269028"
); //This is the RESERVATION Confirmation ID.

$n=1;
 foreach($clients as $id) {

if($n>7){
   sleep(10);
   //echo "pause...";
   $n=1;
}
   $method = 'GetReservationInfo';
   $params = array("token_key"=>$token_key,"token_secret"=>$token_secret,"confirmation_id"=>$id);
   //$requestID = date();
   $data = array(
       'methodName' => $method,
       'params' => $params
       //'id' => $requestID
   );
                          //console.log($data);
   //$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey));
   $url = "https://web.streamlinevrs.com/api/json";

   $data = json_encode($data);

   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
       'Content-Length: ' . strlen($data),
       'Expect: '
   ));

   $result = curl_exec($ch);
   curl_close($ch);
   //echo $result;



   $decoded = json_decode( $result );
  //var_dump($decoded);
  $contactemail = $decoded->data->reservation->email;
  $contactfname = (strlen($decoded->data->reservation->first_name)>1) ? $decoded->data->reservation->first_name : "";
  $contactlname = (strlen($decoded->data->reservation->last_name)>1) ? $decoded->data->reservation->last_name : "";
  $contactaddress = (strlen($decoded->data->reservation->address)>1) ? $decoded->data->reservation->address : "";
  $contactaddress2 = (strlen($decoded->data->reservation->address2)>1) ? $decoded->data->reservation->address2 : "";
  $contactcity = (strlen($decoded->data->reservation->city)>1) ? $decoded->data->reservation->city : "";
  $contactzip = (strlen($decoded->data->reservation->zip)>1) ? $decoded->data->reservation->zip : "";
  $contactphone = (strlen($decoded->data->reservation->phone)>1) ? $decoded->data->reservation->phone : "";
  $contactfax = (strlen($decoded->data->reservation->fax)>1) ? $decoded->data->reservation->fax : "";
  $contactcell = (strlen($decoded->data->reservation->mobile_phone)>1) ? $decoded->data->reservation->mobile_phone : "";
  $contactwork = (strlen($decoded->data->reservation->work_phone)>1) ? $decoded->data->reservation->work_phone : "";
  $contactstate = (strlen($decoded->data->reservation->state_name)>1) ? $decoded->data->reservation->state_name : "";
  //$contactrewardpoints = (strlen($decoded->data->reservation->redeemable_points)>1) ? $decoded->data->reservation->redeemable_points : "";
  $contactcountry = (strlen($decoded->data->reservation->country_name)>1) ? $decoded->data->reservation->country_name : "";
  $contactkids = (strlen($decoded->data->reservation->occupants_small)>0) ? $decoded->data->reservation->occupants_small : ""; //kids_present_5aff0c0835466
$contactcheckin = (strlen($decoded->data->reservation->startdate)>0) ? $decoded->data->reservation->startdate : "";
$contactcheckout = (strlen($decoded->data->reservation->enddate)>0) ? $decoded->data->reservation->enddate : "";
$contactpricetotal = (strlen($decoded->data->reservation->price_total)>0) ? $decoded->data->reservation->price_total : "";
$contactlocationname = (strlen($decoded->data->reservation->location_name)>0) ? $decoded->data->reservation->location_name : "";//type_name
$contactemail1 = (strlen($decoded->data->reservation->contactemail1)>0) ? $decoded->data->reservation->contactemail1 : "";
$contactemail2 = (strlen($decoded->data->reservation->contactemail2)>0) ? $decoded->data->reservation->contactemail2 : "";

$contactoccupants = (strlen($decoded->data->reservation->occupants)>0) ? $decoded->data->reservation->occupants : "";
$contactcouponcode = (strlen($decoded->data->reservation->coupon_code)>0) ? $decoded->data->reservation->coupon_code : "";
$contactstatuscode = (strlen($decoded->data->reservation->status_id)>0) ? $decoded->data->reservation->status_id : "";
$contactclientid = (strlen($decoded->data->reservation->client_id)>0) ? $decoded->data->reservation->client_id : "";
$contactrescreated = (strlen($decoded->data->reservation->creation_date)>0) ? $decoded->data->reservation->creation_date : "";
$contactrestype = (strlen($decoded->data->reservation->type_name)>0) ? $decoded->data->reservation->type_name : "";
$contactrestype = (strlen($decoded->data->reservation->type_name)>0) ? $decoded->data->reservation->type_name : "";
$contactbuildingname = (strlen($decoded->data->reservation->unit_name)>0) ? $decoded->data->reservation->unit_name : "";

$method = 'GetAllReservationsByEmail';
$params = array("token_key"=>$token_key,"token_secret"=>$token_secret,"email"=>$contactemail);
//$requestID = date();
$data = array(
    'methodName' => $method,
    'params' => $params
    //'id' => $requestID
);
                       //console.log($data);
//$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey));
$url = "https://web.streamlinevrs.com/api/json";

$data = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data),
    'Expect: '
));

$result = curl_exec($ch);
curl_close($ch);
// echo $result."<br>";


$decoded = json_decode( $result );
$allres = $decoded->data->confirmation_id;
$totalres = sizeof($allres);
//echo $totalres." here<br>";
//for ($x = 0; $x <= 10; $x++) {

$resarray=array();
for ($i = 0; $i < $totalres; ++$i) {

$reslist = $decoded->data->confirmation_id[$i];

array_push($resarray,$reslist);
//echo $resarray;
}
// $reslist = rtrim($reslist,",");
//echo $resarray[0];

//$contactresnum = $decoded->data->reservation->confirmation_id;

$clients=$resarray;  //This is the RESERVATION Confirmation ID.

$contactlifetimespend="";
foreach($clients as $rid) {



  $method = 'GetReservationInfo';
  $params = array("token_key"=>$token_key,"token_secret"=>$token_secret,"confirmation_id"=>$rid);
  //$requestID = date();
  $data = array(
      'methodName' => $method,
      'params' => $params
      //'id' => $requestID
  );
                         //console.log($data);
  //$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey));
  $url = "https://web.streamlinevrs.com/api/json";

  $data = json_encode($data);

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data),
      'Expect: '
  ));

  $result = curl_exec($ch);
  curl_close($ch);
  //echo $result."<br>";

  $decoded = json_decode( $result );
 //var_dump($decoded);

 //$contactspend = $decoded->data->reservation->price_nightly;

 if($decoded->data->reservation->price_paidsum > 0){
   $contactspend = (strlen($decoded->data->reservation->price_nightly)>0) ? $decoded->data->reservation->price_nightly : "";

  $contactlifetimespend = $contactlifetimespend+$contactspend;
           }



}

$method = 'GetReservationFlags';
$params = array("token_key"=>$token_key,"token_secret"=>$token_secret,"confirmation_id"=>$id);
//$requestID = date();
$data = array(
    'methodName' => $method,
    'params' => $params
    //'id' => $requestID
);
                       //console.log($data);
//$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey));
$url = "https://web.streamlinevrs.com/api/json";

$data = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data),
    'Expect: '
));

$result = curl_exec($ch);
curl_close($ch);

//echo $result.'<br>';
$decoded = json_decode( $result );
//var_dump($decoded);
$allflags = $decoded->data->flags->flag;
$totalflags = sizeof($allflags);

//for ($x = 0; $x <= 10; $x++) {

for ($i = 0; $i < $totalflags; ++$i) {

$flaglist .= $decoded->data->flags->flag[$i]->name.",";

}
$flaglist = rtrim($flaglist,",");
$contactflags = (strlen($flaglist)>0) ? $flaglist : "";

//echo $contactflags;

// contactemail1 additional_email__1_5b1aece998598
// contactemail2 additional_email__2_5b1aecf89f8c1
// contactcreationdate  customer_creation_date_5b1aeacb03d8e
// contactoccupants - 1 = additional_guests_5b1aeb1a4c8b6
// contactcouponcode coupon_applied_5b1aeba5de854
// contactstatuscode reservation_status_5b1aebc831a37
// streamline client id  streamline_client_id_5b20022465f7a
//building_name_5b1aeb5cdf02d

$method = 'GetClientInfo';
$params = array("token_key"=>$token_key,"token_secret"=>$token_secret,"client_id"=>$contactclientid);
//$requestID = date();
$data = array(
    'methodName' => $method,
    'params' => $params
    //'id' => $requestID
);
                       //console.log($data);
//$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey));
$url = "https://web.streamlinevrs.com/api/json";

$data = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data),
    'Expect: '
));

$result = curl_exec($ch);
curl_close($ch);
//echo $result;

$decoded = json_decode( $result );
//var_dump($decoded);
//$contactage = $decoded->data->reservation->age;
//customer_creation_date_5b1aeacb03d8e
//reward_points_5aff0c0838f02
$contactage = (strlen($decoded->data->info->age)>1) ? $decoded->data->info->age : "";
$contactcreated = (strlen($decoded->data->info->creation_date)>0) ? $decoded->data->info->creation_date : "";
$contactrewards = (strlen($decoded->data->info->redeemable_points)>0) ? $decoded->data->info->redeemable_points : "";
$contacttitle = (strlen($decoded->data->info->title)>0) ? $decoded->data->info->title : "";


$method = 'createLeads';
$params = array('emailAddress'=>$contactemail,'firstName'=>$contactfname,'lastName'=>$contactlname,'street'=>$contactaddress,'city'=>$contactcity,'zipcode'=>$contactzip,'phoneNumber'=>$contactphone,'officePhoneNumber'=>$contactwork,'mobilePhoneNumber'=>$contactcell,'faxNumber'=>$contactfax,'country'=>$contactcountry,'type_of_contact_5afdcdb19cfe0'=>'Guest','state'=>$contactstate,'kids_present_5aff0c0835466'=>$contactkids,'arrival_date_5aff0c0836a0a'=>$contactcheckin,'arrival_date_5aff0c0836a0a'=>$contactcheckin,'department_5aff0c081ac9c'=>$contactcheckout,'reservation_total_5aff0c081e9bf'=>$contactpricetotal,'property_5aff0c081c7f0'=>$contactlocationname,'additional_email__1_5b1aece998598'=>$contactemail1, 'email__2_5b1aecf89f8c1'=>$contactemail2, 'customer_creation_date_5b1aeacb03d8e'=>$contactcreationdate, 'additional_guests_5b1aeb1a4c8b6'=>$contactoccupants, 'coupon_applied_5b1aeba5de854'=>$contactcouponcode, 'reservation_status_5b1aebc831a37'=>$contactstatuscode,'streamline_client_id_5b20022465f7a'=>$contactclientid,'age_5b20061d34568'=>$contactage,'customer_creation_date_5b1aeacb03d8e'=>$contactcreated,'reward_points_5aff0c0838f02'=>$contactrewards,'title'=>$contacttitle,'reservation_created_5b1aebea95bf4'=>$contactrescreated,'reservation_type_5b1aec0179234'=>$contactrestype,'reservation_flags_5b1aec3e3454e'=>$contactflags,"building_name_5b1aeb5cdf02d"=>$contactbuildingname,"total_lifetime_spend_5aff0c0837a7b"=>$contactlifetimespend);
$requestID = session_id();
$accountID = '123456789';
$secretKey = '123456789';
$data = array(
    'method' => $method,
    'params' => $params,
    'id' => $requestID,
);

$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey));
$url = "http://api.sharpspring.com/pubapi/v1/?$queryString";
$data = json_encode($data);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data),
    'Expect: '
));

$result = curl_exec($ch);
curl_close($ch);

echo $result.'<br>';
echo $n.",";
$n++;
}
?>
