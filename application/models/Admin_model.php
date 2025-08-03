<?php
class Admin_model extends CI_Model {

    // insert function
	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    // edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    // edit function
    function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)', $id);
        $this->db->update($table,$action);
        return;
    } 

    // update function
    function update($action,$id,$table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
    }

    // delete function
    function delete($id,$table){
        if (settings()->type == 'live') {
            $this->db->delete($table, array('id' => $id));
        }
        return;
    }

    // delete days
    function delete_assaign_days($user_id, $table){
        $this->db->delete($table, array('user_id' => $user_id));
        return;
    }

    // delete time
    function delete_assaign_time($user_id, $table){
        $this->db->delete($table, array('user_id' => $user_id));
        return;
    }

    // delete tags
    function delete_assign_features($id, $table){
        $this->db->delete($table, array('package_id' => $id));
        return;
    }

    // delete tags
    function delete_by_prescription_id($prescription_id, $table){
        $this->db->delete($table, array('prescription_id' => $prescription_id));
        return;
    }

    // delete
    function delete_by_user($user_id, $table){
        if (settings()->type == 'live') {
            $this->db->delete($table, array('user_id' => $user_id));
        }
        return;
    }

    // delete assign role permissions
    function delete_by_staff($staff_id, $table){
        if (settings()->type == 'live') {
            $this->db->delete($table, array('staff_id' => $staff_id));
        }
        return;
    }

    // get function
    function get_count($table)
    {
        $this->db->select();
        $this->db->from($table);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

    // get function
    function get_count_by_user_id($table, $user_id)
    {
        $this->db->select();
        $this->db->from($table);
        if ($this->session->userdata('role') == 'user') {
            $this->db->where('user_id', $this->session->userdata('id'));
        } else {
            $this->db->where('user_id', $this->session->userdata('parent'));
        }
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }
  

    // get function
    function get($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // select by function
    function get_by_user($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select by function
    function get_by_user_id($user_id, $table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // select by function
    function select_by_user($table)
    {
        $this->db->select();
        $this->db->from($table);
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_all_role_features($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function check_role_assign_features($staff_id, $chamber_id, $feature_id)
    {
        $this->db->select('u.*');
        $this->db->from('staff_role_permissions u');
        $this->db->where('u.staff_id', $staff_id);
        $this->db->where('u.feature_id', $feature_id);
        $this->db->where('u.chamber_id', $chamber_id);
        $query = $this->db->get();
        $query = $query->row();
        if (empty($query)) {
            return 0;
        } else {
            return 1;
        }
    }

    function check_staff_permissions($slug)
    {
        $this->db->select('u.*,f.slug');
        $this->db->from('staff_role_permissions as u');
        $this->db->join('feature_role as f','f.id=u.feature_id','LEFT');
        $this->db->where('u.staff_id', $this->session->userdata('id'));
        $this->db->where('f.slug', $slug);
        $query = $this->db->get();
        $query = $query->row();
        if (empty($query)) {
            return 0;
        } else {
            return 1;
        }
    }

    function get_drugs($table)
    {
        $this->db->select();
        $this->db->from($table);
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
            $this->db->where('user_id', $user_id);
            $this->db->or_where('is_admin', 1);
        } elseif($this->session->userdata('role') == 'admin') {
            $this->db->where('is_admin', 1);
        }else{
            $user_id = $this->session->userdata('parent');
            $this->db->where('user_id', $user_id);
            $this->db->or_where('is_admin', 1); 
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select by function
    function select_by_chamber($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('chamber_id', $this->chamber->uid);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select function
    function select($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // asc select function
    function select_asc($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select by id
    function select_option($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    // select by id
    function get_by_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // get assaign days
    function get_user_days()
    {
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }

        $this->db->select();
        $this->db->from('assaign_days');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    // get assaign days
    function get_my_days($user_id)
    {
        $this->db->select();
        $this->db->from('assaign_days');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    // get assaign days
    function get_time_by_days($day_id, $user_id)
    {
        $this->db->select();
        $this->db->from('assign_time');
        $this->db->where('day_id', $day_id);
        $this->db->where('user_id', $user_id);
        $this->db->group_by('time');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // get assaign days
    function get_time_by_id($id)
    {
        $this->db->select();
        $this->db->from('assign_time');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    // get assaign days
    function check_time($id, $date)
    {
        $this->db->select();
        $this->db->from('appointments');
        $this->db->where('date', $date);
        $this->db->where('time', $id);
        $query = $this->db->get();
        $query = $query->row();
        if (isset($query)) {
            return true;
        } else {
            return false;
        }
    }


    public function check_department_name($name)
    {
        $this->db->select('*');
        $this->db->from('chamber_category');
        $this->db->where('name', $name);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return FALSE;
        }
    }


   
    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return FALSE;
        }
    }


    public function check_duplicate_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            $result = $this->check_staff_email($email);
            return $result;
        }
    }


    public function check_user_slug($slug)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('slug', $slug); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return true;
        }else{
            return false;
        }
    }


    public function check_staff_email($email)
    {
        $this->db->select('*');
        $this->db->from('staffs');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) { 
            return $query->result();
        }else{
            $result = $this->check_patient_email($email);
            return $result;
        }
    }


    public function check_patient_email($email)
    {
        $this->db->select('*');
        $this->db->from('patientses');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }



    //get report
    function get_admin_income_by_year()
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment r');
        $this->db->group_by("DATE_FORMAT(r.created_at,'%Y')");
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get report
    function get_admin_income_by_date($date)
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment r');
        $this->db->where("DATE_FORMAT(r.created_at,'%Y-%m')", $date);
        $query = $this->db->get();
        $query = $query->result();
        if (empty($query)) {
            return 0;
        } else {
            return $query[0]->total;
        }
    }


    //get payment report
    function get_user_income_by_year()
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment_user r');
        $this->db->where('r.user_id', $this->session->userdata('id'));
        $this->db->group_by("DATE_FORMAT(r.created_at,'%Y')");
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get payment report
    function get_user_income_by_date($date)
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment_user r');
        $this->db->where('r.user_id', $this->session->userdata('id'));
        $this->db->where("DATE_FORMAT(r.created_at,'%Y-%m')", $date);
        $query = $this->db->get();
        $query = $query->result();
        if (empty($query)) {
            return 0;
        } else {
            return $query[0]->total;
        }
    }

    //get report
    function get_users_packages()
    {
        $this->db->select('count(p.id) as total, k.name');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package_id', 'LEFT');
        $this->db->group_by("package_id");
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    function count_users_by_status($type)
    {
        $this->db->select('count(p.id) as total');
        $this->db->from('payment p');
        $this->db->where('p.status', $type);
        $this->db->group_by("p.user_id");
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }

    //get packages
    function get_previous_payments($user_id)
    {
        $this->db->select();
        $this->db->from('payment p');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get category
    public function get_category($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->row();
    }

    //get category
    public function get_category_option($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }


    function get_subcategory($id)
    {
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get_settings
    function get_settings()
    {
        $this->db->select('s.*, c.currency_code, c.currency_symbol');
        $this->db->from('settings s');
        $this->db->join('country c', 'c.id = s.country', 'LEFT');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get_settings
    function get_currency_symbol($currency_code)
    {
        $this->db->select('*');
        $this->db->from('country');
        $this->db->where('currency_code', $currency_code);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    function get_font_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('google_fonts');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // select by id
    function select_option_md5($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where(md5('id'), $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    //get user by id
    public function get_user_by_slug($slug)
    {
        $this->db->where('slug', $slug);
        $query = $this->db->get('users');
        return $query->row();
    }


    function get_home_skills()
    {
        $this->db->select('*');
        $this->db->from('skills');
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('skills');
            $this->db->where('parent_id',$value['id']);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_skills'] = $query2;
        }
        return $query;
    }

    function get_home_experiences()
    {
        $this->db->select('*');
        $this->db->from('experience');
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('experience');
            $this->db->where('parent_id',$value['id']);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_exp'] = $query2;
        }
        return $query;
    }



    // get_categories
    function get_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', 0);
        $this->db->order_by('cat_order', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get_subcategories
    function get_subcategories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id !=', 0);
        $this->db->where('sub', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 



    // get_subcategories
    function sub_sub_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('sub', 1);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get_categories
    function get_skills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get_subcategories
    function get_subskills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get_categories
    function get_experience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get_subcategories
    function get_subexperience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get_categories
    function get_portfolio_categories(){
        $this->db->select();
        $this->db->from('portfolio_category');
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get portfolio
    function get_home_portfolio(){
        $this->db->select('p.*');
        $this->db->select('c.slug as category');
        $this->db->from('portfolio p');
        $this->db->join('portfolio_category c', 'c.id = p.category_id', 'RIGHT');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get blog posts
    function get_blog_posts($total, $limit, $offset){
        $this->db->select('b.*');
        $this->db->select('c.slug as category_slug, c.name as category, u.role');
        $this->db->from('blog_posts b');
        $this->db->where('u.role', 'admin');
        $this->db->where('b.user_id', $this->session->userdata('id'));
        $this->db->join('blog_category c', 'c.id = b.category_id', 'LEFT');
        $this->db->join('users u', 'u.id = b.user_id', 'LEFT');
        $this->db->limit($limit);
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 


    //get posts categories
    function get_category_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('blog_category');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //get posts categories
    function get_name_by_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row_array();  
        return $query;
    }


    //get posts categories
    function get_reports_by_prescription($id)
    {
        $this->db->select('d.*, a.name as test_name');
        $this->db->from('diagnosis_reports as d');
        $this->db->join('advise_investigations as a', 'a.id = d.diagnosis_id', 'LEFT');
        $this->db->where('d.prescription_id', $id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    //get category posts
    function get_category_posts($total, $limit, $offset, $id)
    {

        $this->db->select('p.*');
        $this->db->select('c.name as category, c.slug as category_slug');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category as c', 'c.id = p.category_id', 'LEFT');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit($limit);
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    //get category posts
    function count_posts_by_categories($id)
    {
        $this->db->select('count(p.id) as total');
        $this->db->from('blog_posts p');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->row();
        }else{
            return 0;
        }
    }


    // get_categories
    function get_blog_categories(){
        $this->db->select();
        $this->db->from('blog_category');
        $this->db->where('user_id', $this->session->userdata('id'));

        if ($this->session->userdata('role') == 'user') {
            $this->db->where('type', 'user');
        }

        if ($this->session->userdata('role') == 'admin') {
            $this->db->where('type', 'admin');
        }
        
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_services_categories(){
        $this->db->select();
        $this->db->from('service_category');
        $this->db->where('user_id', $this->session->userdata('id'));
        
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    function get_all_services_by_user(){
        $this->db->select();
        $this->db->from('services');
        $this->db->where('user_id', $this->session->userdata('id'));
        
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_all_blog_posts(){
        $this->db->select();
        $this->db->from('blog_posts');
        $this->db->where('user_id', $this->session->userdata('id'));

        if ($this->session->userdata('role') == 'user') {
            $this->db->where('type', 'user');
        }

        if ($this->session->userdata('role') == 'admin') {
            $this->db->where('type', 'admin');
        }

        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_user_contact(){
        $this->db->select();
        $this->db->from('contacts');
        $this->db->where('user_id', $this->session->userdata('id'));

        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }  

    //get latest users
    function get_latest_users(){
        //$this->active_langs();
        $this->db->select('u.*, p.status as payment_status,p.package_id, k.name as package');
        $this->db->from('users u');
        $this->db->join('payment p', 'p.user_id = u.id', 'LEFT');
        $this->db->join('package k', 'k.id = p.package_id', 'LEFT');
        $this->db->where('u.status', 1);
        $this->db->where('u.role', 'user');
        $this->db->order_by('u.id','DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // count user
    function get_user_total(){
        $this->db->select();
        $this->db->from('users');
        $this->db->where('role', 'user');
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

    // get all posts
    function get_latest_messages(){
        $this->db->select('c.*');
        $this->db->from('contacts c');
        $this->db->order_by('c.id','DESC');
        $this->db->limit(8);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get tagfs
    function get_tags($post_id)
    {
        $this->db->select();
        $this->db->from('tags');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // delete tags
    function delete_tags($post_id, $table){
        $this->db->delete($table, array('post_id' => $post_id));
        return;
    }


    // get images by user
    function get_total_info(){
        $this->db->select('p.id');
        $this->db->select('(SELECT count(posts.id)
                            FROM posts 
                            WHERE (status = 1)
                            )
                            AS post',TRUE);
        
        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (status = 1)
                            )
                            AS user',TRUE);

        $this->db->from('posts p');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    //get user info
    function get_patient_info($id)
    {
        $this->db->select('p.*');
        $this->db->from('patientses p');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get user info
    function get_user_info()
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        if ($this->session->userdata('role') == 'user') {
            $this->db->where('u.id', $this->session->userdata('id'));
        } else {
            $this->db->where('u.id', $this->session->userdata('parent'));
        }
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get user info
    function get_count_serials()
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');
        $this->db->where('a.user_id', $this->session->userdata('id'));
        $this->db->where('a.chamber_id', $this->chamber->uid);
        $this->db->where('a.status', 0);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

    //get user info
    function get_expire_appointments()
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');
        $this->db->where('a.date <', date('Y-m-d'));
        $this->db->where('a.status', 0);
        if ($this->session->userdata('role') == 'user') {
            $this->db->where('a.user_id', $this->session->userdata('id'));
        } else {
            $this->db->where('a.user_id', $this->session->userdata('parent'));
        }
        $query = $this->db->get();
        $query = $query->result(); 
        return $query;
    }

    //get user info
    function get_appointments()
    {
        $this->db->select('a.*, p.name, p.mobile, p.email, p.mr_number');
        $this->db->from('appointments a');
        $this->db->join('patientses p', 'p.id = a.patient_id', 'LEFT');
        $this->db->where('a.chamber_id', $this->chamber->uid);
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }
        $this->db->order_by('a.date', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    //get user info
    function get_appointments_by_date($date)
    {
        $this->db->select('a.*, p.name, p.mobile, p.mr_number');
        $this->db->from('appointments a');
        $this->db->join('patientses p', 'p.id = a.patient_id', 'LEFT');

        $this->db->where('a.chamber_id', $this->chamber->uid);
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }

        if (!empty($date)) {
            $this->db->where('a.date', $date);
            $this->db->order_by('a.date', 'ASC');
        }
        //$this->db->where('a.status', 0);
        $this->db->order_by('a.serial_id', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  

        foreach ($query as $key => $value) {
            $this->db->select('p.created_at');
            $this->db->from('prescription as p');
            $this->db->where('p.patient_id', $value->patient_id);
            $this->db->where('DATE_FORMAT(p.created_at, "%Y-%m-%d") =', $value->date);
            $query2 = $this->db->get();
            $query2 = $query2->num_rows();
            $query[$key]->is_done = $query2;
        }
        return $query;
    }


    //get_last_serial
    function get_all_appointments()
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');

        $this->db->where('a.chamber_id', $this->chamber->uid);
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }

        //$this->db->where('a.status', 1);
        $this->db->group_by('a.date');
        $query = $this->db->get();
        $query = $query->result();  

        foreach ($query as $key => $value) {
            $this->db->select('p.*');
            $this->db->from('appointments as p');
            $this->db->where('p.date',$value->date);
            $query2 = $this->db->get();
            $query2 = $query2->num_rows();
            $query[$key]->total_patients = $query2;
        } 

        return $query;
    }


    function get_limit_appointments($limit)
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');

        $this->db->where('a.chamber_id', $this->chamber->uid);
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }

        //$this->db->where('a.status', 1);
        $this->db->group_by('a.date');
        $this->db->limit($limit);
        $query = $this->db->get();
        $query = $query->result();  

        foreach ($query as $key => $value) {
            $this->db->select('p.*');
            $this->db->from('appointments as p');
            $this->db->where('p.date',$value->date);
            $query2 = $this->db->get();
            $query2 = $query2->num_rows();
            $query[$key]->total_patients = $query2;
        } 

        return $query;
    }


    //get user info
    function get_patient_appointments($type='')
    {
        $this->db->select('a.*, p.name, p.mobile, p.mr_number, u.name as dr_name, u.currency, s.price, c.name as chamber, c.address as chamber_address');
        $this->db->from('appointments a');
        $this->db->join('patientses p', 'p.id = a.patient_id', 'LEFT');
        $this->db->join('users u', 'u.id = a.user_id', 'LEFT');
        $this->db->join('chamber c', 'c.uid = p.chamber_id', 'LEFT');
        $this->db->join('evisit_settings s', 's.user_id = a.user_id', 'LEFT');
        if ($type == '') {
            $this->db->where('a.patient_id', $this->session->userdata('id'));
        }
        $this->db->where('a.date >=', date('Y-m-d'));
        $this->db->group_by('a.id', 'DESC');
        $this->db->order_by('a.id');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // //get live consults
    // function get_live_consults()
    // {
    //     $this->db->select('a.*, p.name as patient, p.mobile, p.mr_number, u.name as dr_name, c.name as chamber, c.address as chamber_address');
    //     $this->db->from('live_consults a');
    //     $this->db->join('patientses p', 'p.id = a.patient_id', 'LEFT');
    //     $this->db->join('users u', 'u.id = a.user_id', 'LEFT');
    //     $this->db->join('chamber c', 'c.uid = p.chamber_id', 'LEFT');
    //     $this->db->where('a.chamber_id', $this->chamber->id);
    //     $this->db->where('a.date >=', date('Y-m-d'));
    //     $this->db->order_by('a.id', 'DESC');
    //     $query = $this->db->get();
    //     $query = $query->result();  
    //     return $query;
    // }


    // //get live consults
    // function get_patient_live_consults()
    // {
    //     $this->db->select('a.*, p.name as patient, p.mobile, p.mr_number, u.name as dr_name, c.name as chamber, c.address as chamber_address');
    //     $this->db->from('live_consults a');
    //     $this->db->join('patientses p', 'p.id = a.patient_id', 'LEFT');
    //     $this->db->join('users u', 'u.id = a.user_id', 'LEFT');
    //     $this->db->join('chamber c', 'c.uid = p.chamber_id', 'LEFT');
    //     $this->db->where('a.patient_id', $this->session->userdata('id'));
    //     $this->db->order_by('a.id', 'DESC');
    //     $query = $this->db->get();
    //     $query = $query->result();  
    //     return $query;
    // }


    //get user info
    function get_single_appointments($id)
    {
        $this->db->select('a.*, p.name, p.mobile, p.email, p.mr_number, u.name as dr_name, u.currency');
        $this->db->from('appointments a');
        $this->db->join('patientses p', 'p.id = a.patient_id', 'LEFT');
        $this->db->join('users u', 'u.id = a.user_id', 'LEFT');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get_last_serial
    function get_last_serial($date)
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');
        //$this->db->where('a.status', 0);
        $this->db->where('a.date', $date);
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query+1;
    }



    //get_last_serial
    function check_existing_patient($patient_id, $date)
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');
        $this->db->where('a.patient_id', $patient_id);
        $this->db->where('a.date', $date);
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        $query = $query->row();  
        if (empty($query)) {
            return 0;
        }else{
            return 1;
        }
    }



    //count_todays_patient
    function count_todays_patient($date)
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');
        $this->db->where('a.status', 1);
        $this->db->where('a.date', $date);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }


    //get prescription
    function get_prescription_by_id($id)
    {
        $this->db->select('p.*');
        $this->db->from('prescription p');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // select function
    function get_all_ratings()
    {
        $this->db->select('r.*, p.name as patient_name, p.thumb as patient_thumb');
        $this->db->from('ratings r');
        $this->db->join('patientses p', 'p.id = r.patient_id', 'LEFT');
        $this->db->where('r.user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    function get_ratings_info()
    {
        $this->db->select('p.*');
        $this->db->select('(SELECT count(ratings.user_id)
                            FROM ratings 
                            WHERE (user_id = '.$this->session->userdata('id').')
                            )
                            AS total_user',TRUE);

        $this->db->select('(SELECT sum(ratings.rating)
                            FROM ratings
                            WHERE (user_id = '.$this->session->userdata('id').')
                            )
                            AS total_point',TRUE);

        $this->db->from('ratings p');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    function get_total_rating_user($user_id)
    {
        $this->db->select('p.*');
        $this->db->select('count(p.user_id) as total_user');
        $this->db->from('ratings p');
        $this->db->where('p.user_id', $user_id);
        $query = $this->db->get();
        $query = $query->row();
        return $query->total_user;
    }

    function get_total_ratings_by_user($user_id)
    {
        $this->db->select('p.*');
        $this->db->select_sum('p.rating', 'total_rating');
        $this->db->from('ratings p');
        $this->db->where('p.user_id', $user_id);
        $query = $this->db->get();
        $query = $query->row();
        return $query->total_rating;
    }


    function get_single_ratings()
    {
        $this->db->select('p.*');

        $this->db->select('(SELECT count(ratings.id)
                            FROM ratings 
                                WHERE (user_id = '.$this->session->userdata('id').')
                            )
                            AS total_user',TRUE);


        $this->db->select('(SELECT count(ratings.id)
                            FROM ratings 
                                WHERE (user_id = '.$this->session->userdata('id').'
                                AND
                                rating = 5)
                            )
                            AS five',TRUE);

        $this->db->select('(SELECT count(ratings.id)
                            FROM ratings 
                                WHERE (user_id = '.$this->session->userdata('id').'
                                AND
                                rating = 4)
                            )
                            AS four',TRUE);

        $this->db->select('(SELECT count(ratings.id)
                            FROM ratings 
                                WHERE (user_id = '.$this->session->userdata('id').'
                                AND
                                rating = 3)
                            )
                            AS three',TRUE);

        $this->db->select('(SELECT count(ratings.id)
                            FROM ratings 
                                WHERE (user_id = '.$this->session->userdata('id').'
                                AND
                                rating = 2)
                            )
                            AS two',TRUE);

        $this->db->select('(SELECT count(ratings.id)
                            FROM ratings 
                                WHERE (user_id = '.$this->session->userdata('id').'
                                AND
                                rating = 1)
                            )
                            AS one',TRUE);

        $this->db->from('ratings p');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }

    //get prescription
    function get_prescription($id)
    {
        $this->db->select('p.*, u.signature, u.name as user_name, u.degree, u.specialist, u.email, c.name as chamber_name, c.logo, c.title as chamber_title, c.address');
        $this->db->from('prescription p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('chamber c', 'c.uid = p.chamber_id', 'LEFT');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        $query = $query->row_array();  
        return $query;
    }

    function select_by_prescription_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('prescription_id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    function get_user_prescription($id)
    {
        $this->db->select('pi.drug_id,pi.prescription_id,d.name');
        $this->db->from('prescription_items as pi');
        $this->db->join('drugs as d','d.id=pi.drug_id','LEFT');
        $this->db->where('pi.prescription_id', $id);
        $this->db->group_by('d.name');
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $this->db->select('p.*');
            $this->db->from('prescription_items as p');
            $this->db->where('p.prescription_id',$value['prescription_id']);
            $this->db->where('p.drug_id',$value['drug_id']);
            $this->db->group_by('p.id');
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['prescription_items'] = $query2;
        } 
        return $query;
    }


    // get prescriptions
    function get_prescription_by_user($total, $limit, $offset){
        $this->db->select('p.*, t.name, t.mobile, t.mr_number');
        $this->db->from('prescription p');
        $this->db->join('patientses as t','t.id=p.patient_id','LEFT');

        if (isset($_GET) && $_GET['search'] != '') {
            $this->db->like('t.name', $_GET['search']);
            $this->db->or_like('t.mobile', $_GET['search']);
            $this->db->or_like('t.mr_number', $_GET['search']);
        }
        $this->db->where('p.chamber_id', $this->chamber->uid);
        $this->db->where('p.user_id', $this->session->userdata('id'));
        $this->db->order_by('p.id', 'DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 


    // get prescriptions
    function get_prescription_by_patient($total, $limit, $offset){
        $this->db->select('p.*');
        $this->db->from('prescription p');
        $this->db->where('p.patient_id', $this->session->userdata('id'));
        $this->db->order_by('p.id', 'DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 

    // get prescriptions
    function get_patient_history($total, $limit, $offset, $id){
        $this->db->select('p.*');
        $this->db->from('prescription p');
        $this->db->where('p.patient_id', $id);
        $this->db->order_by('p.id', 'DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 



    // get prescriptions
    function get_prescriptions_by_patient($total, $limit, $offset, $id){
        $this->db->select('p.*');
        $this->db->from('prescription p');
        $this->db->where('p.patient_id', $id);
        $this->db->order_by('p.id', 'DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 


    // get prescriptions
    function get_doctors_by_patient($total, $limit, $offset){
        $this->db->select('p.*');
        $this->db->from('prescription p');
        $this->db->where('p.patient_id', $this->session->userdata('id'));
        $this->db->group_by('p.user_id');
        $this->db->order_by('p.id', 'DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 

    // get chamber
    function get_chamber_row($uid)
    {
        if ($this->session->userdata('role') == 'staff') {
            $this->db->where('id', $this->session->userdata('id'));
            $query = $this->db->get('staffs');
            $staff = $query->row();


            $this->db->select('b.*, c.name as category_name');
            $this->db->from('chamber b');
            if ($uid != 0) {
                $this->db->where('b.uid', $uid);
            }else{

                if ($staff->chamber_id != 0) {
                    $this->db->where('b.id', $staff->chamber_id);
                }
                $this->db->where('b.user_id', $this->session->userdata('parent'));
                //$this->db->where('is_primary', 1);
            }
            $this->db->join('chamber_category c', 'c.id = b.category', 'LEFT');
            $this->db->order_by('id', 'ASC');
            $query = $this->db->get();
            $query = $query->row();  
            return $query;

        } else {

            $this->db->select('b.*, c.name as category_name');
            $this->db->from('chamber b');
            if ($uid != 0) {
                $this->db->where('b.uid', $uid);
            }else{
                if ($this->session->userdata('role') == 'user') {
                    $user_id = $this->session->userdata('id');
                } else {
                    $user_id = $this->session->userdata('parent');
                }

                $this->db->where('b.user_id', $user_id);
                $this->db->where('is_primary', 1);
            }
            $this->db->join('chamber_category c', 'c.id = b.category', 'LEFT');
            $this->db->order_by('id', 'ASC');
            $query = $this->db->get();
            $query = $query->row();  
            return $query;
        }


        
    }


    // get chamber
    function get_chamber($uid)
    {
        $this->db->select('b.*, c.name as category_name');
        $this->db->from('chamber b');
        if ($uid != 0) {
            $this->db->where('b.uid', $uid);
        }

        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }
        $this->db->where('b.user_id', $user_id);
        $this->db->join('chamber_category c', 'c.id = b.category', 'LEFT');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get chamber
    function get_single_chamber($id)
    {
        $this->db->select('b.*, c.name as category_name');
        $this->db->from('chamber b');
        $this->db->where('b.id', $id);
        $this->db->join('chamber_category c', 'c.id = b.category', 'LEFT');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get chamber
    function get_single_chamber_md5($id)
    {
        $this->db->select('b.*, c.name as category_name');
        $this->db->from('chamber b');
        $this->db->where('md5(b.id)', $id);
        $this->db->join('chamber_category c', 'c.id = b.category', 'LEFT');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get chamber
    function get_primary_chamber()
    {
        $this->db->select('b.*');
        $this->db->from('chamber b');
        $this->db->where('b.is_primary', 1);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get my chambers
    function get_my_all_chambers()
    {
        $this->db->select('b.*');
        $this->db->from('chamber b');
        $this->db->where('b.user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get my chambers
    function get_user_chambers($user_id)
    {
        $this->db->select('b.*');
        $this->db->from('chamber b');
        $this->db->where('b.user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get my chambers
    function get_staff_chambers($user_id, $chamber_id)
    {
        $this->db->select('b.*');
        $this->db->from('chamber b');
        if ($chamber_id != 0) {
            $this->db->where('b.id', $chamber_id);
        }
        $this->db->where('b.user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }



    function get_admin_package_features()
    {
        $this->db->select('p.*');
        $this->db->from('package p');
        $this->db->order_by('p.id', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        foreach ($query as $key => $value) {
            $this->db->select('a.*, f.name as feature_name');
            $this->db->from('feature_assaign a');
            $this->db->join('features f', 'f.id = a.feature_id', 'LEFT');
            $this->db->where('package_id',$value->id);
            $query2 = $this->db->get();
            $query2 = $query2->result();
            $query[$key]->features = $query2;
        }
        return $query;
    }


    function get_package_features()
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        foreach ($query as $key => $value) {
            $this->db->select('a.*, f.name as feature_name');
            $this->db->from('feature_assaign a');
            $this->db->join('features f', 'f.id = a.feature_id', 'LEFT');
            $this->db->where('package_id',$value->id);
            $query2 = $this->db->get();
            $query2 = $query2->result();
            $query[$key]->features = $query2;
        }
        return $query;
    }
    

    function get_assign_package_features($package_id)
    {
        $this->db->select('*');
        $this->db->from('feature_assaign');
        $this->db->where('package_id', $package_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $query = $query->result(); 
        return $query;
    }

    function check_assign_feature($feature_id, $package_id)
    {
        $this->db->select('*');
        $this->db->from('feature_assaign');
        $this->db->where('feature_id', $feature_id);
        $this->db->where('package_id', $package_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function get_total_user_by_package($package_id)
    {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('package_id', $package_id);
        $this->db->group_by('user_id');
        $query = $this->db->get();
        $query = $query->num_rows(); 
        return $query;
    }


    // get_payment
    function get_my_payment()
    {
        if ($this->session->userdata('role') == 'user') {
            $user_id = $this->session->userdata('id');
        } else {
            $user_id = $this->session->userdata('parent');
        }
        
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->row();

        return $query;
    }


    // get_payment
    function get_user_payment_details($puid)
    {
        $this->db->select('p.*, k.name as package_name, k.slug, u.name as user_name, u.phone, u.address, u.email');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package_id', 'LEFT');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->where('p.puid', $puid);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get_payment
    function get_users_payment_lists($user_id)
    {
        $this->db->select('p.*, k.name as package_name, k.slug, u.name as user_name, u.phone, u.address, u.email');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package_id', 'LEFT');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->where('p.user_id', $user_id);
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // get_payment
    function get_payment_lists()
    {
        $this->db->select('p.*, k.name as package_name, k.slug, u.name as user_name, u.phone, u.address, u.email, u.thumb');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package_id', 'LEFT');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->where('p.amount != ', '0.00');
        $this->db->where('p.status != ', 'expired');
        $this->db->order_by('p.id', 'DESC');
        //$this->db->group_by('p.user_id');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // get_payment
    function get_total_value($table, $date)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') >=", $date);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }


    // get_payment
    function check_appointment_payment($appointment_id, $user_id)
    {
        $this->db->select('*');
        $this->db->from('payment_user');
        $this->db->where('user_id', $user_id);
        $this->db->where('appointment_id', $appointment_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    // get_payment
    function get_user_payment($user_id)
    {
        $this->db->select('p.*, k.name as package');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package_id', 'LEFT');
        $this->db->where('p.user_id', $user_id);
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    public function active_features($package_id){
        $this->db->select('f.*, s.name, s.slug');
        $this->db->from('feature_assaign f');
        $this->db->join('features s', 's.id = f.feature_id', 'LEFT');
        $this->db->where('f.package_id', $package_id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // edit function
    function update_payment($action, $user_id, $table){
        $this->db->where('user_id', $user_id);
        $this->db->update($table,$action);
        return;
    }



    // get_payment
    function get_payment($payment_id)
    {
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('puid', $payment_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get_payment
    function get_package_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('package');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get all users
    function get_all_users($total, $limit, $offset, $type){
        $this->db->select('u.*, p.status as payment_status,p.package_id, k.name as package');
        $this->db->from('users u');
        $this->db->join('payment p', 'p.user_id = u.id', 'LEFT');
        $this->db->join('package k', 'k.id = p.package_id', 'LEFT');
        
        if (isset($_GET['sort']) && $_GET['sort'] != 'all') {
            $this->db->where('p.status', $_GET['sort']);
        }

        if (isset($_GET['package']) && $_GET['package'] != 'all') {
            $this->db->where('p.package_id', $_GET['package']);
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('u.name', $_GET['search']);
        }

        $this->db->where('u.role', 'user');
        $this->db->order_by('u.id','DESC');
        $this->db->group_by('u.id');
        $this->db->query('SET SQL_BIG_SELECTS=1');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {

            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();

            foreach ($query as $key => $value) {
                $this->db->select();
                $this->db->from('payment');
                $this->db->where('user_id', $value->id);
                $this->db->order_by('id','DESC');
                $this->db->limit(1);
                $query2 = $this->db->get();
                $query2 = $query2->row();
                $query[$key]->payment = $query2;
            }

            foreach ($query as $key => $value) {
                $this->db->select('chamber.name');
                $this->db->from('chamber');
                $this->db->where('user_id', $value->id);
                $query2 = $this->db->get();
                $query2 = $query2->result();
                $query[$key]->chambers = $query2;
            }
            return $query;
        }
    }


    // start domain query


    function get_domains($user_id)
    {
        $this->db->select();
        $this->db->from('domains');
        if($user_id  !=0){
            $this->db->where('user_id',$user_id);
        }
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_domain_settings()
    {
        $this->db->select();
        $this->db->from('domain_settings');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    
    function get_user_domain($user_id)
    {
        $this->db->select();
        $this->db->from('domains');
        $this->db->where('status',1);
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }
    // end domain query


    // start payouts query

    function select_by_user_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_payout_users()
    {
        $this->db->select('p.*, u.name as user_name, u.balance');
        $this->db->from('payment_user as p');
        $this->db->join('users as u', 'u.id = p.user_id', 'LEFT');
        $this->db->where('p.type', 'wallet');
        $this->db->group_by('p.user_id');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_payouts($status, $user_id, $total, $limit, $offset){

        $this->db->select('p.*, u.name as user_name, u.thumb, u.balance');
        $this->db->from('payouts as p');
        $this->db->join('users as u', 'u.id = p.user_id', 'LEFT');
        if ($user_id != 0) {
            $this->db->where('p.user_id', $user_id);
        }
        if ($status != 2) {
            $this->db->where('p.status', $status);
        }
        if (isset($_GET['transaction_id'])) {
            $this->db->like('p.transaction_id', $_GET['transaction_id']);
        }
        $this->db->order_by('p.id', 'DESC');
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }

    function get_user_earnings($user_id)
    {
        $this->db->select('p.*');
        $this->db->select_sum('p.total_amount', 'net_income');
        $this->db->from('payment_user as p');
        $this->db->where('p.type', 'wallet');
        $this->db->where('p.user_id', $user_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_by_md5_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_by_md5($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }












    // Referral model

    function get_referral_settings()
    {
        $this->db->select();
        $this->db->from('referral_settings');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_single_user($id)
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_by_referral_id($id)
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('referral_id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    function get_referrals($id)
    {
        $this->db->select();
        $this->db->from('referrals');
        $this->db->where('referrar_id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    function get_by_referral_user($id)
    {
        $this->db->select();
        $this->db->from('referrals');
        $this->db->where('user_id', $id);
        $this->db->where('status', 0);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    function get_referral_payouts($id)
    {
        $this->db->select();
        $this->db->from('referral_payouts');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_payouts_all()
    {
        $this->db->select();
        $this->db->from('referral_payouts');
        if (isset($_GET['transaction_id'])) {
            $this->db->like('transaction_id', $_GET['transaction_id']);
        }
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }



    function get_payouts_by_status()
    {
        $this->db->select();
        $this->db->from('referral_payouts');
        $this->db->where('status', 1);
        if (isset($_GET['transaction_id'])) {
            $this->db->like('transaction_id', $_GET['transaction_id']);
        }
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    function get_withdraw_balance_by_user($id)
    {
        $this->db->select_sum('amount');
        $this->db->from('referral_payouts');
        $this->db->where('user_id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_total_earn_by_user($id)
    {
        $this->db->select_sum('commision_amount');
        $this->db->from('referrals');
        $this->db->where('referrar_id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }















    // image upload function with resize option
    function upload_image($max_size){
            
            // set upload path
            $config['upload_path']  = "./uploads/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                // set upload path
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 150;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                // set upload path
                $images = 'uploads/medium/'.$mid;
                $thumb  = 'uploads/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }


    //multiple image upload with resize option
    public function do_upload($photo) {                   
        $config['upload_path']  = "./uploads/";
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['max_size']     = '20000';
        $config['max_width']    = '20000';
        $config['max_height']   = '20000';
 
        $this->load->library('upload', $config);                
        
            if ($this->upload->do_upload($photo)) {
                $data       = $this->upload->data(); 
                /* PATH */
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $destination_big    = "./uploads/big/" ;

                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_big   = 2000 ;
                $limit_medium    = 1000 ;
                $limit_thumb    = 200 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_big || $limit_use > $limit_thumb || $limit_use > $limit_medium) {
                    $percent_big = $limit_big/$limit_use ;
                    $percent_medium  = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;                 

                //// Making MEDIUM ///////
                $img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $medium = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;               

                ////// Making BIG /////////////
                $img['width']   = $limit_use > $limit_big ?  $data['image_width'] * $percent_big : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_big ?  $data['image_height'] * $percent_big : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_big-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_big ;

                $album_picture = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                $data_image = array(
                    'thumb' => 'uploads/thumbnail/'.$thumb_nail,
                    'medium' => 'uploads/medium/'.$medium,
                    'big' => 'uploads/big/'.$album_picture
                );

                unlink($source) ;   
                return $data_image;   
    
            }
            else {
                return FALSE ;
            }
       
    }



    // language start

    function get_all_language()
    {
        $this->db->select();
        $this->db->from('language');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get language
    function get_language()
    {
        $this->db->select();
        $this->db->from('language');
        $this->db->where('status', 1);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get language
    function get_language_values()
    {
        $this->db->select();
        $this->db->from('lang_values');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get language value pagination
    function get_lang_values($total, $limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('lang_values');
        $this->db->order_by('id','DESC');
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    // get language value pagination
    function get_lang_values_by_type($type)
    {
        $this->db->select('*');
        $this->db->from('lang_values');
        $this->db->where('type', $type);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //check unique language keyword
    public function check_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('lang_values');
        $this->db->where('keyword', $keyword); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return 1;
        }else{
            return 0;
        }
    }

    //check unique language name
    public function check_language($name)
    {
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where('name', $name); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return 1;
        }else{
            return 0;
        }
    }

    

}