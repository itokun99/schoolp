<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pagesController extends Core_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model("UserModel");
		$this->load->model("NewsModel");
		$this->load->model("CommentModel");
		$this->load->model("ReplyModel");
	}
	
	public function check_user()
	{
		$userName = $this->session->userdata('userName');
		$userEmail = $this->session->userdata('userEmail');
		$loginFrom = $this->session->userdata('loginFrom');
		$getUser = $this->db->query("SELECT * FROM b_member WHERE email='$userEmail' AND publish ='1'");
		$status = $getUser->num_rows();
		if($status=="1")
		{
			$dataUser = $getUser->result_array();
			$data['userName'] = $userName;
			$data['userEmail'] = $userEmail;
			$data['loginFrom'] = $loginFrom;
			$data['dataUser'] = $dataUser;
			return $data;
		}
		else
		{
			$data['userName'] = "";
			$data['userEmail'] = "";
			$data['loginFrom'] = "";
			return $data;
		}
	}

	public function index()
	{
		$data = $this->check_user();
		$this->load->view('pages/index',$data);
	}

	public function call_news()
	{
		$data = $this->check_user();
		$getNews = $this->db->query("SELECT * FROM b_news");
		$dataNews = $getNews->result_array();
		$data['news'] = $dataNews;
		$this->load->view('pages/news',$data);
	}

	public function call_news_detail()
	{
		$data = $this->check_user();
		$getNews = $this->db->query("SELECT * FROM b_news");
		$dataNews = $getNews->result_array();
		$newsid = $this->input->get('id');
		$getNews = $this->db->query("SELECT * FROM b_news WHERE newsid = '$newsid'");
		$data['news'] = $getNews->result_array();
		$getComment = $this->db->query("SELECT *,DATE_FORMAT(b_comment.datez,'%d %M %Y (%h:%i %p)') as comment_date FROM b_comment 
		INNER JOIN b_member on b_comment.member_id = b_member.memberid
		WHERE news_id = '$newsid' AND comment_publish = '1'");
		$comments = $getComment->result();

		foreach($comments as $j => $comment)
		{
			$getReply = $this->db->query("SELECT *,DATE_FORMAT(b_comment_reply.datez,'%d %M %Y (%h:%i %p)') as reply_date FROM b_comment_reply 
			INNER JOIN b_member on b_comment_reply.member_id = b_member.memberid
			WHERE comment_id = '$comment->commentid' AND reply_status = '1'");
			$replys = $getReply->result();
			$comment->replys = $replys;

				foreach($replys as $d => $reply)
				{
					$getReplyLike = $this->db->query("SELECT * FROM b_news_like 
					WHERE reply_id = '$reply->replyid' AND like_type = '1' AND like_status = '0'");
					$like = $getReplyLike->result();
					$reply->liketotal = $like;

					$getReplyDislike = $this->db->query("SELECT * FROM b_news_like 
					WHERE reply_id = '$reply->replyid' AND like_type = '0' AND like_status = '0'");
					$dislike = $getReplyDislike->result();
					$reply->disliketotal = $dislike;
				}

			$getCommentLike = $this->db->query("SELECT * FROM b_news_like 
			WHERE comment_id = '$comment->commentid' AND like_type = '1' AND like_status = '1'");
			$like = $getCommentLike->result();
			$comment->liketotal = $like;

			$getCommentDislike = $this->db->query("SELECT * FROM b_news_like 
			WHERE comment_id = '$comment->commentid' AND like_type = '0' AND like_status = '1'");
			$dislike = $getCommentDislike->result();
			$comment->disliketotal = $dislike;
		}

		$data['comment'] = $comments;
		$this->load->view('pages/newsdetail',$data);
	}

	public function call_about()
	{
		$data = $this->check_user();
		$this->load->view('pages/about',$data);
	}

	public function call_kes()
	{
		$data = $this->check_user();
		$this->load->view('pages/kes',$data);
	}

	public function call_faq()
	{
		$data = $this->check_user();
		$this->load->view('pages/faq',$data);
	}

	public function call_register()
	{
		$data = $this->check_user();
		$this->load->view('pages/register',$data);
	}

	public function call_maps_search()
	{
		$data = $this->check_user();
		$this->load->view('pages/maps',$data);
	}

	public function call_forget_password()
	{
		$data = $this->check_user();
		$this->load->view('pages/forget-password',$data);
	}

	public function call_contact()
	{
		$data = $this->check_user();
		$this->load->view('pages/contact',$data);
	}

	public function call_setting_new_password()
	{
		$data['userName'] = "";
		$data['userEmail'] = "";
		$data['loginFrom'] = "";
		$email = $this->input->get('m');
		$uS = str_replace('_','/',$email);
		$res = str_replace(' ','+',$uS);
		$data['parameter'] = $res;
		$data['forgetEmail'] = $this->session->userdata('forget-email');
		$this->load->view('pages/setting-new-password',$data);
	}

	public function call_register_verification()
	{
		$data = $this->check_user();
		$this->load->view('pages/register-verification',$data);
	}

	public function call_user_profile()
	{
		$data = $this->check_user();
		$this->load->view('pages/profile',$data);
	}

	public function call_parent_update()
	{
		$data = $this->check_user();
		$this->load->view('pages/parent',$data);
	}
}
