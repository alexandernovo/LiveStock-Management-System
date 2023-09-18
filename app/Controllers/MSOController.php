<?php

namespace App\Controllers;

use Twilio\Rest\Client;

class MSOController extends BaseController
{
    public function __construct()
    {
        if (!session()->get('MSO_username')) {
            echo 'Access Denied';
            exit;
        }
        helper(['form', 'url']);
    }
    public function index()
    {
        $data = [
            'this_week_count'       => $this->querymodel->mso_this_week_count($this->session->get('MSO_id')),
            'this_week_schedule'    => $this->querymodel->mso_this_week($this->session->get('MSO_id')),
            'next_week'             => $this->querymodel->mso_next_week($this->session->get('MSO_id')),
            'mso_today_sched'       => $this->querymodel->mso_today_sched($this->session->get('MSO_id')),
            'today_count'           => $this->querymodel->mso_today_count($this->session->get('MSO_id')),
            'next_week_count'       => $this->querymodel->mso_next_week_count($this->session->get('MSO_id')),
            'all_sched_count'       => $this->querymodel->mso_all_schedules_count($this->session->get('MSO_id')),
        ];
        return view('msoview/mso-home', $data);
    }
    public function msoprofile()
    {
        $data['viewprofile'] = $this->msomodel->where('MSO_id', $this->session->get('MSO_id'))->findAll();
        return view('msoview/mso-profile', $data);
    }
    public function changename()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-name-mso'])) {
            $rules = [
                'firstname'         => 'required|min_length[4]',
                'lastname'          => 'required|min_length[4]',
            ];
            $errors = [
                'firstname' => [
                    'required'      => 'This field is required',
                    'min_length'    => 'Firstname is too short'
                ],
                'lastname' => [
                    'required'      => 'This field is required',
                    'min_length'    => 'Lastname is too short'
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'MSO_id' => $this->session->get('MSO_id'),
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                ];
                $check = $this->msomodel->save($data);
                if ($check) {
                    session()->set($data);
                    $this->session->setFlashdata('success', 'Name Updated Successfully');
                    return redirect()->to(base_url('ManageProfileMSO'));
                } else {
                    $this->session->setFlashdata('failed', 'Name Update Failed');
                    return redirect()->to(base_url('MSOUpdatename'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('msoview/mso-changename', $data);
            }
        }
        return view('msoview/mso-changename', $data);
    }

    public function changeusername()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-username-mso'])) {
            $rules = [
                'username' => 'required|min_length[5]|max_length[50]|is_unique[MSO.username]|is_unique[Treasurer.username]|is_unique[Inspector.username]|is_unique[DAStaff.DAStaff_username]',
                'password' => 'required|validatePasswordMSO[password]',
            ];
            $errors = [
                'username' => [
                    'required'      => 'This field is required',
                    'min_length'    => 'Username must be atleast 5 characters long',
                    'max_length'    => 'Username must not be more than 50 character',
                    'is_unique'     => 'Username has been taken'
                ],
                'password' => [
                    'required'              => 'This field is required',
                    'validatePasswordMSO'   => 'Password is incorrect',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'MSO_id'    => $this->session->get('MSO_id'),
                    'username'  => $this->request->getPost('username'),
                ];
                $check = $this->msomodel->save($data);
                if ($check) {
                    session()->set('MSO_username', $this->request->getPost('username'));
                    $this->session->setFlashdata('success', 'Username Updated Successfully');
                    return redirect()->to(base_url('ManageProfileMSO'));
                } else {
                    $this->session->setFlashdata('failed', 'Username Update Failed');
                    return redirect()->to(base_url('ManageProfileMSO'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('msoview/mso-changeusername', $data);
            }
        }
        return view('msoview/mso-changeusername', $data);
    }
    public function changeaddress()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-address-mso'])) {
            $rules = [
                'Address' => 'required|min_length[4]',
            ];
            $errors = [
                'Address' => [
                    'required'      => 'This field is required',
                    'min_length'    => 'This Address is too short'
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'MSO_id'    => $this->session->get('MSO_id'),
                    'address'   => $this->request->getPost('Address'),
                ];
                $check = $this->msomodel->save($data);
                if ($check) {
                    session()->set('MSO_address', $this->request->getPost('Address'));
                    $this->session->setFlashdata('success', 'Address Updated Successfully');
                    return redirect()->to(base_url('ManageProfileMSO'));
                } else {
                    $this->session->setFlashdata('failed', 'Address Update Failed');
                    return redirect()->to(base_url('ManageProfileMSO'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('msoview/mso-changeaddress', $data);
            }
        }
        return view('msoview/mso-changeaddress.php', $data);
    }
    public function changepass()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-password-mso'])) {
            $rules = [
                'currentpass' => 'required|validateCurrentPasswordMSO[currentpass]',
                'newpass' => 'required|min_length[5]|validateNewPasswordMSO[newpass]',
                'confirmnewpass' => 'matches[newpass]',
            ];
            $errors = [
                'currentpass' => [
                    'required' => 'This field is required',
                    'validateCurrentPasswordMSO' => 'Password is incorrect',
                ],
                'newpass' => [
                    'required' => 'This field is required',
                    'min_length' => 'Password is too short',
                    'validateNewPasswordMSO' => 'This is your current password'
                ],
                'confirmnewpass' => [
                    'matches' => 'New Password do not Match'
                ]
            ];
            if ($this->validate($rules, $errors)) {
                $password_hash = password_hash($this->request->getPost('newpass'), PASSWORD_DEFAULT);
                $data = [
                    'MSO_id' => $this->session->get('MSO_id'),
                    'password' => $password_hash,
                ];
                $check = $this->msomodel->save($data);
                if ($check) {
                    session()->set('MSO_password', $password_hash);
                    $this->session->setFlashdata('success', 'Password Updated Successfully');
                    return redirect()->to(base_url('ManageProfileMSO'));
                } else {
                    $this->session->setFlashdata('failed', 'Password Update Failed');
                    return redirect()->to(base_url('ManageProfileMSO'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('msoview/mso-changepassword', $data);
            }
        }
        return view('msoview/mso-changepassword', $data);
    }

    public function changecontact()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-contact-mso'])) {
            $rules = [
                'contact' => 'required|min_length[13]|max_length[13]|regex_match[^(\+639)\d{9}$]',
                'password' => 'required|validatePasswordMSO[password]',
            ];
            $errors = [
                'contact' => [
                    'required' => 'This field is required',
                    'min_length' => 'Contact is not valid',
                    'max_length' => 'Contact is not valid',
                    'regex_match' => 'Contact number must start with +63'
                ],
                'password' => [
                    'required' => 'This field is required',
                    'validatePasswordMSO' => 'Password is incorrect',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $mso_id = $this->session->get('MSO_id');

                $data = [
                    'MSO_id' => $mso_id,
                    'contact' => $this->request->getVar('contact'),
                ];
                $check = $this->msomodel->save($data);
                if ($check) {
                    session()->set('MSO_contact', $this->request->getVar('contact'));
                    $this->session->setFlashdata('success', 'Contact Updated Successfully');
                    return redirect()->to(base_url('ManageProfileMSO'));
                } else {
                    $this->session->setFlashdata('failed', 'Contact Update Failed');
                    return redirect()->to(base_url('ManageProfileMSO'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('msoview/mso-changecontact', $data);
            }
        }
        return view('msoview/mso-changecontact', $data);
    }

    public function setsched()
    {
        $data['firstname'] = $this->session->get('MSO_firstname');
        $data['lastname'] = $this->session->get('MSO_lastname');
        $data['dates'] = $this->querymodel->date_disables(); //query to disable date when the date have >= 15 schedules
        return view('msoview/mso-setschedule', $data);
    }

    public function store()
    {
        $last_id = $this->schedulemodel->limit(1)->orderBy('schedule_id', 'DESC')->first();
        if ($last_id) {
            $index_id = $last_id['index_id'];
            $updated_index_id = $index_id + 1;
        } else {
            $updated_index_id = 1;
        }
        $animal_type = $this->request->getVar('animaltype');
        $animal_origin = $this->request->getVar('origin');
        $animal_weight = $this->request->getVar('weight');
        $animal_quantity = $this->request->getVar('quantity');
        if ($this->isOnline()) {
            foreach ($animal_type as $key => $insertion) { //animal_type => pig
                $insertion = [
                    'index_id'          => $updated_index_id,
                    'MSO_id'            => $this->session->get('MSO_id'),
                    'Animal_type'       => $animal_type[$key],
                    'Animal_quantity'   => $animal_quantity[$key],
                    'Animal_weight'     => $animal_weight[$key],
                    'Animal_origin'     => $animal_origin[$key],
                    'schedule_status'   => 0,
                    'schedule_datetime' => $this->request->getPost('datetime'),
                ];
                $result = $this->schedulemodel->save($insertion); //Save schedule 
                $sched_id = $this->schedulemodel->getInsertID(); //Get the id of the last inserted id in schedule
                $mso = $this->msomodel->where('MSO_id', $this->session->get('MSO_id'))->first();
                $data = [
                    'Schedule_id' => $sched_id,
                    'inspect_status' => 'Pending',
                ];
                $result2 = $this->inspectstatusmodel->save($data);
            }

            if ($result && $result2) {
                $notif = $this->sendmessage($mso, $this->request->getPost('datetime'));
                if ($notif) {
                    $this->session->setFlashdata('success', 'Scheduled Successfully');
                    return redirect()->to(base_url('MSOSetSched'));
                } else {
                    $this->session->setFlashdata('failed', 'Scheduled Failed');
                    return redirect()->to(base_url('MSOSetSched'));
                }
            } else {
                $this->session->setFlashdata('failed', 'Scheduled Failed');
                return redirect()->to(base_url('MSOSetSched'));
            }
        } else {
            $this->session->setFlashdata('failed', 'Check your Internet Connection');
            return redirect()->to(base_url('MSOSetSched'));
        }
    }

    private function sendmessage($mso, $date)
    {
        $dates = date('M d, Y h:i:s a', strtotime($date));
        $header = "Livestock Slaughter House Management System";
        $body = "Dear inspector,\n\n You have new request made by " . $mso['firstname'] . ' ' . $mso['lastname'] . ' on ' . $dates;
        $mesg = "{$header}\n\n{$body}";
        $contact = $this->inspectormodel->findAll();
        //backupnumber
        //+15075981579
        foreach ($contact as $mobile) {
            $message = $this->twilio->messages->create(
                $mobile['contact'],
                // Text this number
                [
                    'from' => '+19896584863',
                    // From a valid Twilio number
                    'body' => $mesg
                ]
            );
        }
        if ($message) {
            return true;
        } else {
            return false;
        }
    }

    public function isOnline($site = "https://youtube.com")
    {

        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
    public function msohistory()
    {
        if ($_GET['filter'] == "All") {
            $filter = [0, 1, 2];
        }
        if ($_GET['filter'] == "Pending") {
            $filter = [0];
        }
        if ($_GET['filter'] == "Accepted") {
            $filter = [1];
        }
        if ($_GET['filter'] == "Rejected") {
            $filter = [2];
        }
        if (!$_GET['filter']) {
            $filter = [0, 1, 2];
        }
        $date_from = $_GET['date_from'];
        $date_to = $_GET['date_to'];
        $mso_id = $this->session->get('MSO_id');
        $data =
            [
                'schedules' => $this->querymodel->viewhistoryMSO($mso_id, $filter, $date_from, $date_to),
                'user'      => $this->msomodel->where('MSO_id', $mso_id)->first(),
            ];
        return view('msoview/mso-history', $data);
    }
    public function msohistorydetails($index_id)
    {
        if ($_GET['filter'] == "All") {
            $filter = ['Pending', 'Accepted', 'Rejected'];
        }
        if ($_GET['filter'] == "Pending") {
            $filter = ['Pending'];
        }
        if ($_GET['filter'] == "Accepted") {
            $filter = ['Accepted'];
        }
        if ($_GET['filter'] == "Rejected") {
            $filter = ['Rejected'];
        }
        if (!$_GET['filter']) {
            $filter = ['Pending', 'Accepted', 'Rejected'];
        }
        $mso_id = $this->session->get('MSO_id');
        $data = [
            'count'         => $this->querymodel->count($index_id),
            'scheddate'     => $this->schedulemodel->where('index_id', $index_id)->first(),
            'payment'       => $this->paymentstatusmodel->findAll(),
            'schedules'     => $this->querymodel->msohistorydetails($mso_id, $index_id, $filter),
            'firstname'     => $this->session->get('MSO_firstname'),
            'lastname'      => $this->session->get('MSO_lastname'),
            'totalpayment'  => $this->querymodel->totalpayment($index_id, $mso_id),
            'inspector'     => $this->inspectormodel->findAll(),
            'index_id'      => $index_id
        ];

        return view('msoview/mso-historydetails', $data);
    }
    public function udpdateSched()
    {
        if (isset($_POST['updatesched'])) {
            $index_id = $this->request->getPost('indexID');
            $data = [
                'schedule_id' => $this->request->getPost('scheduleID'),
                'Animal_type' => $this->request->getPost('animaltype'),
                'Animal_weight' => $this->request->getPost('weight'),
                'Animal_origin' => $this->request->getPost('origin'),
            ];
            $check = $this->schedulemodel->save($data);
            if ($check) {
                $this->session->setFlashdata('success', 'Schedule Updated Successfully');
                return redirect()->to(base_url('MSOHistoryDetails/' . $index_id));
            } else {
                $this->session->setFlashdata('failed', 'Schedule Update Failed');
                return redirect()->to(base_url('MSOHistoryDetails/' . $index_id));
            }
        }
    }
    public function RemoveSched($schedule_id, $index_id)
    {
        $check1 = $this->inspectstatusmodel->where('schedule_id', $schedule_id)->delete();
        if ($check1) {
            $check = $this->schedulemodel->where('schedule_id', $schedule_id)->delete();
            if ($check) {
                $this->session->setFlashdata('success', 'Schedule Deleted Successfully');
                return redirect()->to(base_url('MSOHistoryDetails/' . $index_id));
            } else {
                $this->session->setFlashdata('failed', 'Schedule Deleting Failed');
                return redirect()->to(base_url('MSOHistoryDetails/' . $index_id));
            }
        } else {
            $this->session->setFlashdata('failed', 'Schedule Deleting Failed');
            return redirect()->to(base_url('MSOHistoryDetails/' . $index_id));
        }
    }
}
//NfTXdGzDcdBw1tdPBsjuvUlGloZZ4nT5ciVsS8J5