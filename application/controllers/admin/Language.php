<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin() && !is_user()) {
            redirect(base_url());
        }
        $this->load->dbforge();
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Language';   
        $data['language'] = FALSE;
        $data['languages'] = $this->admin_model->get_all_language();
        $data['main_content'] = $this->load->view('admin/language/language',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    // add language
    public function add()
    {   
        if($_POST)
        {   
            
            check_status();

            $id = $this->input->post('id', true);
            if ($id == '') {
                $is_unique = '|is_unique[language.name]';
            }else{
                $is_unique = '';
            }

            //validate and check duplicates
            $this->form_validation->set_rules('name', trans('name'), 'required'.$is_unique);

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/language'));
            } else {
               
                $data=array(
                    'name' => $this->input->post('name', true),
                    'slug' => str_slug($this->input->post('name', true)),
                    'short_name' => $this->input->post('short_name', true),
                    'text_direction' => $this->input->post('text_direction', true),
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);

                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'language');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 

                    $lang = str_slug($_POST['lang_name']);
                    
                    //update language folder name
                    if (is_dir(APPPATH.'language/'.$lang)) {
                        rename(APPPATH.'language/'.$lang, APPPATH.'language/'.str_slug($this->input->post('name', true)));
                    }

                    //update database column
                    $fields = array(
                        $lang => array(
                            'name' => str_slug($this->input->post('name', true)),
                            'type' => 'TEXT',
                            'constraint' => '255'
                        ),
                    );
                    $this->dbforge->modify_column('lang_values', $fields);

                } else {
                    $this->admin_model->insert($data, 'language');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                
                    // insert new column in language table
                    $fields = array(
                        str_slug($_POST['name']) => array('type' => 'TEXT', 'after' => 'english')
                    );
                    $this->dbforge->add_column('lang_values', $fields);

                    // create language folder & file
                    $dir = str_slug($_POST['name']);
                    if (!is_dir(APPPATH.'language/'.$dir)) {
                        mkdir(APPPATH.'./language/' . $dir, 0777, TRUE);
                        copy(APPPATH.'language/english/website_lang.php', APPPATH.'language/'.$dir.'/website_lang.php');
                    }
                }

                redirect(base_url('admin/language'));

            }
            
        }     
    }


    //add language values
    public function add_value()
    {   
        check_status();

        if($_POST){

            $check = $this->admin_model->check_keyword(str_slug($this->input->post('keyword', true)));
            //print_r($check) ; exit();
            if ($check == 1) {
                //$this->session->set_flashdata('error', trans('keyword-exists'));
                $this->session->set_flashdata('error', 'keyword-exists');
                redirect($_SERVER['HTTP_REFERER']);
            } else {

                $data=array(
                    'label' => $this->input->post('label', true),
                    'keyword' => character_limiter(str_slug($this->input->post('keyword', true)), 2),
                    'english' => $this->input->post('label', true),
                    'type' => $this->input->post('type', true)
                );
                $data = $this->security->xss_clean($data);
                $this->admin_model->insert($data, 'lang_values');
                $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                redirect(base_url('admin/language/values/'.$this->input->post('type').'/'.$this->input->post('lang')));
            }
        }
    }


    public function test(){

        // $values = $this->admin_model->select_asc('lang_values');
        // foreach ($values as $value) {
        //     echo  "'".$value->id."' => '".$value->english."',<br>";
        // }
        // exit();

        $variable = array(
           '655' => 'ଅନୁରୋଧ',
'656' => 'ସକ୍ରିୟ ପେଆଉଟ୍ ମଡ୍ୟୁଲ୍ ସକ୍ଷମ କର ଏବଂ ଆଡମିନି ଆକାଉଣ୍ଟକୁ ରୋଗୀ ନିଯୁକ୍ତି ଦେୟ ଗ୍ରହଣ କର |',
'657' => 'ଦେୟ ସକ୍ଷମ କର',
'658' => 'ଦେୟ ସେଟିଂସମୂହ',
'659' => 'ଆୟୋଗ ହାର',
'660' => 'ନିଶ୍ଚିତ ଭାବରେ 1-99 ମଧ୍ୟରେ ହେବ',
'661' => 'ସର୍ବନିମ୍ନ ଦେୟ ପରିମାଣ',
'662' => 'ଦେୟ ପଦ୍ଧତି ସକ୍ଷମ / ଅକ୍ଷମ କରନ୍ତୁ',
'663' => 'ପେପାଲ୍',
'664' => 'IBAN',
'665' => 'ସ୍ୱିଫ୍ଟ',
'666' => 'ଦେୟ',
'667' => 'ପେଆଉଟ୍ ଯୋଡନ୍ତୁ',
'668' => 'ପରିମାଣ',
'669' => 'ପ୍ରତ୍ୟାହାର ପଦ୍ଧତି',
'670' => 'ଅବ val ଧ ପ୍ରତ୍ୟାହାର ପରିମାଣ',
'671' => 'ଖାଲି ପେପାଲ୍ ଇମେଲ୍',
'672' => 'ଖାଲି IBANemail',
'673' => 'ଖାଲି IBAN ସୂଚନା',
'674' => 'ଖାଲି ଦ୍ରୁତ ଇମେଲ୍',
'675' => 'ଦେୟ ଅନୁରୋଧ ପଠାନ୍ତୁ',
'676' => 'ପେଆଉଟ୍ ଆକାଉଣ୍ଟ୍ ସେଟ୍ କରନ୍ତୁ',
'677' => 'ପୂର୍ଣ୍ଣ ନାମ',
'678' => 'ବ୍ୟାଙ୍କ ନାମ',
'679' => 'IBAN ସଂଖ୍ୟା',
'680' => 'ରାଜ୍ୟ',
'681' => 'ପୋଷ୍ଟ କୋଡ୍',
'682' => 'ବ୍ୟାଙ୍କ ଆକାଉଣ୍ଟଧାରୀଙ୍କ ନାମ',
'683' => 'ବ୍ୟାଙ୍କ ଶାଖା ଦେଶ',
'684' => 'ବ୍ୟାଙ୍କ ଶାଖା ସହର',
'685' => 'ବ୍ୟାଙ୍କ ଆକାଉଣ୍ଟ ନମ୍ବର',
'686' => 'ସ୍ୱିଫ୍ଟ କୋଡ୍',
'687' => 'ସେଟଅପ୍ ପେଆଉଟ୍ ଆକାଉଣ୍ଟ୍',
'688' => 'ମୋଟ ରୋଜଗାର',
'689' => 'କମିଶନ ପରେ',
'690' => 'ସମୁଦାୟ ପ୍ରତ୍ୟାହାର',
'691' => 'ସନ୍ତୁଳନ',
'692' => 'ଦେୟ ପଦ୍ଧତି',
'693' => 'କାରବାର Id',
'694' => 'ପଠାଯାଇଥିବା ଅନୁରୋଧ',
'695' => 'ସମାପ୍ତ',
'696' => 'ପରିମାଣ ପ୍ରତ୍ୟାହାର',
'697' => 'ରେଫରାଲ୍ ସକ୍ଷମ କର',
'698' => 'ରେଫରାଲ୍ ନୀତି',
'699' => 'ରେଫରାଲ୍ ପଲିସି ବାଛ',
'700' => 'କେବଳ ପ୍ରଥମ କ୍ରୟ ଉପରେ ଆୟୋଗ',
'701' => 'ପ୍ରତ୍ୟେକ କ୍ରୟ ଉପରେ ଆୟୋଗ',
'702' => 'କମିଶନ ହାର',
'703' => 'ସର୍ବନିମ୍ନ ଦେୟ',
'704' => 'ରେଫେରାଲ୍ ଗାଇଡ୍ଲାଇନ୍ସ',
'705' => 'ଦେୟ ଅନୁରୋଧ',
'706' => 'ସମୁଦାୟ ରେଫରାଲ୍',
'707' => 'କମିଶନ',
'708' => 'ସର୍ବନିମ୍ନ ଦେୟ ପରିମାଣ',
'709' => 'ମୋର ରେଫରାଲ୍ url',
'710' => 'ଏହା କିପରି କାମ କରେ',
'711' => 'ରେଫର୍ ହୋଇଥିବା ବ୍ୟକ୍ତିଙ୍କ ଦ୍ୱାରା ପ୍ରଥମ ସଫଳ ଦେୟ',
'712' => 'ରେଫର୍ ହୋଇଥିବା ବ୍ୟକ୍ତିଙ୍କ ଦ୍ୱାରା ପ୍ରତ୍ୟେକ ସଫଳ ଦେୟ',
'713' => 'ରେଫରାଲ୍ ଗାଇଡ୍ଲାଇନ୍ସ',
'714' => 'ନିମନ୍ତ୍ରଣ ପଠାନ୍ତୁ',
'715' => 'ଆପଣଙ୍କର ସାଙ୍ଗମାନଙ୍କୁ ଆପଣଙ୍କର ରେଫରାଲ୍ ଲିଙ୍କ୍ ପଠାନ୍ତୁ ଏବଂ ସେମାନଙ୍କୁ କୁହନ୍ତୁ ଏହା କେତେ ସୁନ୍ଦର',
'716' => 'ପଞ୍ଜୀକରଣ',
'717' => 'ସେମାନଙ୍କୁ ତୁମର ରେଫରାଲ୍ ଲିଙ୍କ୍ ବ୍ୟବହାର କରି ଇଜିଷ୍ଟର୍ କରିବାକୁ ଦିଅ',
'718' => 'କମିଶନ ପାଆନ୍ତୁ',
'719' => 'ସେମାନଙ୍କର ପ୍ରଥମ ସଦସ୍ୟତା ଯୋଜନା ଦେୟ ପାଇଁ ଆୟ ଆୟ କର',
'720' => 'ରେଫରାଲ୍',
'721' => 'ଅନୁବନ୍ଧିତ',
'722' => 'ରେଫରାଲ୍ ସେଟିଂସମୂହ',
'723' => 'ଫିଲ୍ଟର୍',
'724' => 'ପ୍ରତ୍ୟାହାର ପରିମାଣ',
'725' => 'ମୋର ରେଫରାଲ୍',
'726' => 'ରେଫରର୍ ଆଇଡି',
'727' => 'ଅର୍ଡର Id',
'728' => 'କମିଶନ ପରିମାଣ',
'729' => 'ଦେୟ ଅନୁରୋଧ',
'730' => 'ଅନୁବନ୍ଧିତ ସେଟିଂସମୂହ',
'731' => 'ବିବରଣୀ ଦେଖନ୍ତୁ',
'732' => 'DNS ସେଟିଂସମୂହ',
'733' => 'ପ୍ରତିଛବି',
'734' => 'ପ୍ରକାର',
'735' => 'ହୋଷ୍ଟ',
'736' => 'TTL',
'737' => 'ଆପଣଙ୍କର ସର୍ଭର IP ଠିକଣା',
'738' => 'ଏହି ip ଠିକଣା ବ୍ୟବହାରକାରୀଙ୍କୁ କଷ୍ଟମ୍ ଡୋମେନ୍> DNS ସେଟିଂସମୂହ ସେଟଅପ୍ ପାଇଁ ବ୍ୟବହୃତ ହେବ',
'739' => 'ଅନଲାଇନ୍ ମିଟିଂ',
'740' => 'ଏକ ନିଯୁକ୍ତି ପରେ ଆପଣଙ୍କ ଗ୍ରାହକଙ୍କୁ ବୁକିଂ ବିଜ୍ଞପ୍ତି ପଠାଇବାକୁ ସକ୍ଷମ କରନ୍ତୁ।',
'741' => 'Twilio Sms ସେଟିଂସମୂହ',
'742' => 'ଖାତା SID',
'743' => 'Twilio Auth Token',
'744' => 'ପ୍ରେରକ ସଂଖ୍ୟା (ଟ୍ୱିଲିଓ)',
'745' => 'ବୁକିଂ ନିଶ୍ଚିତକରଣ SMS ସକ୍ଷମ କର',
'746' => 'ସର୍ବଭାରତୀୟ ସ୍ତରରେ ସକ୍ଷମ',
'747' => 'ସର୍ବଭାରତୀୟ ସ୍ତରରେ ଟ୍ୱିଲିଓ ସକ୍ଷମ କର',
'748' => 'ଇନଷ୍ଟାନ୍ସ ଆଇଡି',
'749' => 'ଟୋକେନ୍',
'750' => 'ହ୍ ats ାଟସ୍ ଆପ୍',
'751' => 'ହ୍ ats ାଟସ୍ ଆପ୍ ସେଟିଂସମୂହ',
'752' => 'Ultramsg API',
'753' => 'ବୁକିଂ ନିଶ୍ଚିତ ହୋଇଛି',
'754' => 'ବୁକ୍ ହୋଇଥିବା ନିଯୁକ୍ତି ପାଇଁ ବ Meeting ଠକ',
'755' => 'ରେ ଯୋଗ କରାଯାଇଛି',
'756' => 'ଆପଣ ନିମ୍ନଲିଖିତ ଲିଙ୍କ ବ୍ୟବହାର କରି ସଭାରେ ଯୋଗ ଦେଇପାରିବେ',
'757' => 'SMS ଯାଞ୍ଚ',
'758' => 'ପଞ୍ଜୀକୃତ ଉପଭୋକ୍ତାମାନଙ୍କ ପାଇଁ smsverification କୁ ଅନୁମତି ଦେବାକୁ ସକ୍ଷମ କର।',
'759' => 'ଟିପ୍ପଣୀ: ଯଦି ଆପଣ sms ଯାଞ୍ଚକୁ ସକ୍ଷମ କରିବାକୁ ଚାହୁଁଛନ୍ତି ଦୟାକରି ନିଶ୍ଚିତ କରନ୍ତୁ ଯେ ଆପଣ ଇମେଲ ଯାଞ୍ଚକୁ ଅକ୍ଷମ କରିଛନ୍ତି।',
'760' => 'ଆମେ ଆପଣଙ୍କ ଫୋନରେ ଏକ ଯାଞ୍ଚ କୋଡ୍ ପଠାଇଛୁ।',
'761' => 'ଭୂମିକା ଅନୁମତି',
'762' => 'ବହୁଳ ଆମଦାନୀ ଡ୍ରଗ୍',
'763' => 'ବାତିଲ୍',
'764' => 'ବାତିଲ୍',
'765' => 'ବିଷୟରେ',
'766' => 'ଆମ ବିଷୟରେ',
'767' => 'SEO ସେଟିଂସମୂହ',
'768' => 'ଫେସବୁକ୍',
'769' => 'ଟ୍ୱିଟର',
'770' => 'ଲିଙ୍କ୍ ହୋଇଛି',
'771' => 'ଇନଷ୍ଟାଗ୍ରାମ',
'772' => 'ମେଟା ଟ୍ୟାଗ୍',
'773' => 'କଷ୍ଟମ୍ JS',
        );
        

        foreach ($variable as $key => $value) {
            
            $vdata=array(
                'odia' => $value
            );
            $this->admin_model->update($vdata, $key, 'lang_values');

        }
        echo "done";
        exit();

    }


    //show language values
    public function values($type, $slug)
    {   
        $data = array();  
        $data['page_title'] = 'language';  
        $data['value'] = $slug;  
        $data['type'] = $type;  
        $data['language'] = $this->admin_model->get_lang_values_by_type($type);
        $data['main_content'] = $this->load->view('admin/language/language_values',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    //update language values
    public function update_values($type)
    {   
        check_status();

        $data = array();
        $language = $this->input->post('lang_type');
        $languages = $this->admin_model->get_lang_values_by_type($type);
        

        ini_set('memory_limit', '-1');
        set_time_limit ( -1);

        foreach ($languages as $lang) {
            $value = 'value'.$lang->id;

            $data=array(
                $_POST['lang_type'] => $_POST[$value]
            );
            $this->admin_model->edit_option($data, $lang->id, 'lang_values');
        }
        $this->session->set_flashdata('msg', trans('msg-updated')); 
        redirect(base_url('admin/language/values/'.$type.'/'.$language));

    }


    //edit language values
    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['language'] = $this->admin_model->select_option($id, 'language');
        $data['main_content'] = $this->load->view('admin/language/language',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    //active language    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'language');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/language'));
    }


    //deactive language
    public function deactive($id) 
    {
        check_status();
        
        $language = $this->admin_model->get_by_id($id,'language');

        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        if ($language->name != 'english') {
            $this->admin_model->update($data, $id,'language');
            $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        }
        redirect(base_url('admin/language'));
    }


    //delete language
    public function delete($id)
    {
        check_status();

        $language = $this->admin_model->get_by_id($id,'language');
     
        $lang = $language->slug;
        if ($lang != 'english') {

            //delete language folder & file
            if (is_dir(APPPATH.'language/'.$lang)) {
                unlink(APPPATH.'language/'.$lang.'/website_lang.php');
                rmdir(APPPATH.'language/'.$lang);
            }

            //delete database column 
            $this->dbforge->drop_column('lang_values', $lang);
            $this->admin_model->delete($id,'language'); 
        }
        echo json_encode(array('st' => 1));
    }

}
    

