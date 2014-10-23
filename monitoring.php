<!DOCTYPE html>
<?php header("Content-type:text/xml"); ?>
<pingdom_http_custom_check>

<?php
  $tn_did = $_GET['tndid'];
  $dev_key = $_GET['devkey'];

  if(empty($tn_did) || empty($dev_key))
  {
    http_response_code(500);
    die();
  }

  $service_url = "https://api.careerbuilder.com/v1/jobsearch?DeveloperKey=".$dev_key."&TalentNetworkDID=".$tn_did."&PerPage=10&PageNumber=1&SearchAllCountries=True&IncludePrivateJobs=True&IncludeInternalJobs=True&SiteEntity=talentnetworkjob";
  $curl = curl_init($service_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $curl_response = curl_exec($curl);
  $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);
  $xml = new SimpleXMLElement($curl_response);

  //var_dump($xml);
  $total_count = $xml->TotalCount;

  if($total_count == 0 || $http_status != 200)
  {
    echo '<status>ERROR</status>';
  }
  else
  {
    echo '<status>OK</status>';
  }
  echo '<response_time>'.$xml->TimeElapsed.'</response_time>';



?>
</pingdom_http_custom_check>
