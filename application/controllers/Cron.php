<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    //expire payments
    public function expire_payments()
    {   

        $payments = $this->common_model->get_expire_payments();
        foreach ($payments as $payment) {
            $data = array(
                'status' => 'expire'
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->update($data, $payment->id, 'payment');
        }

        //check trial expire users
        $trial_users = $this->common_model->get_trial_users();
        foreach ($trial_users as $user) {
            $user_data = array(
                'status' => 1,
                'user_type' => 'registered',
                'trial_expire' => '0000-00-00'
            );
            $user_data = $this->security->xss_clean($user_data);
            $this->common_model->update($user_data, $user->id, 'users');
        }

        //send expire reminder
        $expire_days = settings()->expire_reminder;
        if ($expire_days != 0) {
            $epayments = $this->common_model->get_notified_expire_payments($expire_days);
            foreach ($epayments as $epayment) {
                $subject = settings()->site_name.' '.trans('subscription-expire-reminder');
                $message = trans('hello').' '.$epayment->name.', <br>'.trans('your').' '.settings()->site_name.' '.strtolower(trans($epayment->billing_type)).' '.trans('subscription-will-expire-in').' '.settings()->expire_reminder.' '.trans('days').'. '.trans('please-click-below-link-to-renew-your-plan').' <br>'.'<a href="'.base_url().'">'.base_url().'</a>';
                echo $subject.'<br>'.$message; exit();
                if (!empty($epayment->email)) {
                    $this->email_model->send_email($epayment->email, $subject, $message);
                }
            }
        }
        
    }


    public function test_sms(){
        //echo "string"; exit();
        // Require the bundled autoload file - the path may need to change
        // based on where you downloaded and unzipped the SDK
        require_once('application/libraries/twilio/src/Twilio/autoload.php');

        // Your Account SID and Auth Token from console.twilio.com
        $sid = "AC717220f9df70d32be2825ec1cf56c84d";
        $token = "f569e4dc4590208914618cd89486bb15";
        $client = new Twilio\Rest\Client($sid, $token);

        // Use the Client to make requests to the Twilio REST API
        $client->messages->create(
            // The number you'd like to send the message to
            '+8801773505917',
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => '+16592349494',
                // The body of the text message you'd like to send
                'body' => "Hey Jahangir vai. Apnar Ex girlfriend kmn ase !"
            ]
        );
    }


    public function test_whatsapp()
    {
        
        $instance_id = 'instance77174';
        $token = 'trcap6rwyjvpw8og';
        $params=array(
            'token' => $token,
            'to' => '+8801722773224',
            'body' => 'hi, this is a testing meassage'
        );
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ultramsg.com/".$instance_id."/messages/chat",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => http_build_query($params),
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          echo "Error #:" . $err;
            return false;
        } else {
          echo $response;
            return true;
        }
        
    }

}