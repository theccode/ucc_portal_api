<?php
namespace Api\Controllers;
class Login{
    private $auth;

    public function __construct($auth){
        $this->auth = $auth;
    }

    public function login(){
        $error = false;
        if ($this->auth->login($_POST['reg_no'], $_POST['password'])){
            $result_user_credentials = $this->getUserCredentials();
            $result_user_details = $this->getUserDetails();
            $response['studid'] = $result_user_details[0]['studid'];
            $response['fname'] = $result_user_details[0]['fname'];
            $response['mname'] = $result_user_details[0]['mname'];
            $response['lname'] = $result_user_details[0]['lname'];
            $response['verified'] = $result_user_details[0]['verified'];
            $response['verification_date'] = $result_user_details[0]['verification_date'];
            $response['title'] = $result_user_details[0]['title'];
            $response['sex'] = $result_user_details[0]['sex'];
            $response['marital_status'] = $result_user_details[0]['marital_status'];
            $response['workplace_id'] = $result_user_details[0]['workplace_id'];
            $response['dob'] = $result_user_details[0]['dob'];
            $response['doa'] = $result_user_details[0]['doa'];
            $response['doc'] = $result_user_details[0]['doc'];
            $response['progid'] = $result_user_details[0]['progid'];
            $response['majorid'] = $result_user_details[0]['majorid'];
            $response['level'] = $result_user_details[0]['level'];
            $response['entrylevel'] = $result_user_details[0]['entrylevel'];
            $response['entry_modeid'] = $result_user_details[0]['entry_modeid'];
            $response['hallid'] = $result_user_details[0]['hallid'];
            $response['centreid'] = $result_user_details[0]['centreid'];
            $response['resident_status'] = $result_user_details[0]['resident_status'];
            $response['room_no'] = $result_user_details[0]['room_no'];
            $response['non_res_add'] = $result_user_details[0]['non_res_add'];
            $response['gps_address'] = $result_user_details[0]['gps_address'];
            $response['ssnit'] = $result_user_details[0]['ssnit'];
            $response['pob_town'] = $result_user_details[0]['pob_town'];
            $response['pob_region'] = $result_user_details[0]['pob_region'];
            $response['nationality'] = $result_user_details[0]['nationality'];
            $response['nationalityid']  = $result_user_details[0]['nationalityid'];
            $response['hometown'] = $result_user_details[0]['hometown'];
            $response['post_box'] = $result_user_details[0]['post_box'];
            $response['post_town'] = $result_user_details[0]['post_town'];
            $response['homeadd'] = $result_user_details[0]['homeadd'];
            $response['homephone'] = $result_user_details[0]['homephone'];
            $response['cellphone'] = $result_user_details[0]['cellphone'];
            $response['email'] = $result_user_details[0]['email'];
            $response['previous_name'] = $result_user_details[0]['previous_name'];
            $response['status'] = $result_user_details[0]['status'];
            $response['studyleave'] = $result_user_details[0]['studyleave'];
            $response['schoolid'] = $result_user_details[0]['schoolid'];
            $response['applicant_id'] = $result_user_details[0]['applicant_id'];
            $response['paytype'] = $result_user_details[0]['paytype'];
            $response['taking_ssnit'] = $result_user_details[0]['taking_ssnit'];
            $response['loan_take_times'] = $result_user_details[0]['loan_take_times'];
            $response['bank_branch_id'] = $result_user_details[0]['bank_branchid'];
            $response['bank_account'] = $result_user_details[0]['bank_account'];
            $response['completed'] = $result_user_details[0]['completed'];
            $response['graduate'] = $result_user_details[0]['graduate'];
            $response['withdrawn'] = $result_user_details[0]['withdrawn'];
            $response['biometric_enrolment'] = $result_user_details[0]['biometric_enrolment'];
            $response['biometric_enrolment_date'] = $result_user_details[0]['biometric_enrolment_date'];
            $response['card_print'] = $result_user_details[0]['card_print'];
            $response['cgpa'] = $result_user_details[0]['cgpa'];
            $response['cgpa_raw'] = $result_user_details[0]['cgpa_raw'];
            $response['cert_no'] = $result_user_details[0]['cert_no'];
            $response['idcardstatus'] = $result_user_details[0]['idcardstatus'];
            $response['disabilityid'] = $result_user_details[0]['disabilityid'];
            $response['ref_no'] = $result_user_details[0]['ref_no'];
            $response['admission_no'] = $result_user_details[0]['admission_no'];
            $response['teachers_regno'] = $result_user_details[0]['teachers_regno'];
            $response['alt_email'] = $result_user_details[0]['alt_email'];
            $response['inst_email'] = $result_user_details[0]['inst_email'];
            $response['created_at'] = $result_user_details[0]['created_at'];
            $response['updated_at'] = $result_user_details[0]['updated_at'];
            // User credentials
            $response['regno'] = $result_user_credentials[0]['regno'];
            $response['password'] = $result_user_credentials[0]['password'];
            $response['access_level'] = $result_user_credentials[0]['accesslevel'];
            $response['status'] = $result_user_credentials[0]['status'];
            $response['security'] = $result_user_credentials[0]['security'];
            $response['hex_code'] = $result_user_credentials[0]['hexcode'];
            $response['created_at']= $result_user_details[0]['created_at'];
            $response['sent']= $result_user_credentials[0]['sent'];

            return [
                'variables' => [
                    'error' => $error,
                    'title' => 'Login',
                    'user' => $response
                ]
            ];
        } else {
            $error = true;
            $response['user'] = 'Invalid Registration Number/password.';
            return [
                'variables' => [
                    'error' => $error,
                    'title' => 'Login Error',
                    'error_msg' => $response
                ]
            ];
        }
    }
    private function getUserCredentials(){
        return $this->auth->getAuthUserCredentials();
    }
    private function getUserDetails(){
        return $this->auth->getAuthUserDetails();
    }
}