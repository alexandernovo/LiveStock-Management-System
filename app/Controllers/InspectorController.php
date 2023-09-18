<?php

namespace App\Controllers;

class InspectorController extends BaseController
{
    public function __construct()
    {
        if (!session()->get('Inspector_username')) {
            echo 'Access Denied';
            exit;
        }
    }

    public function index()
    {
        $data = [
            'this_week_count'       => $this->querymodel->inspector_this_week_count(),
            'this_week_schedule'    => $this->querymodel->inspector_this_week(),
            'next_week'             => $this->querymodel->inspector_next_week(),
            'inspector_today'       => $this->querymodel->inspector_today(),
            'inspector_today_count' => $this->querymodel->inspector_today_count(),
            'next_week_count'       => $this->querymodel->inspector_next_week_count(),
            'all_sched_count'       => $this->querymodel->inspector_all_schedules_count(),
        ];
        return view('inspectorview/inspector-home', $data);
    }

    public function inspectorprofile()
    {
        $data['viewprofile'] = $this->inspectormodel->where('Inspector_id', $this->session->get('Inspector_id'))->findAll();
        return view('inspectorview/inspector-profile', $data);
    }

    public function changename()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-name-inspector'])) {
            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
            ];
            $errors = [
                'firstname' => [
                    'required' => 'This field is required',
                ],
                'lastname' => [
                    'required' => 'This field is required',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'Inspector_id' => $this->session->get('Inspector_id'),
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                ];
                $check = $this->inspectormodel->save($data);
                if ($check) {
                    session()->set($data);
                    $this->session->setFlashdata('success', 'Name Updated Successfully');
                    return redirect()->to(base_url('ManageProfileInspector'));
                } else {
                    $this->session->setFlashdata('failed', 'Name Update Failed');
                    return redirect()->to(base_url('MSOUpdatename'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('inspectorview/inspector-changename', $data);
            }
        }
        return view('inspectorview/inspector-changename', $data);
    }

    public function changeusername()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-username-inspector'])) {
            $rules = [
                'username' => 'required|min_length[5]|max_length[50]|is_unique[MSO.username]|is_unique[DAtreasurer.username]|is_unique[DAinspector.username]|is_unique[DAStaff.DAStaff_username]',
                'password' => 'required|validatePasswordInspector[password]',
            ];
            $errors = [
                'username' => [
                    'required' => 'This field is required',
                    'min_length' => 'Username must be atleast 5 characters long',
                    'max_length' => 'Username must not be more than 50 character',
                    'is_unique' => 'Username has been taken'
                ],
                'password' => [
                    'required' => 'This field is required',
                    'validatePasswordInspector' => 'Password is incorrect',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'Inspector_id' => $this->session->get('Inspector_id'),
                    'username' => $this->request->getPost('username'),
                ];
                $check = $this->inspectormodel->save($data);
                if ($check) {
                    session()->set('Inspector_username', $this->request->getPost('username'));
                    $this->session->setFlashdata('success', 'Username Updated Successfully');
                    return redirect()->to(base_url('ManageProfileInspector'));
                } else {
                    $this->session->setFlashdata('failed', 'Username Update Failed');
                    return redirect()->to(base_url('ManageProfileInspector'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('inspectorview/inspector-changeusername', $data);
            }
        }
        return view('inspectorview/inspector-changeusername', $data);
    }

    public function changecontact()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-contact-inspector'])) {
            $rules = [
                'contact' => 'required|min_length[13]|max_length[13]|regex_match[^(\+639)\d{9}$]',
                'password' => 'required|validatePasswordInspector[password]',
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
                    'validatePasswordInspector' => 'Password is incorrect',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $inspector_id = $this->session->get('Inspector_id');

                $data = [
                    'MSO_id' => $inspector_id,
                    'contact' => $this->request->getVar('contact'),
                ];
                $check = $this->inspectormodel->save($data);
                if ($check) {
                    session()->set('Inspector_contact', $this->request->getVar('contact'));
                    $this->session->setFlashdata('success', 'Contact Updated Successfully');
                    return redirect()->to(base_url('ManageProfileInspector'));
                } else {
                    $this->session->setFlashdata('failed', 'Contact Update Failed');
                    return redirect()->to(base_url('ManageProfileInspector'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('inspectorview/inspector-changecontact', $data);
            }
        }
        return view('inspectorview/inspector-changecontact', $data);
    }
    public function changeaddress()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-address-inspector'])) {
            $rules = [
                'Address' => 'required|min_length[4]',
            ];
            $errors = [
                'Address' => [
                    'required' => 'This field is required',
                    'min_length' => 'This Address is too short'
                ],
            ];
            if ($this->validate($rules, $errors)) {
                $data = [
                    'Inspector_id' => $this->session->get('Inspector_id'),
                    'address' => $this->request->getPost('Address'),
                ];
                $check = $this->inspectormodel->save($data);
                if ($check) {
                    session()->set('Inspector_address', $this->request->getPost('Address'));
                    $this->session->setFlashdata('success', 'Address Updated Successfully');
                    return redirect()->to(base_url('ManageProfileInspector'));
                } else {
                    $this->session->setFlashdata('failed', 'Address Update Failed');
                    return redirect()->to(base_url('ManageProfileInspector'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('inspectorview/inspector-changeaddress', $data);
            }
        }
        return view('inspectorview/inspector-changeaddress.php', $data);
    }
    public function changepassword()
    {
        $data = [];
        helper(['form']);
        if (isset($_POST['update-password-inspector'])) {
            $rules = [
                'currentpass' => 'required|validateCurrentPasswordInspector[currentpass]',
                'newpass' => 'required|min_length[5]|validateNewPasswordInspector[newpass]',
                'confirmnewpass' => 'matches[newpass]',
            ];
            $errors = [
                'currentpass' => [
                    'required' => 'This field is required',
                    'validateCurrentPasswordInspector' => 'Password is incorrect',
                ],
                'newpass' => [
                    'required' => 'This field is required',
                    'min_length' => 'Password is too short',
                    'validateNewPasswordInspector' => 'This is your current password'
                ],
                'confirmnewpass' => [
                    'matches' => 'New Password do not Match'
                ]
            ];
            if ($this->validate($rules, $errors)) {
                $password_hash = password_hash($this->request->getPost('newpass'), PASSWORD_DEFAULT);
                $data = [
                    'Inspector_id' => $this->session->get('Inspector_id'),
                    'password' => $password_hash,
                ];
                $check = $this->inspectormodel->save($data);
                if ($check) {
                    session()->set('Inspector_password', $password_hash);
                    $this->session->setFlashdata('success', 'Password Updated Successfully');
                    return redirect()->to(base_url('ManageProfileInspector'));
                } else {
                    $this->session->setFlashdata('failed', 'Password Update Failed');
                    return redirect()->to(base_url('ManageProfileInspector'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('inspectorview/inspector-changepassword', $data);
            }
        }
        return view('inspectorview/inspector-changepassword', $data);
    }

    public function viewsched()
    {
        $data['schedules'] = $this->querymodel->inspectorviewsched();
        return view('inspectorview/inspector-schedule', $data);
    }

    public function viewschedDates()
    {
        $data['schedules'] = $this->querymodel->inspector_schedule_group();
        return view('inspectorview/inspector-schedule1', $data);
    }
    public function viewschedperDate()
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
        $data['schedules'] = $this->querymodel->inspectorperDate($filter, $date_from, $date_to);
        return view('inspectorview/inspector-scheduleperDate', $data);
    }
    public function viewscheddetails($index_id, $MSO_id)
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
            'schedules' => $this->querymodel->inspectorviewscheddetails($index_id, $filter),
            'MSO'       => $this->msomodel->where('MSO_id', $MSO_id)->first(),
            'dateTime'  => $this->schedulemodel->where('index_id', $index_id)->first(),
            'index_id'  => $index_id,
            'MSO_id'    => $MSO_id
        ];
        return view('inspectorview/inspector-schedule-acceptreject', $data);
    }

    public function rejectsched($index_id, $inspectstatus_id, $MSO_id)
    {
        $status = "Rejected";
        $inspector_id = $this->session->get('Inspector_id');
        $inspect_reason = $this->request->getVar('reason');
        $data = [
            'inspectstatus_id' => $inspectstatus_id,
            'Inspector_id' => $inspector_id,
            'inspect_status' => $status,
            'inspect_reason' => $inspect_reason,
        ];
        $update = $this->inspectstatusmodel->save($data);
        if ($update) {
            $this->session->setFlashdata('success', 'Rejected Successfully');
            return redirect()->to(base_url('InspectorUpdateSchedule/' . $index_id . '/' . $MSO_id . '?filter=All'));
        } else {
            $this->session->setFlashdata('failed', 'Rejecting Failed');
            return redirect()->to(base_url('InspectorUpdateSchedule/' . $index_id . '/' . $MSO_id . '?filter=All'));
        }
    }

    public function acceptsched($index_id, $inspectstatus_id, $MSO_id)
    {
        $inspector_id = $this->session->get('Inspector_id');
        $status = "Accepted";
        $data = [
            'inspectstatus_id' => $inspectstatus_id,
            'Inspector_id' => $inspector_id,
            'inspect_status' => $status,
        ];
        $update = $this->inspectstatusmodel->save($data);

        $data2 = [
            'inspectstatus_id' => $inspectstatus_id,
            'payment_status' => 'Not Paid',
        ];

        $insert_payment = $this->paymentstatusmodel->save($data2);
        if ($update && $insert_payment) {
            $this->session->setFlashdata('success', 'Accepted Successfully');
            return redirect()->to(base_url('InspectorUpdateSchedule/' . $index_id . '/' . $MSO_id . '?filter=All'));
        } else {
            $this->session->setFlashdata('failed', 'Accepting Failed');
            return redirect()->to(base_url('InspectorUpdateSchedule/' . $index_id . '/' . $MSO_id . '?filter=All'));
        }
    }
    public function acceptSchedFirst($schedule_datetime, $index_id, $filter)
    {
        $update = $this->querymodel->AcceptFirst($index_id);
        if ($update) {
            $this->session->setFlashdata('success', 'Accepted Successfully');
            return redirect()->to(base_url('InspectorSchedulesperDate/' . $schedule_datetime . '?filter=' . $filter));
        } else {
            $this->session->setFlashdata('failed', 'Update Failed');
            return redirect()->to(base_url('InspectorSchedulesperDate/' . $schedule_datetime . '?filter=' . $filter));
        }
    }
    public function rejectSchedFirst($schedule_datetime, $index_id, $filter)
    {
        $update = $this->querymodel->rejectSchedFirst($index_id);
        if ($update) {
            $this->session->setFlashdata('success', 'Rejected Successfully');
            return redirect()->to(base_url('InspectorSchedulesperDate/' . $schedule_datetime . '?filter=' . $filter));
        } else {
            $this->session->setFlashdata('failed', 'RejectingFailed Failed');
            return redirect()->to(base_url('InspectorSchedulesperDate/' . $schedule_datetime . '?filter=' . $filter));
        }
    }
    // public function historyGroup()
    // {
    //     $data['history'] = $this->querymodel->inspector_history_group();
    //     return view('inspectorview/inspector-history-group', $data);
    // }
    public function history()
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
        $data = [
            'history' => $this->querymodel->inspector_history($filter, $date_from, $date_to),
        ];
        return view('inspectorview/inspector-history', $data);
    }
    public function history_details($MSO_id, $index_id)
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
            'history' => $this->querymodel->inspector_history_details($index_id, $filter),
            'user' => $this->msomodel->where('MSO_id', $MSO_id)->first(),
            'sched_date' => $this->schedulemodel->where('index_id', $index_id)->first(),
            'MSO_id' => $MSO_id,
            'inspector' => $this->inspectormodel->findAll(),
            'index_id' => $index_id
        ];
        return view('inspectorview/inspector-history-details', $data);
    }
}
