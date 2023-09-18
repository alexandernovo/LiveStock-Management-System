<?php


namespace App\Controllers;

use \DateTime;


class AdminController extends BaseController
{
    public function __construct()
    {
        if (!session()->get('Admin_username')) {
            echo 'Access Denied';
            exit;
        }
    }
    public function index()
    {
        $data['AdminName'] = $this->session->get('Admin_firstname');
        echo view('adminview/admin-home', $data);
    }
    public function dashboard()
    {
        $schedule = $this->querymodel->getScheduleDatetime();
        $labels = array();
        $counts = array(0, 0, 0, 0, 0, 0, 0);
        foreach ($schedule as $data) {
            $date = new DateTime($data['schedule_datetime']);
            $dayOfWeek = $date->format('w');
            $label = "";
            switch ($dayOfWeek) {
                case 0:
                    $label = "S";
                    $counts[0]++;
                    break;
                case 1:
                    $label = "M";
                    $counts[1]++;
                    break;
                case 2:
                    $label = "T";
                    $counts[2]++;
                    break;
                case 3:
                    $label = "W";
                    $counts[3]++;
                    break;
                case 4:
                    $label = "T";
                    $counts[4]++;
                    break;
                case 5:
                    $label = "F";
                    $counts[5]++;
                    break;
                case 6:
                    $label = "S";
                    $counts[6]++;
                    break;
            }
            array_push($labels, $label);
        }

        //Convert to json
        $data['schedule'] = json_encode(array('labels' => $labels, 'counts' => $counts));
        //
        //Pass the InspectStatus per month
        $data['schedule_count'] = $this->querymodel->getScheduleCountByMonth();
        $data['schedule_counts'] = $this->querymodel->getScheduleCountByMonths();
        $data['totalMSO'] = $this->msomodel->countALL();
        $data['totalSchedule'] = $this->schedulemodel->countALL();
        $data['pendingSchedule'] = $this->inspectstatusmodel->where('inspect_status', 'Pending')->countALLResults();
        $data['pendingPayment'] = $this->paymentstatusmodel->where('payment_status', 'Not Paid')->countALLResults();
        return view('adminview/admin_dashboard', $data);
    }
    public function registeruser()
    {
        $data['Users'] = $this->request->getVar('selectUser');
        helper(['form']);
        $data = [];
        if (isset($_POST['register-user'])) {
            helper(['form']);
            $data = [];
            $rules = [
                'firstname'            => 'required',
                'lastname'             => 'required',
                'address'              => 'required|min_length[3]|max_length[50]',
                'contact'              => 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]',
                'username'             => 'required|min_length[6]|max_length[50]|is_unique[MSO.username]|is_unique[Treasurer.username]|is_unique[Inspector.username]|is_unique[DAStaff.DAStaff_username]',
                'password'             => 'required|min_length[6]|max_length[200]',
                'confirmpassword'      => 'matches[password]'
            ];
            $errors = [
                'firstname' => [
                    'required' => "This field is required",
                ],
                'lastname' => [
                    'required' => "This field is required",
                ],
                'address' => [
                    'required' => "This field is required",
                    'min_length' => "Address is too short",
                    'max_length' => "Address is too long",
                ],
                'contact' => [
                    'required' => "This field is required",
                    'min_length' => "This is not a valid contact",
                    'max_length' => "This is not a valid contact",
                ],
                'username' => [
                    'required' => "This field is required",
                    'min_length' => "Username must have 6 characters or above",
                    'max_length' => "Username must not exceed 50 characters",
                    'is_unique' => "Username is taken",
                ],
                'password' => [
                    'required' => "This field is required",
                    'min_length' => "Password must have 6 characters or above",
                    'max_length' => "Password must not exceed 50 characters",
                ],
                'confirmpassword' => [
                    'matches' => "Password do not Match",
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $UserRegister = $this->request->getVar('selectUser');

                if ($UserRegister == 'MSO') {
                    $adminid = $this->session->get('Admin_id');
                    $data = [
                        'DAStaff_id'        => $adminid,
                        'firstname'         => $this->request->getVar('firstname'),
                        'lastname'          => $this->request->getVar('lastname'),
                        'username'          => $this->request->getPost('username'),
                        'password'          => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'contact'           => "+63" . $this->request->getVar('contact'),
                        'address'           => $this->request->getVar('address'),
                        'status'            => 1,
                    ];
                    $check = $this->msomodel->save($data);
                    if ($check) {
                        $this->session->setFlashdata('success', 'Register MSO User Successfully');
                        return redirect()->to(base_url('Register'));
                    } else {
                        $this->session->setFlashdata('failed', 'Register MSO User Failed');
                        return redirect()->to(base_url('Register'));
                    }
                }
                if ($UserRegister == 'Treasurer') {
                    $adminid = $this->session->get('Admin_id');
                    $data = [
                        'DAStaff_id'            => $adminid,
                        'firstname'             => $this->request->getVar('firstname'),
                        'lastname'              => $this->request->getVar('lastname'),
                        'username'              => $this->request->getPost('username'),
                        'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'contact'               => "+63" . $this->request->getVar('contact'),
                        'address'               => $this->request->getVar('address'),
                        'status'                => 1,
                    ];
                    $check = $this->treasurermodel->save($data);
                    if ($check) {
                        $this->session->setFlashdata('success', 'Register Treasurer User Successfully');
                        return redirect()->to(base_url('Register'));
                    } else {
                        $this->session->setFlashdata('failed', 'Register Treasurer User Failed');
                        return redirect()->to(base_url('Register'));
                    }
                }
                if ($UserRegister == 'Inspector') {
                    $adminid = $this->session->get('Admin_id');
                    $data = [
                        'DAStaff_id'            => $adminid,
                        'firstname'             => $this->request->getVar('firstname'),
                        'lastname'              => $this->request->getVar('lastname'),
                        'username'              => $this->request->getPost('username'),
                        'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'contact'               => "+63" . $this->request->getVar('contact'),
                        'address'               => $this->request->getVar('address'),
                        'status'                => 1,
                    ];
                    $check = $this->inspectormodel->save($data);
                    if ($check) {
                        $this->session->setFlashdata('success', 'Register Inspector User Successfully');
                        return redirect()->to(base_url('Register'));
                    } else {
                        $this->session->setFlashdata('failed', 'Register Inspector User Failed');
                        return redirect()->to(base_url('Register'));
                    }
                }
            } else {
                $data['validation'] = $this->validator;
                return view('adminview/admin-register-user', $data);
            }
        }
        return view('adminview/admin-register-user', $data);
    }

