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
    public function write(): string
    {
        // return view('board_write');
        return render('board_write');
    }
}
