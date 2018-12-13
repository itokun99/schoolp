<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newsController extends Core_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model("UserModel");
        $this->load->model("NewsModel");
        $this->load->model("CommentModel");
        $this->load->model("ReplyModel");
        $this->load->model("NewsLikeModel");
	}
    
    public function insertComment()
    {
        $newsId = $this->input->post('newsId');
        $newsComment = $this->input->post('newsComment');
        $datez = date('Y-m-d H:i:s');
        $userEmail = $this->session->userdata('userEmail');
        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $memberId = $member->memberid;
        $ins_db = array(
            'news_id' => $newsId,
            'comment_desc' => $newsComment,
            'comment_publish' => 1,
            'datez' => $datez,
            'member_id' => $memberId,
        );
        $ins_query_db = $this->CommentModel->save($ins_db);
        if($ins_query_db)
        {
            redirect('newsdetail?id='.$newsId);
        }
    }
    
    public function deleteComment()
    {   
        $newsId = $this->input->post('newsId');
        $commentId = $this->input->post('commentId');
        $del_query_db = $this->ReplyModel->delete(array('comment_id' => $commentId));
        $del_query_db2 = $this->CommentModel->delete(array('commentid' => $commentId,'news_id' => $newsId));
        $data = "sukses";
        echo json_encode($data);
    }

    public function deleteReply()
    {   
        $replyId = $this->input->post('replyId');
        $del_query_db = $this->ReplyModel->delete(array('replyid' => $replyId));
        $data = "sukses";
        echo json_encode($data);
    }

    public function insertLikeComment()
    {
        $newsId = $this->input->post('newsId');
        $commentId = $this->input->post('commentId');
        $datez = date('Y-m-d H:i:s');
        $userEmail = $this->session->userdata('userEmail');
        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $memberId = $member->memberid;
        $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE member_id = '$memberId' AND comment_id = '$commentId' AND like_status = '1'"); 
        $status = $checkLike->num_rows();
        if($status>0)
        {
            $statusLike = $checkLike->result_array();
            $likeOrDislike = $statusLike[0]['like_type'];
            if($likeOrDislike == 1){
                $data = "ERLIK001";
                echo json_encode($data);
            }else{
                $upt_db = array(
                    'like_type' => 1
                );
                $upd_query_db = $this->NewsLikeModel->save($upt_db, array('member_id' => $memberId,'comment_id' => $commentId, 'like_status' => 1));
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }  
        }
        else
        {
            $ins_db = array(
                'like_type' => 1,
                'like_status' => 1,
                'comment_id' => $commentId,
                'news_id' => $newsId,
                'datez' => $datez,
                'member_id' => $memberId
            );
            $ins_query_db = $this->NewsLikeModel->save($ins_db);
            if($ins_query_db)
            {
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }
        }
    }

    public function insertDislikeComment()
    {
        $newsId = $this->input->post('newsId');
        $commentId = $this->input->post('commentId');
        $datez = date('Y-m-d H:i:s');
        $userEmail = $this->session->userdata('userEmail');
        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $memberId = $member->memberid;
        $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE member_id = '$memberId' AND comment_id = '$commentId' AND like_status = '1'"); 
        $status = $checkLike->num_rows();
        if($status>0)
        {
            $statusLike = $checkLike->result_array();
            $likeOrDislike = $statusLike[0]['like_type'];
            if($likeOrDislike == 0){
                $data = "ERDIS001";
                echo json_encode($data);
            }else{
                $upt_db = array(
                    'like_type' => 0
                );
                $upd_query_db = $this->NewsLikeModel->save($upt_db, array('member_id' => $memberId,'comment_id' => $commentId, 'like_status' => 1));
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }  
        }
        else
        {
            $ins_db = array(
                'like_type' => 1,
                'like_status' => 1,
                'comment_id' => $commentId,
                'news_id' => $newsId,
                'datez' => $datez,
                'member_id' => $memberId
            );
            $ins_query_db = $this->NewsLikeModel->save($ins_db);
            if($ins_query_db)
            {
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE comment_id = '$commentId' AND like_status = '1' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }
        }
    }

    public function insertReply()
    {
        $newsId = $this->input->post('newsId');
        $commentId = $this->input->post('commentId');
        $replyComment = $this->input->post('replyComment');
        $datez = date('Y-m-d H:i:s');
        $userEmail = $this->session->userdata('userEmail');
        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $memberId = $member->memberid;
        $ins_db = array(
            'comment_id' => $commentId,
            'reply_message' => $replyComment,
            'reply_status' => 1,
            'datez' => $datez,
            'member_id' => $memberId,
        );
        $ins_query_db = $this->ReplyModel->save($ins_db);
        if($ins_query_db)
        {
            redirect('newsdetail?id='.$newsId);
        }
    }
    
    public function insertLikeReply()
    {
        $newsId = $this->input->post('newsId');
        $replyId = $this->input->post('replyId');
        $datez = date('Y-m-d H:i:s');
        $userEmail = $this->session->userdata('userEmail');
        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $memberId = $member->memberid;
        $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE member_id = '$memberId' AND reply_id = '$replyId' AND like_status = '0'"); 
        $status = $checkLike->num_rows();
        if($status>0)
        {
            $statusLike = $checkLike->result_array();
            $likeOrDislike = $statusLike[0]['like_type'];
            if($likeOrDislike == 1){
                $data = "ERLIK001";
                echo json_encode($data);
            }else{
                $upt_db = array(
                    'like_type' => 1
                );
                $upd_query_db = $this->NewsLikeModel->save($upt_db, array('member_id' => $memberId,'reply_id' => $replyId, 'like_status' => 0));
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }  
        }
        else
        {
            $ins_db = array(
                'like_type' => 1,
                'like_status' => 0,
                'reply_id' => $replyId,
                'news_id' => $newsId,
                'datez' => $datez,
                'member_id' => $memberId
            );
            $ins_query_db = $this->NewsLikeModel->save($ins_db);
            if($ins_query_db)
            {
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }
        }
    }

    public function insertDislikeReply()
    {
        $newsId = $this->input->post('newsId');
        $replyId = $this->input->post('replyId');
        $datez = date('Y-m-d H:i:s');
        $userEmail = $this->session->userdata('userEmail');
        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $memberId = $member->memberid;
        $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE member_id = '$memberId' AND reply_id = '$replyId' AND like_status = '0'"); 
        $status = $checkLike->num_rows();
        if($status>0)
        {
            $statusLike = $checkLike->result_array();
            $likeOrDislike = $statusLike[0]['like_type'];
            if($likeOrDislike == 0){
                $data = "ERDIS001";
                echo json_encode($data);
            }else{
                $upt_db = array(
                    'like_type' => 0
                );
                $upd_query_db = $this->NewsLikeModel->save($upt_db, array('member_id' => $memberId,'reply_id' => $replyId, 'like_status' => 0));
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }  
        }
        else
        {
            $ins_db = array(
                'like_type' => 0,
                'like_status' => 0,
                'reply_id' => $replyId,
                'news_id' => $newsId,
                'datez' => $datez,
                'member_id' => $memberId
            );
            $ins_query_db = $this->NewsLikeModel->save($ins_db);
            if($ins_query_db)
            {
                $checkLike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '1'"); 
                $totalLike = $checkLike->num_rows();
                $checkDislike = $this->db->query("SELECT * FROM b_news_like WHERE reply_id = '$replyId' AND like_status = '0' AND like_type = '0'"); 
                $totalDislike = $checkDislike->num_rows();
                $data['totalLike'] = $totalLike;
                $data['totalDislike'] = $totalDislike;
                echo json_encode($data);
            }
        }
    }

    public function getReplyInformation()
    {
        $replyId = $this->input->get('replyId');
        $getReplyData = $this->db->query("SELECT * FROM b_comment_reply 
        INNER JOIN b_member on b_comment_reply.member_id = b_member.memberid 
        WHERE replyid = '$replyId'");
        $replyData = $getReplyData->result_array();
        $data = $replyData;
        echo json_encode($data);
    }
}