    public function manageMSO()
    {
        $data['viewuser'] = $this->msomodel->findAll();
        return view('adminview/admin-manage-mso', $data);
    }
    public function manageTreasurer()
    {
        $data['viewuser'] = $this->treasurermodel->findAll();
        return view('adminview/admin-manage-treasurer', $data);
    }
    public function manageInspector()
    {
        $data['viewuser'] = $this->inspectormodel->findAll();
        return view('adminview/admin-manage-inspector', $data);
    }
    public function updateMSO($id)
    {
        $data['mso'] = $this->msomodel->where('MSO_id', $id)->first();
        return view('adminview/admin-update-mso', $data);
    }
    public function updateTreasurer($id)
    {
        $data['treasurer'] = $this->treasurermodel->where('Treasurer_id', $id)->first();
        echo view('adminview/admin-update-treasurer', $data);
    }
    public function updateInspector($id)
    {
        $data['inspector'] = $this->inspectormodel->where('Inspector_id', $id)->first();
        echo view('adminview/admin-update-inspector', $data);
    }
    public function updateUser($id)
    {
        $user_id = $this->request->getVar('id-user');
        $checkusername = $this->request->getPost('checkusername');
        $checkpassword = $this->request->getPost('checkpassword');
        if (isset($_POST['update-user'])) {
            if ($checkusername == 1) {
                if ($checkpassword == 1)
                /**check & check */
                {
                    $rules = [
                        'firstname'            => 'required|max_length[20]',
                        'lastname'              => 'required|min_length[1]|max_length[20]',
                        'address'              => 'required|min_length[3]|max_length[50]',
                        'contact'              => 'required|min_length[13]|max_length[13]',
                        'username'             => 'required|min_length[6]|max_length[50]|is_unique[MSO.username]|is_unique[Treasurer.username]|is_unique[Inspector.username]|is_unique[DAStaff.DAStaff_username]',
                        'password'             => 'required|min_length[6]|max_length[200]',
                        'confirmpassword'      => 'matches[password]'
                    ];
                    $errors = [
                        'firstname' => [
                            'required' => "This field is required",
                            'max_length' => "Firstname is too long",
                        ],
                        'lastname' => [
                            'required' => "This field is required",
                            'min_length' => "Surname is too short",
                            'max_length' => "Surname is too long",
                        ],
                        'address' => [
                            'required' => "This field is required",
                            'min_length' => "Address is too short",
                            'max_length' => "Address is too long",
                        ],
                        'contact' => [
                            'required' => "This field is required",
                            'min_length' => "This is not a valid contact",
                            'max_length' => "This is not a valid contact",
                        ],
                        'username' => [
                            'required' => "This field is required",
                            'min_length' => "Username must have 6 characters or above",
                            'max_length' => "Username must not exceed 50 characters",
                            'is_unique' => "Username is taken",
                        ],
                        'password' => [
                            'min_length' => "Password must have 6 characters or above",
                            'max_length' => "Password must not exceed 50 characters",
                        ],
                        'confirmpassword' => [
                            'matches' => "Password do not Match",
                        ],
                    ];
                    if ($this->validate($rules, $errors)) {
                        if ($user_id == 'mso') {
                            $data = [
                                'MSO_id'      => $id,
                                'firstname'   => $this->request->getPost('firstname'),
                                'lastname'    => $this->request->getPost('lastname'),
                                'username'    => $this->request->getPost('username'),
                                'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                                'contact'     => $this->request->getPost('contact'),
                                'address'     => $this->request->getPost('address'),
                            ];
                            $check = $this->msomodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update MSO User Successfully');
                                return redirect()->to(base_url('ManageMSO'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update MSO User Failed');
                                return redirect()->to(base_url('ManageMSO'));
                            }
                        } else if ($user_id == 'treasurer') {
                            $data = [
                                'Treasurer_id'          => $id,
                                'firstname'   => $this->request->getPost('firstname'),
                                'lastname'    => $this->request->getPost('lastname'),
                                'username'    => $this->request->getPost('username'),
                                'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                                'contact'     => $this->request->getPost('contact'),
                                'address'     => $this->request->getPost('address'),
                            ];
                            $check = $this->treasurermodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Treasurer User Successfully');
                                return redirect()->to(base_url('ManageTreasurer'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Treasurer User Failed');
                                return redirect()->to(base_url('ManageTreasurer'));
                            }
                        } else if ($user_id == 'inspector') {
                            $data = [
                                'Inspector_id'          => $id,
                                'firstname'             => $this->request->getVar('firstname'),
                                'lastname'              => $this->request->getVar('lastname'),
                                'username'              => $this->request->getPost('username'),
                                'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                                'contact'               => $this->request->getVar('contact'),
                                'address'               => $this->request->getVar('address'),
                            ];
                            $check = $this->inspectormodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Inspector User Successfully');
                                return redirect()->to(base_url('ManageInspector'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Inspector User Failed');
                                return redirect()->to(base_url('ManageInspector'));
                            }
                        }
                    } else {
                        /**Validation */
                        if ($user_id == 'mso') {
                            $data['mso'] = $this->msomodel->where('MSO_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-mso', $data);
                        } else if ($user_id == 'treasurer') {
                            $data['treasurer'] = $this->treasurermodel->where('Treasurer_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-treasurer', $data);
                        } else if ($user_id == 'inspector') {
                            $data['inspector'] = $this->inspectormodel->where('Inspector_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-inspector', $data);
                        }
                    }
                } else /*check & uncheck*/ {
                    $rules = [
                        'firstname'            => 'required|min_length[1]|max_length[20]',
                        'lastname'             => 'required|min_length[1]|max_length[20]',
                        'address'              => 'required|min_length[3]|max_length[50]',
                        'contact'              => 'required|min_length[13]|max_length[13]',
                        'username'             => 'required|min_length[6]|max_length[50]|is_unique[MSO.username]|is_unique[Treasurer.username]|is_unique[Inspector.username]|is_unique[DAStaff.DAStaff_username]'
                    ];
                    $errors = [
                        'firstname' => [
                            'required' => "This field is required",
                            'min_length' => "Firstname is too short",
                            'max_length' => "Firstname is too long",
                        ],
                        'lastname' => [
                            'required' => "This field is required",
                            'min_length' => "Surname is too short",
                            'max_length' => "Surname is too long",
                        ],
                        'address' => [
                            'required' => "This field is required",
                            'min_length' => "Address is too short",
                            'max_length' => "Address is too long",
                        ],
                        'contact' => [
                            'required' => "This field is required",
                            'min_length' => "This is not a valid contact",
                            'max_length' => "This is not a valid contact",
                        ],
                        'username' => [
                            'required' => "This field is required",
                            'min_length' => "Username must have 6 characters or above",
                            'max_length' => "Username must not exceed 50 characters",
                            'is_unique' => "Username is taken",
                        ],
                    ];
                    if ($this->validate($rules, $errors)) {
                        if ($user_id == 'mso') {
                            $data = [
                                'MSO_id'      => $id,
                                'firstname'   => $this->request->getPost('firstname'),
                                'lastname'    => $this->request->getPost('lastname'),
                                'username'    => $this->request->getPost('username'),
                                'contact'     => $this->request->getPost('contact'),
                                'address'     => $this->request->getPost('address'),
                            ];
                            $check = $this->msomodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update MSO User Successfully');
                                return redirect()->to(base_url('ManageMSO'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update MSO User Failed');
                                return redirect()->to(base_url('ManageMSO'));
                            }
                        } else if ($user_id == 'treasurer') {
                            $data = [
                                'Treasurer_id'          => $id,
                                'firstname'             => $this->request->getPost('firstname'),
                                'lastname'              => $this->request->getPost('lastname'),
                                'username'              => $this->request->getPost('username'),
                                'contact'               => $this->request->getPost('contact'),
                                'address'               => $this->request->getPost('address'),
                            ];
                            $check = $this->treasurermodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Treasurer User Successfully');
                                return redirect()->to(base_url('ManageTreasurer'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Treasurer User Failed');
                                return redirect()->to(base_url('ManageTreasurer'));
                            }
                        } else if ($user_id == 'inspector') {
                            $data = [
                                'Inspector_id'          => $id,
                                'firstname'             => $this->request->getPost('firstname'),
                                'lastname'              => $this->request->getPost('lastname'),
                                'username'              => $this->request->getPost('username'),
                                'contact'               => $this->request->getPost('contact'),
                                'address'               => $this->request->getPost('address'),
                            ];
                            $check = $this->inspectormodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Inspector User Successfully');
                                return redirect()->to(base_url('ManageInspector'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Inspector User Failed');
                                return redirect()->to(base_url('ManageInspector'));
                            }
                        }
                    } else
                    /**Validation */
                    {
                        if ($user_id == 'mso') {
                            $data['mso'] = $this->msomodel->where('MSO_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-mso', $data);
                        } else if ($user_id == 'treasurer') {
                            $data['treasurer'] = $this->treasurermodel->where('Treasurer_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-treasurer', $data);
                        } else if ($user_id == 'inspector') {
                            $data['inspector'] = $this->inspectormodel->where('Inspector_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-inspector', $data);
                        }
                    }
                }
            } else {
                if ($checkpassword == 1)
                /**uncheck & check */
                {
                    $rules = [
                        'firstname'            => 'required|min_length[1]|max_length[20]',
                        'lastname'             => 'required|min_length[1]|max_length[20]',
                        'address'              => 'required|min_length[3]|max_length[50]',
                        'contact'              => 'required|min_length[13]|max_length[13]',
                        'password'             => 'required|min_length[6]|max_length[200]',
                        'confirmpassword'      => 'matches[password]'
                    ];
                    $errors = [
                        'firstname' => [
                            'required' => "This field is required",
                            'min_length' => "Firstname is too short",
                            'max_length' => "Firstname is too long",
                        ],
                        'lastname' => [
                            'required' => "This field is required",
                            'min_length' => "Surname is too short",
                            'max_length' => "Surname is too long",
                        ],
                        'address' => [
                            'required' => "This field is required",
                            'min_length' => "Address is too short",
                            'max_length' => "Address is too long",
                        ],
                        'contact' => [
                            'required' => "This field is required",
                            'min_length' => "This is not a valid contact",
                            'max_length' => "This is not a valid contact",
                        ],
                        'password' => [
                            'min_length' => "Password must have 6 characters or above",
                            'max_length' => "Password must not exceed 50 characters",
                        ],
                        'confirmpassword' => [
                            'matches' => "Password do not Match",
                        ],
                    ];
                    if ($this->validate($rules, $errors)) {
                        if ($user_id == 'mso') {
                            $data = [
                                'MSO_id'      => $id,
                                'firstname'   => $this->request->getPost('firstname'),
                                'lastname'    => $this->request->getPost('lastname'),
                                'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                                'contact'     => $this->request->getPost('contact'),
                                'address'     => $this->request->getPost('address'),
                            ];
                            $check = $this->msomodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update MSO User Successfully');
                                return redirect()->to(base_url('ManageMSO'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update MSO User Failed');
                                return redirect()->to(base_url('ManageMSO'));
                            }
                        } else if ($user_id == 'treasurer') {
                            $data = [
                                'Treasurer_id'          => $id,
                                'firstname'             => $this->request->getPost('firstname'),
                                'lastname'              => $this->request->getPost('lastname'),
                                'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                                'contact'               => $this->request->getPost('contact'),
                                'address'               => $this->request->getPost('address'),
                            ];
                            $check = $this->treasurermodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Treasurer User Successfully');
                                return redirect()->to(base_url('ManageTreasurer'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Treasurer User Failed');
                                return redirect()->to(base_url('ManageTreasurer'));
                            }
                        } else if ($user_id == 'inspector') {
                            $data = [
                                'Inspector_id'          => $id,
                                'firstname'             => $this->request->getPost('firstname'),
                                'lastname'              => $this->request->getPost('lastname'),
                                'password'              => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                                'contact'               => $this->request->getPost('contact'),
                                'address'               => $this->request->getPost('address'),
                            ];
                            $check = $this->inspectormodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Inspector User Successfully');
                                return redirect()->to(base_url('ManageInspector'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Inspector User Failed');
                                return redirect()->to(base_url('ManageInspector'));
                            }
                        }
                    } else {
                        if ($user_id == 'mso') {
                            $data['mso'] = $this->msomodel->where('MSO_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-mso', $data);
                        } else if ($user_id == 'treasurer') {
                            $data['treasurer'] = $this->treasurermodel->where('Treasurer_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-treasurer', $data);
                        } else if ($user_id == 'inspector') {
                            $data['inspector'] = $this->inspectormodel->where('Inspector_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-inspector', $data);
                        }
                    }
                } else {
                    $rules = [
                        'firstname'            => 'required|min_length[1]|max_length[20]',
                        'lastname'             => 'required|min_length[1]|max_length[20]',
                        'address'              => 'required|min_length[3]|max_length[50]',
                        'contact'              => 'required|min_length[13]|max_length[13]',
                    ];
                    $errors = [
                        'firstname' => [
                            'required' => "This field is required",
                            'min_length' => "Firstname is too short",
                            'max_length' => "Firstname is too long",
                        ],
                        'lastname' => [
                            'required' => "This field is required",
                            'min_length' => "Surname is too short",
                            'max_length' => "Surname is too long",
                        ],
                        'address' => [
                            'required' => "This field is required",
                            'min_length' => "Address is too short",
                            'max_length' => "Address is too long",
                        ],
                        'contact' => [
                            'required' => "This field is required",
                            'min_length' => "This is not a valid contact",
                            'max_length' => "This is not a valid contact",
                        ],
                    ];
                    if ($this->validate($rules, $errors)) {
                        if ($user_id == 'mso') {
                            $data = [
                                'MSO_id'      => $id,
                                'firstname'   => $this->request->getPost('firstname'),
                                'lastname'    => $this->request->getPost('lastname'),
                                'contact'     => $this->request->getPost('contact'),
                                'address'     => $this->request->getPost('address'),
                            ];
                            $check = $this->msomodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update MSO User Successfully');
                                return redirect()->to(base_url('ManageMSO'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update MSO User Failed');
                                return redirect()->to(base_url('ManageMSO'));
                            }
                        } else if ($user_id == 'treasurer') {
                            $data = [
                                'Treasurer_id'          => $id,
                                'firstname'             => $this->request->getPost('firstname'),
                                'lastname'              => $this->request->getPost('lastname'),
                                'contact'               => $this->request->getPost('contact'),
                                'address'               => $this->request->getPost('address'),
                            ];
                            $check = $this->treasurermodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Treasurer User Successfully');
                                return redirect()->to(base_url('ManageTreasurer'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Treasurer User Failed');
                                return redirect()->to(base_url('ManageTreasurer'));
                            }
                        } else if ($user_id == 'inspector') {
                            $data = [
                                'Inspector_id'          => $id,
                                'firstname'             => $this->request->getPost('firstname'),
                                'lastname'              => $this->request->getPost('lastname'),
                                'contact'               => $this->request->getPost('contact'),
                                'address'               => $this->request->getPost('address'),
                            ];
                            $check = $this->inspectormodel->save($data);
                            if ($check) {
                                $this->session->setFlashdata('success', 'Update Inspector User Successfully');
                                return redirect()->to(base_url('ManageInspector'));
                            } else {
                                $this->session->setFlashdata('failed', 'Update Inspector User Failed');
                                return redirect()->to(base_url('ManageInspector'));
                            }
                        }
                    } else {
                        if ($user_id == 'mso') {
                            $data['mso'] = $this->msomodel->where('MSO_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-mso', $data);
                        } else if ($user_id == 'treasurer') {
                            $data['treasurer'] = $this->treasurermodel->where('Treasurer_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-treasurer', $data);
                        } else if ($user_id == 'inspector') {
                            $data['inspector'] = $this->inspectormodel->where('Inspector_id', $id)->first();
                            $data['validation'] = $this->validator;
                            return view('adminview/admin-update-inspector', $data);
                        }
                    }
                }
            }
        }
    }

    public function manageProfile()
    {
        $admin_id = $this->session->get('Admin_id');
        $data['viewprofile'] = $this->dastaffmodel->where('DAStaff_id', $admin_id)->findAll();
        return view('adminview/admin-manage-profile', $data);
    }
    public function changepass()
    {
        helper(['form']);
        $data = [];
        if (isset($_POST['update-password-admin'])) {
            $rules = [
                'currentpass'       =>      'required|validateCurrentPasswordAdmin[currentpass]',
                'newpass'           =>      'required|min_length[5]|validateNewPasswordAdmin[newpass]',
                'confirmnewpass'    =>      'matches[newpass]',
            ];
            $errors = [
                'currentpass' => [
                    'required'                          => 'This field is required',
                    'validateCurrentPasswordAdmin'      => 'Password is incorrect',
                ],
                'newpass'    => [
                    'required'      => 'This field is required',
                    'min_length'    => 'Password is too short',
                    'validateNewPasswordAdmin'  => 'This is your current password'
                ],
                'confirmnewpass'    => [
                    'matches'       => 'New Password do not Match'
                ]
            ];
            if ($this->validate($rules, $errors)) {
                $password_hash = password_hash($this->request->getPost('newpass'), PASSWORD_DEFAULT);
                $data = [
                    'DAStaff_id'          =>  $this->session->get('Admin_id'),
                    'DAStaff_password'    =>  $password_hash,
                ];
                $check = $this->dastaffmodel->save($data);
                if ($check) {
                    session()->set('Admin_password', $password_hash);
                    $this->session->setFlashdata('success', 'Password Updated Successfully');
                    return redirect()->to(base_url('ManageProfile'));
                } else {
                    $this->session->setFlashdata('failed', 'Password Update Failed');
                    return redirect()->to(base_url('ManageProfile'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('adminview/admin-changepass', $data);
            }
        }

        return view('adminview/admin-changepass', $data);
    }
    public function changeusername()
    {
        helper(['form']);
        $data = [];
        if (isset($_POST['update-username-admin'])) {
            $rules = [
                'username'    => 'required|min_length[5]|max_length[50]|is_unique[MSO.username]|is_unique[Treasurer.username]|is_unique[Inspector.username]|is_unique[DAStaff.DAStaff_username]',
                'password'    => 'required|validatePasswordAdmin[password]',
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
                    'validatePasswordAdmin' => 'Password is incorrect',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'DAStaff_id'          => $this->session->get('Admin_id'),
                    'DAStaff_username'    => $this->request->getPost('username'),
                ];

                $check = $this->dastaffmodel->save($data);
                if ($check) {
                    session()->set('Admin_username', $this->request->getPost('username'));
                    $this->session->setFlashdata('success', 'Username Updated Successfully');
                    return redirect()->to(base_url('ManageProfile'));
                } else {
                    $this->session->setFlashdata('failed', 'Username Update Failed');
                    return redirect()->to(base_url('UpdateUsername'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('adminview/admin-changeusername', $data);
            }
        }
        return view('adminview/admin-changeusername', $data);
    }
    public function changename()
    {
        helper(['form']);
        $data = [];
        if (isset($_POST['update-name-admin'])) {
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
                    'DAStaff_id'           =>  $this->session->get('Admin_id'),
                    'DAStaff_firstname'    =>  $this->request->getVar('firstname'),
                    'DAStaff_lastname'     =>  $this->request->getVar('lastname'),
                ];
                $check = $this->dastaffmodel->save($data);
                if ($check) {
                    session()->set($data);
                    $this->session->setFlashdata('success', 'Name Updated Successfully');
                    return redirect()->to(base_url('ManageProfile'));
                } else {
                    $this->session->setFlashdata('failed', 'Name Update Failed');
                    return redirect()->to(base_url('UpdateName'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('adminview/admin-changename', $data);
            }
        }
        return view('adminview/admin-changename', $data);
    }

    public function viewtransaction()
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
        $data['transaction'] = $this->querymodel->viewTransaction($date_from, $date_to, $filter);
        return view('adminview/admin-viewtransaction', $data);
    }

    public function viewtransactionGroup()
    {
        $data['transaction'] = $this->querymodel->viewTransactionGroup();
        return view('adminview/admin-viewtransactionGroup', $data);
    }
    public function viewtransactiondetails($index_id, $id)
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
        $data = [
            'index_id'          => $index_id,
            'MSO_id'            => $id,
            'MSO'               => $this->msomodel->where('MSO_id', $id)->findAll(),
            'totalpayment'      => $this->querymodel->totalpayment($index_id, $id),
            'transaction'       => $this->querymodel->viewTransactionDetails($index_id, $filter),
            'payment'           => $this->paymentstatusmodel->findAll(),
            'inspector'         => $this->inspectormodel->findAll()
        ];
        return view('adminview/admin-transaction-details', $data);
    }

    public function generateReportDetails()
    {
        if ($date_generate = $this->request->getPost('date-generate')) {
            $data['month'] = $this->request->getPost('date-generate');
            $date = strtotime($date_generate);
            $weeks1 = date('Y/m/d', strtotime("+7 day", $date));
            $date2 = strtotime($weeks1);
            $weeks2 = date('Y/m/d', strtotime("+7 day", $date2));
            $date3 = strtotime($weeks2);
            $weeks3 = date('Y/m/d', strtotime("+7 day",  $date3));
            $date4 = strtotime($weeks3);
            $weeks4 = date('Y/m/d', strtotime("+7 day", $date4));
            $date5 = strtotime($weeks4);
            $weeks5 = date('Y/m/d', strtotime("+7 day", $date5));

            $data['week1pig'] = $this->querymodel->week1pig($date_generate, $weeks1);
            $data['week2pig'] = $this->querymodel->week2pig($weeks1, $weeks2);
            $data['week3pig'] = $this->querymodel->week3pig($weeks2, $weeks3);
            $data['week4pig'] = $this->querymodel->week4pig($weeks3, $weeks4);
            $data['week5pig'] = $this->querymodel->week5pig($weeks4, $weeks5);
            $data['pigtotal'] = $this->querymodel->pigstotal($date_generate, $weeks5);
            $data['pigcarca'] = $this->querymodel->pigcarcass($date_generate, $weeks5);

            $data['week1cow'] = $this->querymodel->week1cow($date_generate, $weeks1);
            $data['week2cow'] = $this->querymodel->week2cow($weeks1, $weeks2);
            $data['week3cow'] = $this->querymodel->week3cow($weeks2, $weeks3);
            $data['week4cow'] = $this->querymodel->week4cow($weeks3, $weeks4);
            $data['week5cow'] = $this->querymodel->week5cow($weeks4, $weeks5);
            $data['cowtotal'] = $this->querymodel->cowstotal($date_generate, $weeks5);
            $data['cowcarca'] = $this->querymodel->cowcarcass($date_generate, $weeks5);

            $data['week1carabao'] = $this->querymodel->week1carabao($date_generate, $weeks1);
            $data['week2carabao'] = $this->querymodel->week2carabao($weeks1, $weeks2);
            $data['week3carabao'] = $this->querymodel->week3carabao($weeks2, $weeks3);
            $data['week4carabao'] = $this->querymodel->week4carabao($weeks3, $weeks4);
            $data['week5carabao'] = $this->querymodel->week5carabao($weeks4, $weeks5);
            $data['carabaototal'] = $this->querymodel->carabaostotal($date_generate, $weeks5);
            $data['carabaocarca'] = $this->querymodel->carbaocarcass($date_generate, $weeks5);

            $data['week1horse'] = $this->querymodel->week1horse($date_generate, $weeks1);
            $data['week2horse'] = $this->querymodel->week2horse($weeks1, $weeks2);
            $data['week3horse'] = $this->querymodel->week3horse($weeks2, $weeks3);
            $data['week4horse'] = $this->querymodel->week4horse($weeks3, $weeks4);
            $data['week5horse'] = $this->querymodel->week5horse($weeks4, $weeks5);
            $data['horsetotal'] = $this->querymodel->horsestotal($date_generate, $weeks5);
            $data['horsecarca'] = $this->querymodel->horsecarcass($date_generate, $weeks5);

            $data['week1others'] = $this->querymodel->week1others($date_generate, $weeks1);
            $data['week2others'] = $this->querymodel->week2others($weeks1, $weeks2);
            $data['week3others'] = $this->querymodel->week3others($weeks2, $weeks3);
            $data['week4others'] = $this->querymodel->week4others($weeks3, $weeks4);
            $data['week5others'] = $this->querymodel->week5others($weeks4, $weeks5);
            $data['totalothers'] = $this->querymodel->otherstotal($date_generate, $weeks5);
            $data['otherscarca'] = $this->querymodel->otherscarcass($date_generate, $weeks5);

            return view('adminview/admin-generateReport', $data);
        } else {
            return redirect()->to(base_url('admin'));
        }
    }
    public function activateMSO($id)
    {
        $data = [
            'MSO_id'        => $id,
            'status'    => 1,
        ];
        $check = $this->msomodel->save($data);
        if ($check) {
            $this->session->setFlashdata('Toast', 'User Activated');
            return redirect()->to(base_url('ManageMSO'));
        } else {
            $this->session->setFlashdata('Toast', 'User Activation Failed');
            return redirect()->to(base_url('ManageMSO'));
        }
    }
    public function deactivateMSO($id)
    {
        $data = [
            'MSO_id'        => $id,
            'status'    => 0,
        ];
        $check = $this->msomodel->save($data);
        if ($check) {
            $this->session->setFlashdata('Toast', 'User Deactivated');
            return redirect()->to(base_url('ManageMSO'));
        } else {
            $this->session->setFlashdata('Toast', 'User Activation Failed');
            return redirect()->to(base_url('ManageMSO'));
        }
    }

    public function activateInspector($id)
    {
        $data = [
            'Inspector_id'        => $id,
            'status'    => 1,
        ];
        $check = $this->inspectormodel->save($data);
        if ($check) {
            $this->session->setFlashdata('Toast', 'User Activated');
            return redirect()->to(base_url('ManageInspector'));
        } else {
            $this->session->setFlashdata('Toast', 'User Activation Failed');
            return redirect()->to(base_url('ManageInspector'));
        }
    }
    public function deactivateInspector($id)
    {
        $data = [
            'Inspector_id'        => $id,
            'status'    => 0,
        ];
        $check = $this->inspectormodel->save($data);
        if ($check) {
            $this->session->setFlashdata('Toast', 'User Deactivated');
            return redirect()->to(base_url('ManageInspector'));
        } else {
            $this->session->setFlashdata('Toast', 'User Activation Failed');
            return redirect()->to(base_url('ManageInspector'));
        }
    }


    public function activateTreasurer($id)
    {
        $data = [
            'Treasurer_id'        => $id,
            'status'    => 1,
        ];
        $check = $this->treasurermodel->save($data);
        if ($check) {
            $this->session->setFlashdata('Toast', 'User Activated');
            return redirect()->to(base_url('ManageTreasurer'));
        } else {
            $this->session->setFlashdata('Toast', 'User Activation Failed');
            return redirect()->to(base_url('ManageTreasurer'));
        }
    }
    public function deactivateTreasurer($id)
    {
        $data = [
            'Treasurer_id'        => $id,
            'status'    => 0,
        ];
        $check = $this->treasurermodel->save($data);
        if ($check) {
            $this->session->setFlashdata('Toast', 'User Deactivated');
            return redirect()->to(base_url('ManageTreasurer'));
        } else {
            $this->session->setFlashdata('Toast', 'User Activation Failed');
            return redirect()->to(base_url('ManageTreasurer'));
        }
    }
}
