<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	//check admin
	if (!function_exists('is_admin')) 
	{
	    function is_admin()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_admin();
	    }
	}

	//check editor
	if (!function_exists('is_user')) 
	{
	    function is_user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_user();
	    }
	}

	//check editor
	if (!function_exists('is_staff')) 
	{
	    function is_staff()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_staff();
	    }
	}


	//check editor
	if (!function_exists('is_patient')) 
	{
	    function is_patient()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_patient();
	    }
	}

	//check editor
	if (!function_exists('is_pro_user')) 
	{
	    function is_pro_user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_pro_user();
	    }
	}

	if (!function_exists('currentUrl')) 
	{
		function currentUrl()
		{
		    // $http = 'http';
		    // if (isset($server['HTTPS'])) {
		    //     $http = 'https';
		    // }
		    // $host = $server['HTTP_HOST'];
		    // $requestUri = $server['REQUEST_URI'];
		    return $_SERVER['REQUEST_SCHEME'];
		}
	}


	//check auth
	if (!function_exists('check_auth')) 
	{
	    function check_auth()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_logged_in();
	    }
	}


	if (!function_exists('update_version')) 
	{
	    function update_version()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $settings = $ci->admin_model->get('settings');
	        if ($settings->version == '1.3') {
	            $data = array(
	                'version' => '1.4'
	            );
	            $ci->admin_model->edit_option($data, 1, 'settings');
	        }

	    }
	}


	//check auth
	if (!function_exists('check_status')) 
	{
	    function check_status()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        if (settings()->type != 'live') {
	            $ci->session->set_flashdata('error', 'Some actions are disabled in demo site but this will not affect in your purchase script');
	            return redirect($_SERVER['HTTP_REFERER']);
	        }
	    }
	}



	//get logged user
	if (!function_exists('user')) 
	{
	    function user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $user = $ci->auth_model->get_logged_user();
	        if (empty($user)) 
			{
	            $ci->auth_model->logout();
	        } else {
	            return $user;
	        }

	    }
	}


	if(!function_exists('get_user_info')){
	    function get_user_info(){     
			return true;
	        $ci = get_instance();

    		if (settings()->sid < '2022-01-16') {
    			return true;
    		}else{ 
        		if (settings()->site_info == 2){
		        	return true;
		        }else{
			        return false;
			    }
			}
	    }
    } 


	//check auth
	if (!function_exists('get_percentage')) 
	{
	    function get_percentage($total, $number)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        if ( $total > 0 ) {
			   return round($number * ($total / 100),2);
			} else {
			    return 0;
			}
	    }
	}


	if (!function_exists('hash_password')) {
	    function hash_password($password)
	    {	
	    	$ci =& get_instance();
	        return password_hash($password, PASSWORD_BCRYPT);
	    }
	}

	

	// current date time function
	if(!function_exists('my_date_now')){
	    function my_date_now(){        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}

	// show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){       
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h:i A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('month_show')){
	    function month_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"F y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('show_year')){
	    function show_year($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	if(!function_exists('date_dif')){
	    function date_dif($date1, $date2){ 
	    	$date1 = date_create($date1);
			$date2 = date_create($date2);
			//difference between two dates
			$diff = date_diff($date1,$date2);
			//count days
			return $diff->format("%a");
	    }
	}



	// check my payment status
	if(!function_exists('get_interval')){
	    function get_interval(){        
	        $ci = get_instance();

	        if ($ci->session->userdata('role') == 'user') {
	            $user_id = $ci->session->userdata('id');
	        } else {
	            $user_id = $ci->session->userdata('parent');
	        }
	        
	        $response = $ci->common_model->get_by_id($user_id, 'users');
	        if (empty($response)) {
	        	return FALSE;
	        } else {
	        	return $response->intervals;
	        }
	    }
    } 

	

	// check my payment status
	if(!function_exists('check_my_payment_status')){
	    function check_my_payment_status(){
	        $ci = get_instance();
            if ($ci->session->userdata('role') == 'user') {
                $user_id = $ci->session->userdata('id');
            } else {
                $user_id = $ci->session->userdata('parent');
            }
            $user = $ci->common_model->get_by_id($user_id, 'users');
            $payment = $ci->admin_model->get_my_payment();
            if (!empty($user) && isset($user->user_type)) {
                if ($user->user_type == 'trial') {
                    return TRUE;
                }
            }else{

		        if (number_format($payment->amount, 0) == 0){
		        	return TRUE;
		        }else{

			        if ($payment->status == 'verified') {
			        	return TRUE;
			        } else {
			        	return FALSE;
			        }
			    }
			}
	    }
    }


    // check my payment status
	if(!function_exists('check_appointment_payment')){
	    function check_appointment_payment($amp_id, $user_id){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->check_appointment_payment($amp_id, $user_id);
	        
	        if (empty($payment)){
	        	return 0;
	        }else{
		        if ($payment->status == 'verified') {
		        	return 1;
		        } else {
		        	return 0;
		        }
		    }
	    }
    } 

    if (!function_exists('check_role_assign_features')) {
	    function check_role_assign_features($staff_id, $chamber_id, $feature_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->check_role_assign_features($staff_id, $chamber_id, $feature_id);
	    }
	}

	if (!function_exists('check_staff_permissions')) {
	    function check_staff_permissions($slug)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->check_staff_permissions($slug);
	    }
	}

    // check my payment status
	if(!function_exists('evisit_settings')){
	    function evisit_settings($user_id){        
	        $ci = get_instance();
	        $response = $ci->common_model->user_evisit_settings($user_id);
	        if (empty($response)) {
	        	return FALSE;
	        } else {
	        	return $response;
	        }
		    
		    
	    }
    } 


    // check my payment status
	if(!function_exists('check_patient_rating')){
	    function check_patient_rating($patient_id, $user_id){        
	        $ci = get_instance();
	        $response = $ci->common_model->check_patient_rating($patient_id, $user_id);
	        if (empty($response)) {
	        	return FALSE;
	        } else {
	        	return $response;
	        }
		    
		    
	    }
    } 



	if(!function_exists('total_rating')){
	    function total_rating($user_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_total_rating_user($user_id);
	        return $response;
	    }
    } 

    if(!function_exists('total_rating_user')){
	    function total_rating_user($user_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_total_ratings_by_user($user_id);
	        return $response;
	    }
    } 


    // check my payment status
	if(!function_exists('user_payment_details')){
	    function user_payment_details($user_id){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->get_user_payment($user_id);
		    return $payment;
	    }
    } 


	if(!function_exists('check_user_verification')){
	    function check_user_verification($user_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_by_user_id($user_id, 'verification_files');
	        if (!empty($response)) {
	        	return TRUE;
	        }else{
	        	return FALSE;
	        }
	    }
    } 



    // check my payment status
	if(!function_exists('check_package_features')){
	    function check_package_features($slug, $user_id){        
	        $ci = get_instance();
	        $feature = $ci->common_model->get_by_slug($slug, 'features');
	        $payment = $ci->common_model->get_user_payment($user_id);
	        $check = $ci->common_model->get_assign_features_by_package($payment->package_id, $feature->id);

	        if (empty($check)) {
	        	return FALSE;
	        } else {
	        	return TRUE;
	        }
	    }
    } 


    // check my payment status
	if(!function_exists('check_user_payment')){
	    function check_user_payment($user_id){        
	        $ci = get_instance();
	        $payment = $ci->common_model->get_user_payment($user_id);
	        $settings = $ci->admin_model->get_settings();
	        
	        $user = $ci->common_model->get_user($user_id);
	 
	        if ($user->status != 1) {
	        	redirect(base_url('home/status'));
	        }

	        if ($payment->status == 'verified') {
	        	return TRUE;
	        }else if ($payment->status == 'expire') {
	        	if ($settings->enable_paypal == 0) {
	        		return;
	        	} else {
	        		redirect(base_url('home/status'));
	        	}
	        } else {
	        	if ($settings->enable_paypal == 0) {
	        		return;
	        	} else {
	        		redirect(base_url('home/status'));
	        	}
	        }

	    }
    }



    // get feature limit
	if(!function_exists('check_feature_access')){
	    function check_feature_access($slug){
	        $ci = get_instance();
	        $package = $ci->common_model->get_my_package();
	        $feature = $ci->common_model->get_feature($slug);
	        $assign = $ci->admin_model->check_assign_feature($feature->id, $package->package_id);

            if (!empty(user()) && isset(user()->user_type)) {
                if (user()->user_type == 'trial') {
                    return TRUE;
                }
            }else{
		        if (isset($assign) && $assign == TRUE) {
		        	return TRUE;
		        } else {
			        return FALSE;
		        }
		    }
	    }
    }


    // get feature limit
	if(!function_exists('check_user_feature_access')){
	    function check_user_feature_access($slug, $user_id){        
	        $ci = get_instance();
	        $user = $ci->auth_model->get_user($user_id);
	        $package = $ci->common_model->get_user_package($user_id);
	        $feature = $ci->common_model->get_feature($slug);
	        $assign1 = $ci->admin_model->check_assign_feature($feature->id, $package->package_id);
	        //echo '<pre>'; print_r($package->package_id);

	        if (!empty($user) && $user->user_type == 'trial') {
	        	return TRUE;
	        }else{
		        if (isset($assign1) && $assign1 == TRUE) {
		        	return TRUE;
		        } else {
			        return FALSE;
		        }
		    }
	    }
    } 


    // get feature limit
	if(!function_exists('get_feature_limit')){
	    function get_feature_limit($id){        
	        $ci = get_instance();
	        $feature = $ci->common_model->get_feature_limit($id);
	        if (empty($feature)) {
	        	return;
	        } else {
	        	return $feature;
	        }
	    }
    } 

    // get feature limit
	if(!function_exists('count_users_by_status')){
	    function count_users_by_status($type){        
	        $ci = get_instance();
	        $value = $ci->admin_model->count_users_by_status($type);
	        if (empty($value)) {
	        	return 0;
	        } else {
	        	return $value->total;
	        }
	    }
    } 


    // get discount
	if(!function_exists('get_total_value')){
	    function get_total_value($table){            
	        $ci = get_instance();
	        $user = $ci->admin_model->get_my_payment();
	        $value = $ci->admin_model->get_total_value($table, $user->created_at);
	        return $value;
	    }
	}


    // check plan limit
	if(!function_exists('ckeck_plan_limit')){
	    function ckeck_plan_limit($slug, $value){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->get_my_payment();
	        $package = $ci->admin_model->get_by_id($payment->package_id, 'package');
	        $feature = $ci->common_model->get_feature($slug);

	        if (!empty(user()) && user()->user_type == 'trial') {
	        	return TRUE;
	        }else{

		        $slug = $package->slug;
		        if (empty($feature) || empty($payment)) {
		        	return FALSE;
		        } else {
		        	if ($feature->$slug > 0) {
			        	if ($feature->$slug > $value) {
			        		return TRUE;
			        	}else{
			        		return FALSE;
			        	}
			        }else{
			        	return TRUE;
			        }
		        }
		    }
	    }
    } 

	//get category
	if (!function_exists('get_days')) {
	    function get_days()
	    {
	        $days = array(
	        	'1'=>'Sunday',
	        	'2'=>'Monday',
	        	'3'=>'Tuesday',
	        	'4'=>'Wednesday',
	        	'5'=>'Thursday',
	        	'6'=>'Friday',
	        	'7'=>'Saturday',
	        );
	        return $days;
	    }
	}


	//get category
	if (!function_exists('get_day_id')) {
	    function get_day_id($day)
	    {
	    	if ($day == 'Sunday') {
	    		return 1;
	    	} else if($day == 'Monday') {
	    		return 2;
	    	}else if($day == 'Tuesday') {
	    		return 3;
	    	}else if($day == 'Wednesday') {
	    		return 4;
	    	}else if($day == 'Thursday') {
	    		return 5;
	    	}else if($day == 'Friday') {
	    		return 6;
	    	}else if($day == 'Saturday') {
	    		return 7;
	    	}
	    }
	}


	//get dates
	if (!function_exists('get_dates')) {
	    function get_dates()
	    {
	        $dates = array(
	        	'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11', 
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19',
				'20' => '20',
				'21' => '21',
				'22' => '22',
				'23' => '23',
				'24' => '24',
				'25' => '25',
				'26' => '26',
				'27' => '27',
				'28' => '28',
				'29' => '29',
				'30' => '30',
				'31' => '31'
	        );
	        return $dates;
	    }
	}


 
	if(!function_exists('get_total_user_by_package')){
	    function get_total_user_by_package($id){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_total_user_by_package($id);
	        return $option;
	    }
    } 

    
	//get category
	if (!function_exists('helper_get_category')) {
	    function helper_get_category($category_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_category($category_id);
	    }
	}

	//get category
	if (!function_exists('helper_get_category_option')) {
	    function helper_get_category_option($category_id, $table)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_category_option($category_id, $table);
	    }
	}

	//delete image from server
	if (!function_exists('delete_image_from_server')) {
	    function delete_image_from_server($path)
	    {
	        $full_path = FCPATH . $path;
	        if (strlen($path) > 15 && file_exists($full_path)) {
	            unlink($full_path);
	        }
	    }
	}


	// get settings
  	if(!function_exists('get_settings')){
	    function get_settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_settings();        
	        
	        return $option;
	    }
    } 


    if(!function_exists('settings')){
	    function settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_settings();        
	        
	        return $option;
	    }
    } 


    // get pages
  	if(!function_exists('get_pages')){
	    function get_pages(){        
	        $ci = get_instance();
	        $option = $ci->common_model->select_asc('pages');
	        return $option;
	    }
    } 



    //transalate language
	if (!function_exists('trans'))
	{
	    function trans($string)
	    {
	        $ci =& get_instance();
	        return $ci->lang->line($string);
	    }
	}


    // get pages
  	if(!function_exists('get_pages')){
	    function get_pages(){        
	        $ci = get_instance();
	        $option = $ci->common_model->select_asc('pages');
	        return $option;
	    }
    }


    // get name by id
  	if(!function_exists('get_name_by_id')){
	    function get_name_by_id($id,$table){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_name_by_id($id,$table);
	        return $option;
	    }
    } 

    // get name by id
  	if(!function_exists('get_by_id')){
	    function get_by_id($id,$table){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_by_id($id,$table);
	        return $option;
	    }
    } 


    // get name by id
  	if(!function_exists('get_reports_by_prescription')){
	    function get_reports_by_prescription($pre_id){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_reports_by_prescription($pre_id);
	        return $option;
	    }
    } 


    // get author info
	if(!function_exists('count_posts_by_categories')){
	    function count_posts_by_categories($id){        
	        $ci = get_instance();
	        $category = $ci->admin_model->get_by_id($id, 'blog_category');
	        
	        $option = $ci->admin_model->count_posts_by_categories($id);
	        return $option->total;
	    }
    } 

    // get time
	if(!function_exists('get_time_by_days')){
	    function get_time_by_days($id, $user_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_time_by_days($id, $user_id);
	        return $response;
	    }
    } 

    // get time
	if(!function_exists('get_time_by_id')){
	    function get_time_by_id($id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_time_by_id($id);
	        return $response->start.'-'.$response->end;
	    }
    } 

    // get time
	if(!function_exists('check_time')){
	    function check_time($id, $date){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_time($id, $date);
	        return $response;
	    }
    } 


    // get author info
	if(!function_exists('get_logged_user')){
	    function get_logged_user($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_by_id($id, 'users');
	        return $option;
	    }
    } 


    if (!function_exists('session')) 
    {
        function session($string)
        {
            $ci =& get_instance();
            return $ci->session->userdata($string);
        }
    }


    
	//get domain
	if (!function_exists('get_current_domain')) {
	    function get_current_domain()
	    {
	        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$parse = parse_url($url);
			$domain = $parse['host'];
	        return $domain;
	    }
	}

	//get domain
	if (!function_exists('get_user_domain')) {
	    function get_user_domain($user_id)
	    {	
	    	$ci =& get_instance();
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_user_domain($user_id);
	        return $option;
	    }
	}


	if (!function_exists('get_commission')) {
	    function get_commission($price, $commission)
	    {
			//Calculate how much VAT needs to be paid.
			$percent = ($price / 100) * $commission;
			//The total price, including VAT.
			$total = $price - $percent;
	        return number_format($total, 2);
	    }
	}


	if (!function_exists('get_commission_rate')) {
	    function get_commission_rate($price, $commission)
	    {
			//Calculate how much VAT needs to be paid.
			$percent = ($price / 100) * $commission;
	        return number_format($percent, 2);
	    }
	}


    // count todays patients
	if(!function_exists('count_todays_patient')){
	    function count_todays_patient($date){        
	        $ci = get_instance();
	        $option = $ci->admin_model->count_todays_patient($date);
	        return $option;
	    }
    } 


    // count todays patients
	if(!function_exists('currency_symbol')){
	    function currency_symbol($currency){        
	        $ci = get_instance();
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_currency_symbol($currency);
	        return $option->currency_symbol;
	    }
    } 


    //get currency
	if (!function_exists('get_my_chambers')) {
		function get_my_chambers() {
	        $ci =& get_instance();
	        if(user()->role == 'user'){
	        	$result = $ci->admin_model->get_my_all_chambers();
	        }else{
	        	//$result = $ci->admin_model->get_my_all_chambers();
	        	$result = $ci->admin_model->get_staff_chambers(user()->user_id, user()->chamber_id);
	        }
	        return $result;
	    }
    }


    if(!function_exists('resize_img')){
		function resize_img($fullname, $width, $height){         
			
			$dir = 'uploads/pwa/';
			$url = base_url() . 'uploads/pwa/';
        	// Get the CodeIgniter super object
			$CI = &get_instance();
        	// get src file's extension and file name
			$extension = pathinfo($fullname, PATHINFO_EXTENSION);
			$filename = pathinfo($fullname, PATHINFO_FILENAME);
			$image_org = $dir . $filename . "." . $extension;
			$image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;
			$image_returned = $url . $filename . "-" . $height . '_' . $width . "." . $extension;

			if (!file_exists($image_thumb)) {
            	// LOAD LIBRARY
				$CI->load->library('image_lib');
            	// CONFIGURE IMAGE LIBRARY
				$config['source_image'] = $image_org;
				$config['new_image'] = $image_thumb;
				$config['width'] = $width;
				$config['height'] = $height;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$CI->image_lib->initialize($config);
				$CI->image_lib->resize();
				$CI->image_lib->clear();
			}
			return $image_returned;
		}
	}



    if(!function_exists('get_time_ago')){
	    function get_time_ago($time_ago){        
	        $ci = get_instance();
	        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = strtotime($dt->format('Y-m-d H:i:s')); 

	        $time_ago = strtotime($time_ago);
	        $cur_time   = $date_time;
	        $time_elapsed   = $cur_time - $time_ago;
	        $seconds    = $time_elapsed ;
	        $minutes    = round($time_elapsed / 60 );
	        $hours      = round($time_elapsed / 3600);
	        $days       = round($time_elapsed / 86400 );
	        $weeks      = round($time_elapsed / 604800);
	        $months     = round($time_elapsed / 2600640 );
	        $years      = round($time_elapsed / 31207680 );
	        // Seconds

	        //return $seconds;

	        if($seconds <= 60){
	            return "just now";
	        }
	        //Minutes
	        else if($minutes <=60){
	            if($minutes==1){
	                return "one minute ago";
	            }
	            else{
	                return "$minutes minutes ago";
	            }
	        }
	        //Hours
	        else if($hours <=24){
	            if($hours==1){
	                return "an hour ago";
	            }else{
	                return "$hours hrs ago";
	            }
	        }
	        //Days
	        else if($days <= 7){
	            if($days==1){
	                return "yesterday";
	            }else{
	                return "$days days ago";
	            }
	        }
	        //Weeks
	        else if($weeks <= 4.3){
	            if($weeks==1){
	                return "a week ago";
	            }else{
	                return "$weeks weeks ago";
	            }
	        }
	        //Months
	        else if($months <=12){
	            if($months==1){
	                return "a month ago";
	            }else{
	                return "$months months ago";
	            }
	        }
	        //Years
	        else{
	            if($years==1){
	                return "one year ago";
	            }else{
	                return "$years years ago";
	            }
	        }


	        
	    }
	}


	//slug generator
	if (!function_exists('str_slug')) {
	    function str_slug($str, $separator = 'dash', $lowercase = TRUE)
	    {
	        $str = trim($str);
	        $CI =& get_instance();
	        $foreign_characters = array(
	            '/ä|æ|ǽ/' => 'ae',
	            '/ö|œ/' => 'o',
	            '/ü/' => 'u',
	            '/Ä/' => 'Ae',
	            '/Ü/' => 'u',
	            '/Ö/' => 'o',
	            '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'A',
	            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
	            '/Б/' => 'B',
	            '/б/' => 'b',
	            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
	            '/ç|ć|ĉ|ċ|č/' => 'c',
	            '/Д/' => 'D',
	            '/д/' => 'd',
	            '/Ð|Ď|Đ|Δ/' => 'Dj',
	            '/ð|ď|đ|δ/' => 'dj',
	            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'E',
	            '/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e',
	            '/Ф/' => 'F',
	            '/ф/' => 'f',
	            '/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'G',
	            '/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g',
	            '/Ĥ|Ħ/' => 'H',
	            '/ĥ|ħ/' => 'h',
	            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'I',
	            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i',
	            '/Ĵ/' => 'J',
	            '/ĵ/' => 'j',
	            '/Ķ|Κ|К/' => 'K',
	            '/ķ|κ|к/' => 'k',
	            '/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'L',
	            '/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l',
	            '/М/' => 'M',
	            '/м/' => 'm',
	            '/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'N',
	            '/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n',
	            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'O',
	            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o',
	            '/П/' => 'P',
	            '/п/' => 'p',
	            '/Ŕ|Ŗ|Ř|Ρ|Р/' => 'R',
	            '/ŕ|ŗ|ř|ρ|р/' => 'r',
	            '/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 'S',
	            '/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's',
	            '/Ț|Ţ|Ť|Ŧ|τ|Т/' => 'T',
	            '/ț|ţ|ť|ŧ|т/' => 't',
	            '/Þ|þ/' => 'th',
	            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'U',
	            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
	            '/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'Y',
	            '/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
	            '/В/' => 'V',
	            '/в/' => 'v',
	            '/Ŵ/' => 'W',
	            '/ŵ/' => 'w',
	            '/Ź|Ż|Ž|Ζ|З/' => 'Z',
	            '/ź|ż|ž|ζ|з/' => 'z',
	            '/Æ|Ǽ/' => 'AE',
	            '/ß/' => 'ss',
	            '/Ĳ/' => 'IJ',
	            '/ĳ/' => 'ij',
	            '/Œ/' => 'OE',
	            '/ƒ/' => 'f',
	            '/ξ/' => 'ks',
	            '/π/' => 'p',
	            '/β/' => 'v',
	            '/μ/' => 'm',
	            '/ψ/' => 'ps',
	            '/Ё/' => 'Yo',
	            '/ё/' => 'yo',
	            '/Є/' => 'Ye',
	            '/є/' => 'ye',
	            '/Ї/' => 'Yi',
	            '/Ж/' => 'Zh',
	            '/ж/' => 'zh',
	            '/Х/' => 'Kh',
	            '/х/' => 'kh',
	            '/Ц/' => 'Ts',
	            '/ц/' => 'ts',
	            '/Ч/' => 'Ch',
	            '/ч/' => 'ch',
	            '/Ш/' => 'Sh',
	            '/ш/' => 'sh',
	            '/Щ/' => 'Shch',
	            '/щ/' => 'shch',
	            '/Ъ|ъ|Ь|ь/' => '',
	            '/Ю/' => 'Yu',
	            '/ю/' => 'yu',
	            '/Я/' => 'Ya',
	            '/я/' => 'ya'
	        );

	        $str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

	        $replace = ($separator == 'dash') ? '-' : '_';

	        $trans = array(
	            '&\#\d+?;' => '',
	            '&\S+?;' => '',
	            '\s+' => $replace,
	            '[^a-z0-9\-\._]' => '',
	            $replace . '+' => $replace,
	            $replace . '$' => $replace,
	            '^' . $replace => $replace,
	            '\.+$' => ''
	        );

	        $str = strip_tags($str);

	        foreach ($trans as $key => $val) {
	            $str = preg_replace("#" . $key . "#i", $val, $str);
	        }

	        if ($lowercase === TRUE) {
	            if (function_exists('mb_convert_case')) {
	                $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
	            } else {
	                $str = strtolower($str);
	            }
	        }

	        $str = preg_replace('#[^' . $CI->config->item('permitted_uri_chars') . ']#i', '', $str);

	        return trim(stripslashes($str));
	    }
	}


	//transalate language
	if (!function_exists('trans')) 
	{
	    function trans($string)
	    {
	        $ci =& get_instance();
	        return $ci->lang->line($string);
	    }
	}


	//get language short form
	if (!function_exists('lang_short_form')) 
	{
	    function lang_short_form()
	    {
	        $ci =& get_instance();
	        if ($ci->session->userdata('site_lang') == '') {
	        	$lang = $ci->common_model->get_settings(); 
		        return $lang->short_name;
	        } else {
	        	$name = $ci->session->userdata('site_lang');
	        	$lang = $ci->common_model->get_slug_by_language($name, 'language');
	        	return $lang->short_name;
	        }
	        
	    }
	}


	//get language direction
	if (!function_exists('text_dir')) 
	{
	    function text_dir()
	    {
	        $ci =& get_instance();
	        if ($ci->session->userdata('site_lang') == '') {

		        $lang = $ci->common_model->get_settings(); 
		        return $lang->dir;
	        } else {
	        	$name = $ci->session->userdata('site_lang');
	        	$lang = $ci->common_model->get_slug_by_language($name, 'language');
	        	return $lang->text_direction;
	        }
	    }
	}


	//get language
	if (!function_exists('get_lang')) 
	{
	    function get_lang()
	    {	
	    	$ci =& get_instance();
	        return $ci->session->userdata('site_lang');
	    }
	}


	//get language values
	if (!function_exists('get_language_values')) 
	{
	    function get_language_values()
	    {	
	    	$ci =& get_instance();
	        $option = $ci->admin_model->get_language_values();
	        return $option;
	    }
	}


	//get language
	if (!function_exists('get_language')) 
	{
	    function get_language()
	    {	
	    	$ci =& get_instance();
	        $option = $ci->admin_model->get_language();
	        return $option;
	    }
	}


	function check_domain($str) {

        $CI =& get_instance();
        $CI->form_validation->set_message('fqdn','The %s is not a valid domain name.');

        $tld_list = array(
            'arp', 'com', 'edu', 'gov', 'int', 'mil', 'net', 'org',
            'aero', 'biz', 'coop', 'info', 'museum', 'name', 'pro', 'ws',
            'ac', 'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'aq', 'ar', 'as',
            'at', 'au', 'aw', 'az', 'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj',
            'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv', 'bw', 'by', 'bz', 'ca', 'cc', 'cd',
            'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co', 'cr', 'cu', 'cv', 'cx',
            'cy', 'cz', 'de', 'dj', 'dk', 'dm', 'do', 'dz', 'ec', 'ee', 'eg', 'eh', 'er',
            'es', 'et', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr', 'ga', 'gd', 'ge', 'gf', 'gg',
            'gh', 'gi', 'gl', 'gm', 'gn', 'gp', 'gq', 'gr', 'gs', 'gt', 'gu', 'gw', 'gy',
            'hk', 'hm', 'hn', 'hr', 'ht', 'hu', 'id', 'ie', 'il', 'im', 'in', 'io', 'iq',
            'ir', 'is', 'it', 'je', 'jm', 'jo', 'jp', 'ke', 'kg', 'kh', 'ki', 'km', 'kn',
            'kp', 'kr', 'kw', 'ky', 'kz', 'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt',
            'lu', 'lv', 'ly', 'ma', 'mc', 'md', 'mg', 'mh', 'mk', 'ml', 'mm', 'mn', 'mo',
            'mp', 'mq', 'mr', 'ms', 'mt', 'mu', 'mv', 'mw', 'mx', 'my', 'mz', 'na', 'nc',
            'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nu', 'nz', 'om', 'pa', 'pe',
            'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'ps', 'pt', 'pw', 'py', 'qa',
            're', 'ro', 'ru', 'rw', 'sa', 'sb', 'sc', 'sd', 'se', 'sg', 'sh', 'si', 'sj',
            'sk', 'sl', 'sm', 'sn', 'so', 'sr', 'st', 'sv', 'sy', 'sz', 'tc', 'td', 'tf',
            'tg', 'th', 'tj', 'tk', 'tm', 'tn', 'to', 'tp', 'tr', 'tt', 'tv', 'tw', 'tz',
            'ua', 'ug', 'uk', 'um', 'us', 'uy', 'uz', 'va', 'vc', 've', 'vg', 'vi', 'vn',
            'vu', 'wf', 'ws', 'ye', 'yt', 'yu', 'za', 'zm', 'zw' );

        $label = '[\\w][\\w\\.\\-]{0,61}[\\w]';
        $tld = '[\\w]+';

        if($c=preg_match( "/^($label)\\.($tld)$/", $str, $match ) && in_array( $match[2], $tld_list )) {

            return TRUE;
        }
        else{
            return FALSE;
        }
    }


    if(!function_exists('check_user_balance')){
	    function check_user_balance($user_id, $amount){      
	    	$ci = get_instance();
	    	$user = $ci->admin_model->get_by_id($user_id, 'users'); 
	    	if (!empty($user)) {
	            if ($user->balance >= $amount) {
	                return true;
	            }
	        }
	        return false;
	    }
	}

	if(!function_exists('total_earnings')){
	    function total_earnings($user_id){      
	    	$ci = get_instance();
	    	$user = $ci->admin_model->get_user_earnings($user_id);
	    	if (isset($user) && $user->net_income != '') {
	    		return number_format($user->net_income, 2);
	    	}else{
	    		return '0';
	    	}
	    }
	}

	if(!function_exists('get_user_by_id')){
	    function get_user_by_id($id,$table){        
	        $ci = get_instance();
			$response = $ci->admin_model->select_by_user_id($id,$table);
			return $response;
	    }
    }

    if(!function_exists('reduce_user_balance')){
	    function reduce_user_balance($user_id, $amount){      
	    	$ci = get_instance();
	    	$user = $ci->admin_model->get_by_id($user_id, 'users'); 
	    	if (!empty($user)) {
	            $balance = $user->balance - $amount;
	            $data = array(
	                'balance' => $balance
	            );
	            $ci->common_model->edit_option($data, $user_id, 'users');
	            return true;
	        }
	        return false;
	    }
	}

	if (!function_exists('currency_to_symbol')) 
	{
	    function currency_to_symbol($currency)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $response = $ci->common_model->currency_to_symbol($currency);
	        return $response->currency_symbol;

	    }
	}

	if (!function_exists('price_formatted')) {
	    function price_formatted($price, $type)
	    {
	        $ci =& get_instance();

	       	if ($type == 'site') {
	       		$currency_code = settings()->currency;
	       		$number_format = settings()->num_format;
	       		$symbol_direction = settings()->symbol_direction;
	       		$symbol = currency_to_symbol(settings()->currency);
	       		$price_separator = settings()->price_separator;
	       		if (settings()->space_price_symbol == 0) {
		            $space = "";
	            }else{
	            	$space = " ";
	            }
	       	}else{
	       		$business = $ci->admin_model->get_business_by_id($type);

	       		$currency_code = $business->currency_code;
	       		$number_format = $business->num_format;
	       		$symbol_direction = $business->symbol_direction;
	       		$symbol = $business->currency_symbol;
	       		$price_separator = $business->price_separator;
	       		if ($business->space_price_symbol == 0) {
		            $space = "";
	            }else{
	            	$space = " ";
	            }
	       	}


	       	if ($price_separator == 0) {
       			$dec_point = '.';
        		$thousands_sep = ',';
       		}else{
       			$dec_point = ',';
        		$thousands_sep = '.';
       		}

       		$price = number_format($price, $number_format, $dec_point, $thousands_sep);

       		if (isset($currency_code)) {
	            if ($symbol_direction == "left") {
	                $price =  $symbol . $space . $price;
	            } else {
	                $price = $price . $space .  $symbol ;
	            }
	        }

	        return $price;
	       	
	        
	    }
	}

	if(!function_exists('affiliate_settings')){
	    function affiliate_settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_referral_settings();   
	        return $option;
	    }
    } 