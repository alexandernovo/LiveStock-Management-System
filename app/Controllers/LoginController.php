<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);
        $email = $this->request->getPost('username');
        if (isset($_POST['login-btn'])) {
            $data = [];
            helper(['form']);
            $rules = [
                'username' => 'required|validateUsername[username]|validateStatus[username]',
                'password' => 'required|validatePassword[username,password]',
            ];

            $errors = [
                'username' => [
                    'required'  => 'Username is required to login',
                    'validateUsername'  => 'Username does not exist',
                    'validateStatus'    => 'Your account is deactivated'
                ],
                'password' => [
                    'required'      => 'Password is required to login',
                    'validatePassword'  => 'Password is incorrect',
                ],

            ];
            if ($this->validate($rules, $errors)) {
                if ($admin = $this->dastaffmodel->where('DAStaff_username', $email)->first())/*Admin username match*/ {
                    // Set session values
                    $this->setDAStaffSession($admin);
                    $this->session->setFlashdata('msg', 'You have successfully login as Admin');
                    return redirect()->to(base_url('admin'));
                } else if ($mso = $this->msomodel->where('username', $email)->first()) {
                    $this->setMSOSession($mso);
                    $this->session->setFlashdata('msg', 'You have successfully login as Meat Shop Owner');
                    return redirect()->to(base_url('mso'));
                } else if ($inspector = $this->inspectormodel->where('username', $email)->first()) {
                    $this->setInspectorSession($inspector);
                    $this->session->setFlashdata('msg', 'You have successfully login as Inspector');
                    return redirect()->to(base_url('inspector'));
                } else if ($treasurer = $this->treasurermodel->where('username', $email)->first()) {
                    $this->setTreasurerSession($treasurer);
                    $this->session->setFlashdata('msg', 'You have successfully login as Treasurer');
                    return redirect()->to(base_url('treasurer'));
                }
            } else {
                $data['validation'] = $this->validator;
                return view('loginview/login', $data);
            }
        }
        return view('loginview/login', $data);
    }

    private function setDAStaffSession($admin)/*DASTAFF session*/
    {
        $data = [
            'Admin_id'          => $admin['DAStaff_id'],
            'Admin_firstname'   => $admin['DAStaff_firstname'],
            'Admin_lastname'    => $admin['DAStaff_lastname'],
            'Admin_username'    => $admin['DAStaff_username'],
            'Admin_password'    => $admin['DAStaff_password'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }

    private function setMSOSession($mso)/*MSO session*/
    {
        $data = [
            'Admin_id'        => $mso['DAStaff_id'],
            'MSO_id'          => $mso['MSO_id'],
            'MSO_firstname'   => $mso['firstname'],
            'MSO_lastname'    => $mso['lastname'],
            'MSO_username'    => $mso['username'],
            'MSO_password'    => $mso['password'],
            'MSO_contact'     => $mso['password'],
            'MSO_address'     => $mso['password'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }

    private function setInspectorSession($inspector)/*Inspector session*/
    {
        $data = [
            'Admin_id'              => $inspector['DAStaff_id'],
            'Inspector_id'          => $inspector['Inspector_id'],
            'Inspector_firstname'   => $inspector['firstname'],
            'Inspector_lastname'    => $inspector['lastname'],
            'Inspector_username'    => $inspector['username'],
            'Inspector_password'    => $inspector['password'],
            'Inspector_contact'     => $inspector['contact'],
            'Inspector_address'     => $inspector['address'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }

    private function setTreasurerSession($treasurer)/*Inspector session*/
    {
        $data = [
            'Admin_id'              => $treasurer['DAStaff_id'],
            'Treasurer_id'          => $treasurer['Treasurer_id'],
            'Treasurer_firstname'   => $treasurer['firstname'],
            'Treasurer_lastname'    => $treasurer['lastname'],
            'Treasurer_username'    => $treasurer['username'],
            'Treasurer_password'    => $treasurer['password'],
            'Treasurer_contact'     => $treasurer['contact'],
            'Treasurer_address'     => $treasurer['address'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function forgotpassword()
    {
        helper(['form']);
        $data = [];
        if (isset($_POST['finds'])) {
            $username = $this->request->getPost('username');
            $rules = [
                'username' => 'required|validateUsername[username]',
            ];
            $errors = [
                'username' => [
                    'required'              => 'This field is required',
                    'validateUsername'      =>  'Username does not exist'
                ],
            ];
            if ($this->validate($rules, $errors)) {
                if ($this->dastaffmodel->where('DAStaff_username', $this->request->getPost('username'))->first()) {
                    $data['admin'] = 'This account is not for retrieving';
                    return view('forgotpasswordview/forgotpassword', $data);
                } else if ($user = $this->msomodel->where('username', $this->request->getPost('username'))->first()) {
                    $Contact = $user['contact'];
                    $userGet = $user['firstname'] . ' ' . $user['lastname'];
                    $myRandomString = $this->generateRandom(5);
                    if ($this->isOnline()) {
                        $send = $this->sendVerification($myRandomString, $Contact, $userGet);
                        if ($send) {
                            $username = $user['username'];
                            $Name = $user['firstname'] . ' ' . $user['lastname'];
                            $encode = base64_encode($myRandomString);
                            return redirect()->to('find/' . $username . '/' . $Name . '/' . $Contact . '/' . $encode);
                        } else {
                            $data['failed'] = "No Internet Connection";
                            return view('forgotpasswordview/forgotpassword', $data);
                        }
                    } else {
                        $data['failed'] = "No Internet Connection";
                        return view('forgotpasswordview/forgotpassword', $data);
                    }
                } else if ($user = $this->inspectormodel->where('username', $this->request->getPost('username'))->first()) {
                    $Contact = $user['contact'];
                    $userGet = $user['firstname'] . ' ' . $user['lastname'];
                    $myRandomString = $this->generateRandom(5);
                    if ($this->isOnline()) {
                        $send = $this->sendVerification($myRandomString, $Contact, $userGet);
                        if ($send) {
                            $username = $user['username'];
                            $Name = $user['firstname'] . ' ' . $user['lastname'];
                            $encode = base64_encode($myRandomString);
                            return redirect()->to('find/' . $username . '/' . $Name . '/' . $Contact . '/' . $encode);
                        } else {
                            $data['failed'] = "No Internet Connection";
                            return view('forgotpasswordview/forgotpassword', $data);
                        }
                    } else {
                        $data['failed'] = "No Internet Connection";
                        return view('forgotpasswordview/forgotpassword', $data);
                    }
                } else if ($user = $this->treasurermodel->where('username', $this->request->getPost('username'))->first()) {
                    $Contact = $user['contact'];
                    $userGet = $user['firstname'] . ' ' . $user['lastname'];
                    $myRandomString = $this->generateRandom(5);
                    if ($this->isOnline()) {
                        $send = $this->sendVerification($myRandomString, $Contact, $userGet);
                        if ($send) {
                            $username = $user['username'];
                            $Name = $user['firstname'] . ' ' . $user['lastname'];
                            $encode = base64_encode($myRandomString);
                            return redirect()->to('find/' . $username . '/' . $Name . '/' . $Contact . '/' . $encode);
                        } else {
                            $data['failed'] = "No Internet Connection";
                            return view('forgotpasswordview/forgotpassword', $data);
                        }
                    } else {
                        $data['failed'] = "No Internet Connection";
                        return view('forgotpasswordview/forgotpassword', $data);
                    }
                }
            } else {
                $data['validation'] = $this->validator;
                return view('forgotpasswordview/forgotpassword', $data);
            }
        }
        return view('forgotpasswordview/forgotpassword', $data);
    }
    private function generateRandom($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function verifycode($username, $Name, $Contact, $encode)
    {
        $decode = base64_decode($encode);
        $data['username'] = $username;
        $data['Name'] =  $Name;
        $data['Contact'] = $Contact;
        $data['Code'] = $decode;
        if (isset($_POST['verify'])) {
            if ($this->request->getPost('verification') == $this->request->getPost('code')) {
                return redirect()->to('updatepasswordforgot/' . $username . '/' . $Name);
            } else {
                $data['wrongcode'] = "You enter the wrong verification code";
                return view('forgotpasswordview/find', $data);
            }
        }
        return view('forgotpasswordview/find', $data);
    }
    private function sendVerification($myRandomString, $Contact, $userGet)
    {
        $header = "Livestock Slaughter House Management System - Password Reset Verification Code";
        $body = "Dear {$userGet},\n\nWe have received a request to reset your password for your Livestock Slaughter House Management System account. To proceed with the password reset, please enter the following verification code on the password reset page: {$myRandomString}.\n\nIf you did not request a password reset, please ignore this message.";
        $mesg = "{$header}\n\n{$body}";
        $message = $this->twilio->messages->create(
            $Contact, // Text this number
            [
                'from' => '+19896584863', // From a valid Twilio number
                'body' =>  $mesg
            ]
        );
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
    public function updatepassword($username, $Name)
    {
        $data['username'] = $username;
        $data['Name'] = $Name;
        if (isset($_POST['change'])) {
            $rules = [
                'newpassword'               => 'required|min_length[5]',
                'confirmnewpassword'        => 'matches[newpassword]',
            ];
            $errors = [
                'newpassword'       => [
                    'required'      => 'This field is required',
                    'min_length'    => 'This is a weak password'
                ],
                'confirmnewpassword' => [
                    'matches'      => 'Password do not match!',
                ],
            ];
            if ($this->validate($rules, $errors)) {
                if ($user = $this->msomodel->where('username', $this->request->getPost('username'))->first()) {
                    $data = [
                        'MSO_id'          => $user['MSO_id'],
                        'password'    => password_hash($this->request->getPost('newpassword'), PASSWORD_DEFAULT),
                    ];
                    $check = $this->msomodel->save($data);
                    if ($check) {
                        $this->session->setFlashdata('success', 'Password Updated Successfully');
                        return redirect()->to(base_url('login'));
                    } else {
                        $data['faileds'] = 'Password Update Failed';
                        return view('forgotpasswordview/newpassword', $data);
                    }
                } else if ($user = $this->inspectormodel->where('username', $this->request->getPost('username'))->first()) {
                    $data = [
                        'Inspector_id'          => $user['Inspector_id'],
                        'password'    => password_hash($this->request->getPost('newpassword'), PASSWORD_DEFAULT),
                    ];
                    $check = $this->inspectormodel->save($data);
                    if ($check) {
                        $this->session->setFlashdata('success', 'Password Updated Successfully');
                        return redirect()->to(base_url('login'));
                    } else {
                        $data['faileds'] = 'Password Update Failed';
                        return view('forgotpasswordview/newpassword', $data);
                    }
                } else if ($user = $this->treasurermodel->where('username', $this->request->getPost('username'))->first()) {
                    $data = [
                        'Treasurer_id'       => $user['Treasurer_id'],
                        'password'           => password_hash($this->request->getPost('newpassword'), PASSWORD_DEFAULT),
                    ];
                    $check = $this->treasurermodel->save($data);
                    if ($check) {
                        $this->session->setFlashdata('success', 'Password Updated Successfully');
                        return redirect()->to(base_url('login'));
                    } else {
                        $data['faileds'] = 'Password Update Failed';
                        return view('forgotpasswordview/newpassword', $data);
                    }
                }
            } else {
                $data['validation'] = $this->validator;
                return view('forgotpasswordview/newpassword', $data);
            }
        }
        return view('forgotpasswordview/newpassword', $data);
    }
}
