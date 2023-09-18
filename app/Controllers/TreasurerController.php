<?php

namespace App\Controllers;

class TreasurerController extends BaseController
{
    public function __construct()
    {
        if (!session()->get('Treasurer_username')) {
            echo 'Access Denied';
            exit;
        }
    }
    public function index()
    {
        $data1 = $this->querymodel->paymentTotalThisWeekPerDay();
        $paymentData = ['schedules' => $data1];
        $paymentTotalThisWeekPerDay = json_encode($paymentData);
        $data2 = $this->querymodel->paymentTotalLastWeekPerDay();
        $paymentData2 = ['schedules' => $data2];
        $paymentTotalLastWeekPerDay = json_encode($paymentData2);

        $data = [
            'TreasurerName'                 => $this->session->get('Treasurer_firstname'),
            'paymentTotal'                  => $this->querymodel->paymentTotal(),
            'paymentTotalThisWeek'          => $this->querymodel->paymentTotalThisWeek(),
            'paymentTotalLastWeek'          => $this->querymodel->paymentTotalLastWeek(),
            'paymentPending'                => $this->querymodel->paymentPending(),
            'paymentTotalThisWeekPerDay'    => $paymentTotalThisWeekPerDay,
            'paymentTotalLastWeekPerDay'    => $paymentTotalLastWeekPerDay,
            'paymentPendingNow'             => $this->querymodel->paymentPendingNow()
        ];
        return view('treasurerview/treasurer-home', $data);
    }
    public function treasurerprofile()
    {
        $data['viewprofile'] = $this->treasurermodel->where('Treasurer_id', $this->session->get('Treasurer_id'))->findAll();
        return view('treasurerview/treasurer-profile', $data);
    }
    public function changename()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-name-treasurer'])) {
            $rules = [
                'firstname'         => 'required',
                'lastname'          => 'required',
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
                    'Treasurer_id'                =>  $this->session->get('Treasurer_id'),
                    'firstname'         =>  $this->request->getVar('firstname'),
                    'lastname'          =>  $this->request->getVar('lastname'),
                ];
                $check = $this->treasurermodel->save($data);
                if ($check) {
                    session()->set($data);
                    $this->session->setFlashdata('success', 'Name Updated Successfully');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                } else {
                    $this->session->setFlashdata('failed', 'Name Update Failed');
                    return redirect()->to(base_url('TreasurerUpdatename'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('treasurerview/treasurer-changename', $data);
            }
        }
        return view('treasurerview/treasurer-changename', $data);
    }
    public function changeusername()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-username-treasurer'])) {
            $rules = [
                'username'    => 'required|min_length[5]|max_length[50]|is_unique[MSO.username]|is_unique[DAtreasurer.username]|is_unique[DAinspector.username]|is_unique[DAStaff.DAStaff_username]',
                'password'    => 'required|validatePasswordTreasurer[password]',
            ];
            $errors = [
                'username' => [
                    'required'      => 'This field is required',
                    'min_length'    => 'Username must be atleast 5 characters long',
                    'max_length'    => 'Username must not be more than 50 character',
                    'is_unique'     => 'Username has been taken'
                ],
                'password'    => [
                    'required'      => 'This field is required',
                    'validatePasswordTreasurer' => 'Password is incorrect',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'Treasurer_id'          => $this->session->get('Treasurer_id'),
                    'username'    => $this->request->getPost('username'),
                ];
                $check = $this->treasurermodel->save($data);
                if ($check) {
                    session()->set('Treasurer_username', $this->request->getPost('username'));
                    $this->session->setFlashdata('success', 'Username Updated Successfully');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                } else {
                    $this->session->setFlashdata('failed', 'Username Update Failed');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('treasurerview/treasurer-changeusername', $data);
            }
        }
        return view('treasurerview/treasurer-changeusername', $data);
    }
    public function changecontact()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-contact-treasurer'])) {
            $rules = [
                'contact'    => 'required|min_length[13]|max_length[13]|regex_match[^(\+639)\d{9}$]',
                'password'    => 'required|validatePasswordTreasurer[password]',
            ];
            $errors = [
                'contact' => [
                    'required'      => 'This field is required',
                    'min_length'    => 'Contact is not valid',
                    'max_length'    => 'Contact is not valid',
                    'regex_match'     => 'Contact number must start with +63'
                ],
                'password'    => [
                    'required'      => 'This field is required',
                    'validatePasswordTreasurer' => 'Password is incorrect',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'Treasurer_id'            => $this->session->get('Treasurer_id'),
                    'contact'       => $this->request->getVar('contact'),
                ];
                $check = $this->treasurermodel->save($data);
                if ($check) {
                    session()->set('Treasurer_contact', $this->request->getVar('contact'));
                    $this->session->setFlashdata('success', 'Contact Updated Successfully');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                } else {
                    $this->session->setFlashdata('failed', 'Contact Update Failed');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('treasurerview/treasurer-changecontact', $data);
            }
        }
        return view('treasurerview/treasurer-changecontact', $data);
    }
    public function changeaddress()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-address-treasurer'])) {
            $rules = [
                'Address'       => 'required|min_length[4]',
            ];
            $errors = [
                'Address'       => [
                    'required'  => 'This field is required',
                    'min_length' => 'This Address is too short'
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'Treasurer_id'        => $this->session->get('Treasurer_id'),
                    'address'   => $this->request->getPost('Address'),
                ];
                $check = $this->treasurermodel->save($data);
                if ($check) {
                    session()->set('Treasurer_address', $this->request->getPost('Address'));
                    $this->session->setFlashdata('success', 'Address Updated Successfully');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                } else {
                    $this->session->setFlashdata('failed', 'Address Update Failed');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('treasurerview/treasurer-changeaddress', $data);
            }
        }
        return view('treasurerview/treasurer-changeaddress.php', $data);
    }
    public function changepass()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-password-treasurer'])) {
            $rules = [
                'currentpass'       =>      'required|validateCurrentPasswordTreasurer[currentpass]',
                'newpass'           =>      'required|min_length[5]|validateNewPasswordTreasurer[newpass]',
                'confirmnewpass'    =>      'matches[newpass]',
            ];
            $errors = [
                'currentpass' => [
                    'required'                          => 'This field is required',
                    'validateCurrentPasswordTreasurer'      => 'Password is incorrect',
                ],
                'newpass'    => [
                    'required'      => 'This field is required',
                    'min_length'    => 'Password is too short',
                    'validateNewPasswordTreasurer'  => 'This is your current password'
                ],
                'confirmnewpass'    => [
                    'matches'       => 'New Password do not Match'
                ]
            ];
            if ($this->validate($rules, $errors)) {
                $password_hash = password_hash($this->request->getPost('newpass'), PASSWORD_DEFAULT);
                $data = [
                    'Treasurer_id'          =>  $this->session->get('Treasurer_id'),
                    'password'    =>  $password_hash,
                ];
                $check = $this->treasurermodel->save($data);
                if ($check) {
                    session()->set('Treasurer_password', $password_hash);
                    $this->session->setFlashdata('success', 'Password Updated Successfully');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                } else {
                    $this->session->setFlashdata('failed', 'Password Update Failed');
                    return redirect()->to(base_url('ManageProfileTreasurer'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('treasurerview/treasurer-changepassword', $data);
            }
        }
        return view('treasurerview/treasurer-changepassword', $data);
    }
    public function viewsched()
    {

        $data['schedules'] = $this->querymodel->treasurerviewsched();
        return view('treasurerview/treasurer-schedule', $data);
    }
    public function viewschedDate()
    {
        $date_from = $_GET['date_from'];
        $date_to = $_GET['date_to'];
        $data['schedules'] = $this->querymodel->treasurerviewschedperdate($date_from, $date_to);
        return view('treasurerview/treasurer-schedule_date', $data);
    }
    public function payment($index_id, $MSO_id)
    {
        if ($_GET['filter'] == "All") {
            $filter = ['Paid', 'Not Paid'];
        }
        if ($_GET['filter'] == "Paid") {
            $filter = ['Paid'];
        }
        if ($_GET['filter'] == "Not Paid") {
            $filter = ['Not Paid'];
        }
        if (!$_GET['filter']) {
            $filter = ['Paid', 'Not Paid'];
        }
        $data['name'] = $this->msomodel->where('MSO_id', $MSO_id)->findAll();
        $data['schedules'] = $this->querymodel->treasurerviewpayment($index_id, $filter);
        $data['datetime'] = $this->schedulemodel->where('index_id', $index_id)->first();
        $data['index_id'] = $index_id;
        $data['MSO_id'] = $MSO_id;
        return view('treasurerview/treasurer-payment', $data);
    }
    public function markpaid()
    {
        $payment_status = "Paid";
        $index_id = $this->request->getPost('index_id');
        $MSO_id = $this->request->getPost('MSO_id');
        $data = [
            'payment_id'        => $this->request->getPost('payment_id'),
            'Treasurer_id'      => $this->session->get('Treasurer_id'),
            'payment_status'    => $payment_status,
            'payment_price'     => $this->request->getPost('payment_price'),
        ];
        $update = $this->paymentstatusmodel->save($data);
        if ($update) {
            $this->session->setFlashdata('success', 'Mark as Paid Successfully');
            return redirect()->to(base_url('TreasurerUpdateSchedule/' . $index_id . '/' . $MSO_id . '?filter=All'));
        } else {
            $this->session->setFlashdata('failed', 'Mark as Paid Failed');
            return redirect()->to(base_url('TreasurerUpdateSchedule/' . $index_id . '/' . $MSO_id . '?filter=All'));
        }
    }
    public function paymenthistory()
    {
        $data['paymentusers'] = $this->querymodel->paymenthistory();
        return view('treasurerview/treasurer-payment-history', $data);
    }
    public function paymenthistoryDate()
    {
        $date_from = $_GET['date_from'];
        $date_to = $_GET['date_to'];
        $data['paymentusers'] = $this->querymodel->paymenthistoryDate($date_from, $date_to);
        return view('treasurerview/treasurer-payment-historyDate', $data);
    }
    public function paymenthistorydetails($MSO_id)
    {
        $data = [
            'paymentdetails'    => $this->querymodel->paymentdetails($MSO_id),
        ];
        return view('treasurerview/treasurer-payment-history-details', $data);
    }
    public function paymenthistoryanimals($index_id, $MSO_id)
    {
        if ($_GET['filter'] == "All") {
            $filter = ['Paid', 'Not Paid'];
        }
        if ($_GET['filter'] == "Paid") {
            $filter = ['Paid'];
        }
        if ($_GET['filter'] == "Not Paid") {
            $filter = ['Not Paid'];
        }
        if (!$_GET['filter']) {
            $filter = ['Paid', 'Not Paid'];
        }
        //Queries
        $data = [
            'user'              => $this->msomodel->where('MSO_id', $MSO_id)->findAll(),
            'paymentanimals'    => $this->querymodel->paymentanimals($index_id, $MSO_id, $filter),
            'totalpayment'      => $this->querymodel->totalpayment($index_id, $MSO_id),
            'datetime'          => $this->schedulemodel->where('index_id', $index_id)->orderBy('index_id')->first(),
            'index_id'          => $index_id,
            'MSO_id'            => $MSO_id
        ];
        return view('treasurerview/treasurer-payment-animals', $data);
    }
}
