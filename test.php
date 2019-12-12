    


<?php 
//controller file
    public function get_countrycode(){
        if ($_SERVER['CONTENT_TYPE'] == 'application/json' && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $inputJSON = file_get_contents("php://input");
            $input = json_decode($inputJSON, TRUE);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://switch.nyerhosmobile.com/Dialer_API_23717/api.php?request=get_country_info");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
            curl_setopt($ch,CURLOPT_TIMEOUT, 20);
            $server_output = json_decode(curl_exec($ch));
            curl_close ($ch);
    
            $counry_code = $server_output->response->country_arr;

            if(count($counry_code)>0){
                $status = "Success";
                $message = "Phone code found.";
                $data = array("Common" => array("Title" => "Get country code for phone API", 'version' => '1.0', 'Description' => 'Get country code for phone API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("PhoneCode" => $counry_code));
                print(json_encode($data, JSON_UNESCAPED_UNICODE));

            }else{
                $status = "Fail";
                $message = "Phone code not found.";
                $data = array("Common" => array("Title" => "Get country code for phone API", 'version' => '1.0', 'Description' => 'Get country code for phone API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("Value" => 'Phone code not found.'));
                print(json_encode($data, JSON_UNESCAPED_UNICODE));
            }
        } else {
            $status = "Fail";
            $message = "Invalid request.";
            $data = array("Common" => array("Title" => "Get country code for phone API", 'version' => '1.0', 'Description' => 'Get country code for phone API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("Value" => 'Invalid request'));
            print(json_encode($data, JSON_UNESCAPED_UNICODE));
        }
    }
?>
<!-- view file -->
<script>
    $(document).ready(function () {
           getCountryPhoneCode();
    });

    function getCountryPhoneCode() {
        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            url: "<?php echo base_url('Api/get_countrycode');?>",
            success: function (result) {
                var objToString = JSON.stringify(result);
                var stringToArray = [];
                stringToArray.push(objToString);
                var jsonObj = $.parseJSON(stringToArray);
                var message = jsonObj.Common.Message;
                if (message == "Phone code found.") {
                    for (var i = 0; i < jsonObj.Response.PhoneCode.length; i++) {
                        var info = '';

                        if (jsonObj.Response.PhoneCode[i].country_id == '88') {
                            info += '<option selected value="' + jsonObj.Response.PhoneCode[i].country_id + '">' + jsonObj.Response.PhoneCode[i].country_name + '</option>';
                        } else {
                            info += '<option value="' + jsonObj.Response.PhoneCode[i].country_id + '">' + jsonObj.Response.PhoneCode[i].country_name + '</option>';
                        }

                        $('#phoneCode').append(info);
                    }
                }
            }
        });
    }
</script>