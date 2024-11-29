<?php
namespace App\Controllers;
use App\Models\BoardModel;

class Board extends BaseController
{
    public function list(): string
    {
        /*
        $db = db_connect();
        $sql = "SELECT * FROM board ORDER BY bid DESC";
        $result = $db->query($sql);        
        $data['list'] = $result->getResult();//조회결과를 data에 할당
        */
        $boardModel = new BoardModel();
        $data['list'] = $boardModel->orderBy('bid', 'desc')->findAll();

        // return view('board_list');
        return render('board_list',$data);        
    }
    public function view($bid=null): string
    {
  
        /*
        $db = db_connect();
        $sql = "SELECT * FROM board WHERE bid=$bid";
        $result = $db->query($sql);        
        $data['view'] = $result->getRow();//조회결과를 data에 할당
        */
        $boardModel = new BoardModel();
        $data['view'] = $boardModel->where('bid', $bid)->first();
 
        return render('board_view',$data);        
    }
    public function modify($bid=null): string
    {  
  
        $boardModel = new BoardModel();
        $post = $boardModel->find($bid);
        
        if($post && session('userid') == $post->userid){
            $data['view'] = $post;
            return render('board_write',$data);        
        } else{
            return redirect()->to('/login')->with('alert', '본인글만 수정할 수 있습니다.');
        }
 
    }
    public function write()
    {
        if(!isset($_SESSION['userid'])){
            return redirect()->to('/login')->with('alert', '로그인해주세요');
        }    
        // return view('board_write');
        return render('board_write');
    }
    public function save()
    {
        /*
        $db = db_connect();
        $subject=$this->request->getVar('subject');
        $content=$this->request->getVar('content');

        $sql="insert into board (userid,subject,content) values ('test','$subject','$content')";
        $rs = $db->query($sql);        
        */
        $boardModel = new BoardModel();

        $data = [
            'userid' => 'admin',
            'subject'    => $this->request->getVar('subject'),
            'content'    => $this->request->getVar('content')
        ];
        $boardModel->insert($data);
        return $this->response->redirect(site_url('/board'));
    } 
}
