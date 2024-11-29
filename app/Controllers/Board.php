<?php
namespace App\Controllers;
use App\Models\BoardModel;
use App\Models\FileModel;

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
    public function delete($bid=null)
    {  
  
        $boardModel = new BoardModel();
        $post = $boardModel->find($bid);

        if($post && session('userid') == $post->userid){
            $boardModel->delete($bid);     
            return redirect()->to('/board');
        } else{
            return redirect()->to('/login')->with('alert', '본인글만 삭제할 수 있습니다.');
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
        $boardModel = new BoardModel();
        $fileModel = new FileModel();

        $data = [
            // 'userid' => 'admin',
            'userid' => $_SESSION['userid'],
            'subject'    => $this->request->getVar('subject'),
            'content'    => $this->request->getVar('content')
        ];
        $bid = $this->request->getVar('bid');
        $file = $this->request->getFile('upfile');

        $db = db_connect();

        if($file->getName()) { //첨부파일이 있으면
            $filename = $file->getName(); //파일명
            $newName = $file->getRandomName();//서버에 저장할 파일명 생성
            $filePath = $file->store('board/',$newName);
        }

        if($bid){ //기존글 수정
            $post = $boardModel->find($bid);
            if($post && session('userid') == $post->userid){
                $boardModel->update($bid, $data);
                return $this->response->redirect(site_url('/boardView/'.$bid));     
            } else{
                return redirect()->to('/login')->with('alert', '본인글만 수정할 수 있습니다.');
            }
            

        }else{ //새글 입력
            $boardModel->insert($data);
            $insertId = $db->insertID(); //board 테이블에 새글 입력시 자동으로 생성되는 bid

            $fileData = [
                // 'userid' => 'admin',
                'bid' => $insertId,
                'userid' => $_SESSION['userid'],
                'filename'    => $filePath,
                'type'    => 'board'
            ];
            $fileModel->insert($fileData);

            return $this->response->redirect(site_url('/board'));
        }

    } 
}
