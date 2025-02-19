<?php
  
  	function re_check_account()
	{
		if(!$_SESSION['applicant'])
		{				
			$_SESSION['login']['option']	=	true;
			header_location('/page/');		
		}
		else
		{
			
			$post['email'] 			=	$_SESSION['applicant']['applicant_email'];
			$post['password']		= 	$_SESSION['applicant']['applicant_password'];
			$data 					= 	mvc_model('model.applicant')->select_login($post,false);
			if($data ==2)
			{
				unset($_SESSION['applicant']);
				mvc_library('session.message')->message('Account Error.', 'It seems your account has been deactivated, Please contact us to further asses your problem.');
				header_location('/page/');
			}
			elseif(!$data)
			{
				unset($_SESSION['applicant']);
				$_SESSION['login']['option']	=	true;
				header_location('/page/');	
			}
			else
			{
				
			}		
		}	
	}
	
	
	function create_applicant_profile_link($app_data)
	{		
		if($app_data)
		{
			$name_link					=	string_space_underscore($app_data['applicant_name']);
	    	$surname_link				=	string_space_underscore($app_data['applicant_surname']);	
	    	$resume_link				=	'/page/profile/'.$app_data['applicant_id'].'/'.$name_link.'.'.$surname_link;
		}
		else
		{
			$resume_link				=	'/page';
		}
		
		return 	$resume_link;
		
	}
	
	
	function create_company_profile_link($emp_data,$spec_id=0)
	{
			
		if($emp_data)
		{
			$prof_link  =	'/page/profile/company_profile/'.$emp_data['employer_id'].'/'.$spec_id.'/'.string_custom_encode(string_space_underscore($emp_data['employer_name'])).'/';
		}
		else
		{
			$prof_link				=	'/page';
		}
		
		return 	$prof_link;
		
	}
	
	
	function create_follow_butt_home($employer_id)
	{
		if($_SESSION['applicant'])
		{				
			$is_follow				=	mvc_model('model.employer.follower')->check_follower($employer_id,$_SESSION['applicant']['applicant_id']);	
			$return					= ($is_follow)	? '<a class="float_left mar_left_20 mar_top_5" onclick="unfollow_company('.$is_follow['employer_follower_id'].')">Following</a>' : '<a class="float_left mar_left_20 mar_top_5" onclick="follow_company('.$employer_id.')">+ Follow Company</a>';
														
		}
		else
		{
			
			$return								=  '<a class="float_left mar_left_20 mar_top_5" href="/page/follow_company">+ Follow Company</a>';		
		}	
		
		return $return;
	}
	
	