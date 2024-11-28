<?php
namespace App\Controllers;
use App\Models\MemberModel;

class Member extends BaseController
{
    public function login() 
    {
        return render('login');
    } 
    public function logout() 
    {

    } 
    public function loginok() 
    {
        $db = db_connect();
        $userid=$this->request->getVar('userid');
        $passwd=hash('sha512',$this->request->getVar('passwd'));

        $sql="SELECT * FROM members WHERE userid=? AND passwd = ?";
        $rs = $db->query($sql, [$userid, $passwd]);
        if($rs->getResultID()->num_rows > 0) {
            
        }
    } 
}
