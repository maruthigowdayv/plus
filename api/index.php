<?php

error_reporting(E_ALL & ~E_NOTICE);

header('Content-Type: application/json');

$json = json_decode(file_get_contents('php://input'), true);

date_default_timezone_set('Asia/Kolkata');$timestamp=date('Y-m-d h:i:s A');

$con = mysqli_connect('localhost', 'ajiomi54_jcpdev', 'r1Jq@JTQ^A6$*[f,(T', 'ajiomi54_jcp_plus_prod'); if(mysqli_connect_errno()){echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => 'Our database application is down for maintenance. Please wait for 15 minutes and retry.')); exit;}

$device=$json["device"];$version=$json["version"];$todo=$json["todo"];

if(!$device||!$version||!$todo){echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => 'We couldn\'t recognise your request. Contact PLUS support team to fix this issue.')); mysqli_close($con); exit;}
if($device != 'browser' && $device != 'android' && $device != 'ios'){echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => 'We couldn\'t recognise your device. Contact PLUS support team to fix it.')); mysqli_close($con); exit;}
if($version != '2.0.0'){echo json_encode(array('todo' => 'goto', 'goto' => '/update/')); mysqli_close($con); exit;}

$super_admin_name='Maruthi Gowda';$super_admin_email='ygowda@jcp.com';
$admin_name='Nitesh S U';$admin_email='numesh@jcp.com';




//echo json_encode(array(aaa => $super_admin_email));exit;







if($todo == 'create_passcode'){

	$san = $json['san'];$email = $json['email'];$phone = $json['phone'];
	
	$user_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT status FROM users WHERE (san='$san' OR email='$email' OR phone='$phone') LIMIT 1"));
	
	if($user_chk){
		$user_chk_title = 'Don\'t hurry, Don\'t worry!';$user_chk_message='Our support team is already processing your passcode creation request.';
		if($user_chk['status'] == 'Active'){$user_chk_title='Why did you do this?';$user_chk_message='Your passcode has already been created and it is in use. If you have forgotten your passcode, you can recover it.';}
		else if($user_chk['status'] == 'Disabled'){$user_chk_title='Sorry!';$user_chk_message='Your passcode has been disabled. Contact PLUS support team to fix it.';}
		else if($user_chk['status'] == 'Blocked'){$user_chk_title='Sorry!';$user_chk_message='Your passcode has been blocked. Contact PLUS support team to fix it.';}
		echo json_encode(array('todo' => 'alert_goto', 'title' => $user_chk_title, 'message' => $user_chk_message, 'goto' => '/passcode/')); mysqli_close($con); exit;
	}

	$task_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT status FROM tasks WHERE title = 'Create passcode' AND todos LIKE '%$email%' ORDER BY id DESC LIMIT 1"));

	if($task_chk){
		$task_chk_title='Sorry!';$task_chk_message='Our support team is already processing your passcode creation request.';
		if($task_chk['status'] != 'Closed'){$task_chk_title='Don\'t hurry, Don\'t worry!';$task_chk_message='Our support team is already processing your passcode creation request.';}
		echo json_encode(array('todo' => 'alert_goto', 'title' => $task_chk_title, 'message' => $task_chk_message, 'goto' => '/passcode/')); mysqli_close($con); exit;
	}

	if(mysqli_query($con, "INSERT INTO tasks(timestamp_created, number_of_opens, assigned_by_name, assigned_by_email, assigned_to_name, assigned_to_email, title, todos, timestamp_expected_completion, state, status) VALUES ('$timestamp', '0', '$super_admin_name', '$super_admin_email', '$admin_name', '$admin_email', 'Create passcode', '<small>Employee number</small><br>$san<br><small>Email address</small><br>$email<br><small>Phone number</small><br>$phone', '".date('Y-m-d H:i:s A', strtotime($timestamp.' +1 day '))."', 'Pending')")){
		echo json_encode(array('todo' => 'alert_goto', 'title' => 'Congratulations!', 'message' => 'We have received your passcode creation request. Our support team will contact you for more details.', 'goto' => '/passcode/'));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
	
	mysqli_close($con);
	exit;
}






else if($todo == 'recover_passcode'){

	$san = $json['san'];$email = $json['email'];$phone = $json['phone'];
	
	$user_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT status FROM users WHERE (san='$san' OR email='$email' OR phone='$phone') LIMIT 1"));
	
	if(!$user_chk){
		echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => 'We couldn\'t find any passcode associated with your email address.')); mysqli_close($con); exit;
	} else {
		if($user_chk['status'] == 'Disabled'){echo json_encode(array('todo' => 'alert_goto', 'title' => 'Sorry!', 'message' => 'Your passcode has been disabled. Contact PLUS support team to fix it.', 'goto' => '/passcode/')); mysqli_close($con); exit;}
		else if($user_chk['status'] == 'Blocked'){echo json_encode(array('todo' => 'alert_goto', 'title' => 'Sorry!', 'message' => 'Your passcode has been blocked. Contact PLUS support team to fix it.', 'goto' => '/passcode/')); mysqli_close($con); exit;}
		else if($user_chk['status'] == 'Active'){

		$task_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT status FROM tasks WHERE title = 'Reset passcode' AND todos LIKE '%$email%' ORDER BY id DESC LIMIT 1"));

		if($task_chk){
			$task_chk_title='Don\'t hurry, Don\'t worry!';$task_chk_message='Our support team is already processing your passcode recovery request.';
			if($task_chk['status'] != 'Closed'){$task_chk_title='Don\'t hurry, Don\'t worry!';$task_chk_message='Our support team is already processing your passcode recovery request.';}
			echo json_encode(array('todo' => 'alert_goto', 'title' => $task_chk_title, 'message' => $task_chk_message, 'goto' => '/passcode/')); mysqli_close($con); exit;
		}

		if(mysqli_query($con, "INSERT INTO tasks(timestamp_created, number_of_opens, assigned_by_name, assigned_by_email, assigned_to_name, assigned_to_email, title, todos, timestamp_expected_completion, state, status) VALUES ('$timestamp', '0', '$super_admin_name', '$super_admin_email', '$admin_name', '$admin_email', 'Reset passcode', '<small>Employee number</small><br>$san<br><small>Email address</small><br>$email<br><small>Phone number</small><br>$phone', '".date('Y-m-d H:i:s A', strtotime($timestamp.' +1 day '))."', 'Pending')")){
			echo json_encode(array('todo' => 'alert_goto', 'title' => 'Congratulations!', 'message' => 'We have received your passcode recovery request. New passcode will be sent to you shortly.', 'goto' => '/passcode/'));
		} else {
			echo json_encode(array('todo' => 'retry'));
		}
		
		}
		mysqli_close($con);
		exit;
	}
}

















else if($todo == 'get_passcode'){

	$passcode = $json['passcode'];

	$user_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE passcode='$passcode' LIMIT 1"));

	if(!$user_chk){
		echo json_encode(array('todo' => 'alert_next', 'title' => 'Sorry!', 'message' => 'That was an invalid passcode. Retry or recover your passcode.', 'next' => 'get_passcode__failed', 'arguments' => '')); mysqli_close($con); exit;
	} else {
		if($user_chk['status'] == 'Disabled'){echo json_encode(array('todo' => 'alert_next', 'title' => 'Sorry!', 'message' => 'Your passcode has been disabled. Contact PLUS support team to fix it.', 'next' => 'authentication_failed', 'arguments' => '')); mysqli_close($con); exit;}
		else if($user_chk['status'] == 'Blocked'){echo json_encode(array('todo' => 'alert_next', 'title' => 'Sorry!', 'message' => 'Your passcode has been blocked. Contact PLUS support team to fix it.', 'next' => 'authentication_failed', 'arguments' => '')); mysqli_close($con); exit;}
		else if($user_chk['status'] == 'Active'){

		$session =  bin2hex(openssl_random_pseudo_bytes(22)) . '@' . $timestamp;

		$settings = $user_chk['settings'];

		$active_devices = '';
		if($user_chk['session_browser']!=''||$device=='browser'){$active_devices.='Browser: '.($user_chk['session_browser_count'] == 0 ? 1 . ' Login|' : $user_chk['session_browser_count'] . ' Logins|');}
		if($user_chk['session_android']!=''||$device=='android'){$active_devices.='Android: '.($user_chk['session_android_count'] == 0 ? 1 . ' Login|' : $user_chk['session_android_count'] . ' Logins|' );}
		if($user_chk['session_ios']!=''||$device=='ios'){$active_devices.='iPhone: '.($user_chk['session_ios_count'] == 0 ? 1 . ' Login|' : $user_chk['session_ios_count'] . ' Logins|' );}
		
		$warrior = array('id' => $user_chk['id'], 'san' => $user_chk['san'], 'name' => $user_chk['name'], 'gender' => $user_chk['gender'], 'designation' => $user_chk['designation'], 'team' => $user_chk['team'], 'reporting_to_name' => $user_chk['reporting_to_name'], 'reporting_to_email' => $user_chk['reporting_to_email'], 'workstation' => $user_chk['workstation'], 'email' => $user_chk['email'], 'gmail' => $user_chk['gmail'], 'phone' => $user_chk['phone'], 'access_level' => $user_chk['access_level'], 'access_modules' => $user_chk['access_modules'], 'about_me' => $user_chk['about_me'], 'my_golden_rule' => $user_chk['my_golden_rule'], 'active_devices' => rtrim($active_devices, '|'), 'last_seen' => date('l, jS M Y, h:i A', strtotime($timestamp)));

		$tasks = array();
 
		if($result = mysqli_query($con, "SELECT * FROM tasks WHERE (assigned_to_email='".$user_chk['email']."' OR assigned_by_email='".$user_chk['email']."') AND timestamp_deleted='' AND timestamp_last_opened='' ORDER BY timestamp_created ASC LIMIT 100")){
			while ($row = mysqli_fetch_assoc($result)){
				unset($row['work_progress_comments']);
				unset($row['timestamp_deleted']);
				$tasks[] = $row;
			}
			$result->free();
		}
 
		$notifications = array();
		
		$team = explode('>', $user_chk['team']);

		if($result = mysqli_query($con, "SELECT id, timestamp_created, creator, title, notification FROM notifications WHERE (recipients LIKE '%".$user_chk['email']."%' OR recipients LIKE '%".trim($team[2])."%') AND (details NOT LIKE '%".$user_chk['email']."%') ORDER BY timestamp_created DESC")){
			while ($row = mysqli_fetch_assoc($result)){
				$row['state']='Unread';
				$notifications[] = $row;
			}
			$result->free();
		}

		$quote = '';

		if($result = mysqli_query($con, "SELECT * FROM quotes WHERE timestamp_scheduled_for=(SELECT MAX(timestamp_scheduled_for) FROM quotes) LIMIT 1")){
			while ($row = mysqli_fetch_assoc($result)){
				$quote = $row;
			}
			$result->free();
		}

		if(mysqli_query($con, "UPDATE users SET session_".$device."='$session', session_".$device."_count=session_".$device."_count+1 WHERE passcode='$passcode'")){

			$arguments = array('config' => array('file_server' => 'https://www.jcpenney.tech/file/'), 'passcode' => array('hash' => $session), 'settings' => json_decode($settings), 'warrior' => $warrior, 'tasks' => $tasks, 'notifications' => $notifications, 'quote' => $quote, 'dashboard_filters_and_views__product_enrichment' => json_decode($user_chk['dashboard_filters_and_views_product_enrichment']), 'dashboard_filters_and_views__image_enrichment' => json_decode($user_chk['dashboard_filters_and_views_image_enrichment']), 'dashboard_filters_and_views__plano_assistance' => json_decode($user_chk['dashboard_filters_and_views_plano_assistance']) );

			if(strpos($user_chk['access_modules'], 'Site Audit Assistant')!==false){$arguments['site_audit_assistant__settings'] = json_decode($user_chk['site_audit_assistant_settings']);}
			
			echo json_encode(array('todo' => 'next', 'next' => 'get_passcode__success', 'arguments' => $arguments));

		} else {
			echo json_encode(array('todo' => 'retry'));			
		}
		
		mysqli_close($con);
		exit;
				
		}
	}
	
}







else if($todo == 'get_warrior'){

	$email = $json['email'];

	$user_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE email='$email' LIMIT 1"));

	if(!$user_chk){
		echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => 'This account is not listed on PLUS central database.')); mysqli_close($con); exit;
	} else {
		if($user_chk['status'] == 'Disabled'){echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => $name.'\'s account has been disabled. Contact PLUS support team to know more.')); mysqli_close($con); exit;}
		else if($user_chk['status'] == 'Blocked'){echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => $name.'\'s account has been blocked. Contact PLUS support team to know more.')); mysqli_close($con); exit;}
		else if($user_chk['status'] == 'Active'){

		$active_devices = '';
		if($user_chk['session_browser']!=''||$device=='browser'){$active_devices.='Browser: '.($user_chk['session_browser_count'] == 0 ? 1 . ' Login|' : $user_chk['session_browser_count'] . ' Logins|');}
		if($user_chk['session_android']!=''||$device=='android'){$active_devices.='Android: '.($user_chk['session_android_count'] == 0 ? 1 . ' Login|' : $user_chk['session_android_count'] . ' Logins|' );}
		if($user_chk['session_ios']!=''||$device=='ios'){$active_devices.='iPhone: '.($user_chk['session_ios_count'] == 0 ? 1 . ' Login|' : $user_chk['session_ios_count'] . ' Logins|' );}
		
		$warrior = array('id' => $user_chk['id'], 'san' => $user_chk['san'], 'name' => $user_chk['name'], 'gender' => $user_chk['gender'], 'designation' => $user_chk['designation'], 'team' => $user_chk['team'], 'reporting_to_name' => $user_chk['reporting_to_name'], 'reporting_to_email' => $user_chk['reporting_to_email'], 'workstation' => $user_chk['workstation'], 'email' => $user_chk['email'], 'gmail' => $user_chk['gmail'], 'phone' => $user_chk['phone'], 'access_level' => $user_chk['access_level'], 'access_modules' => $user_chk['access_modules'], 'about_me' => $user_chk['about_me'], 'my_golden_rule' => $user_chk['my_golden_rule'], 'active_devices' => rtrim($active_devices, '|'), 'last_seen' => date('l, jS M Y, h:i A', strtotime($timestamp)));

		$tasks = array();

		if($result = mysqli_query($con, "SELECT * FROM tasks WHERE assigned_to_email='".$user_chk['email']."' AND timestamp_deleted='' AND timestamp_last_opened='' ORDER BY timestamp_created ASC")){
			while ($row = mysqli_fetch_assoc($result)){
				$tasks[] = $row;
			}
			$result->free();
		}
 
		$notifications = array();
		
		$team = explode('>', $user_chk['team']);

		if($result = mysqli_query($con, "SELECT id, timestamp_created, creator, title, notification FROM notifications WHERE (recipients LIKE '%".$user_chk['email']."%' OR recipients LIKE '%".trim($team[2])."%') AND (details NOT LIKE '%".$user_chk['email']."%') ORDER BY timestamp_created DESC")){
			while ($row = mysqli_fetch_assoc($result)){
				$row['state']='Unread';
				$notifications[] = $row;
			}
			$result->free();
		}

		$settings = $user_chk['settings'];

		$arguments = array('warrior' => $warrior, 'tasks' => $tasks, 'notifications' => $notifications, 'settings' => $settings);

		echo json_encode(array('todo' => 'next', 'next' => 'get_warrior__success', 'arguments' => $arguments));
		
		mysqli_close($con);
		exit;

		}
	}
	
}














else if($todo == 'get_task'){

	$id = $json['id'];

	$task_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tasks WHERE id='$id' LIMIT 1"));

	if(!$task_chk){
		echo json_encode(array('todo' => 'next', 'next' => 'taskNotFound')); mysqli_close($con); exit;
	} else {
		$task_history_latest = $task_chk;

		echo json_encode(array('todo' => 'next', 'next' => 'getTaskSuccess', 'arguments' => $task_history_latest));

		mysqli_close($con);
		exit;
	}
	
}












else if($todo == 'post_task__comment'){

	$id = $json['id'];

	$task_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tasks WHERE id='$id' LIMIT 1"));

	if(!$task_chk){
		echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', message => 'Task not found or may have been deleted by its creator.')); mysqli_close($con); exit;
	} else {

		$commentObj->datetime = $timestamp;
		$commentObj->name = $json['name'];
		$commentObj->email = $json['email'];
		$commentObj->comment = $json['comment'];
		$commentObj = json_encode($commentObj);

		if(mysqli_query($con, "UPDATE tasks SET work_progress_comments = CONCAT(work_progress_comments, '".addslashes($commentObj)."') WHERE id='$id' ")){
			echo json_encode(array('todo' => 'next', 'next' => 'post_task__comment_success', 'arguments' => ''));
		} else {
			echo json_encode(array('todo' => 'retry'));
		}

		mysqli_close($con);
		exit;
	}

}







else if($todo == 'create_task'){
	$assigned_by_name = $json['assigned_by_name'];
	$assigned_by_email = $json['assigned_by_email'];
	$assigned_to_name = $json['assigned_to_name'];
	$assigned_to_email = $json['assigned_to_email'];
	$title = $json['title'];
	$todos = $json['todos'];
	$expected_completion = (!$json['expected_completion'] ?  'Unknown' : $json['expected_completion']);
	$state = 'Created';
	$status = 'Open';

	$success_todo = ($json['success_todo'] == '' ?  'alert' : $json['success_todo']);
	$success_todo_title = ($json['success_todo_title'] == '' ?  'Congratulations!' : $json['success_todo_title']);
	$success_todo_message = ($json['success_todo_message'] == '' ?  'Task has been created and assisgned to ' . $assigned_to_name : $json['success_todo_message']);
	$success_todo_next = ($json['success_todo_next'] == '' ?  'do_nothing' : $json['success_todo_next']);
	$success_todo_goto = ($json['success_todo_goto'] == '' ?  '/welcome/' : $json['success_todo_goto']);

	if(mysqli_query($con, "INSERT INTO tasks(timestamp_created, assigned_by_name, assigned_by_email, assigned_to_name, assigned_to_email, title, todos, timestamp_expected_completion, state, status) VALUES ('$timestamp', '$assigned_by_name', '$assigned_by_email', '$assigned_to_name', '$assigned_to_email', '$title', '$todos', '$expected_completion', '$state', '$status')")){		

		$task_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tasks WHERE id='".mysqli_insert_id($con)."' LIMIT 1"));

		$success_todo_arguments = $task_chk;

		if($success_todo == 'alert'){echo json_encode(array('todo' => 'alert', 'title' => $success_todo_title, 'message' => $success_todo_message));}
		else if($success_todo == 'alert_next'){echo json_encode(array('todo' => 'alert_next', 'title' => $success_todo_title, 'message' => $success_todo_message, 'next' => $success_todo_next, 'arguments' => $success_todo_arguments));}
		else if($success_todo == 'alert_goto'){echo json_encode(array('todo' => 'alert_goto', 'title' => $success_todo_title, 'message' => $success_todo_message, 'goto' => $success_todo_goto, 'arguments' => $success_todo_arguments));}
		else if($success_todo == 'next'){echo json_encode(array('todo' => 'next', 'next' => $success_todo_next, 'arguments' => $success_todo_arguments));}
		else if($success_todo == 'goto'){echo json_encode(array('todo' => 'goto', 'goto' => $success_todo_goto));}
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
	
	mysqli_close($con);
	exit;
}


// Auth for user commands
$passcode = $json['passcode'];
$passcode_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE session_".$device."='$passcode' LIMIT 1"));
if(!$passcode||!$passcode_chk){echo json_encode(array('todo' => 'goto', 'goto' => '/passcode/')); mysqli_close($con); exit;}
$email = $passcode_chk['email'];
$name = $passcode_chk['name'];










if($todo == 'get_team_tasks'){

	$team = $json['team'];
	$email = $json['email'];
	$team_members_query = '';

	if($result = mysqli_query($con, "SELECT email FROM users WHERE team='$team' AND email != '$email' ORDER BY name ASC")){
		while ($row = mysqli_fetch_assoc($result)){
			$team_members_query .= " `assigned_to_email` = '" . $row[email] . "' OR ";
		}
		$result->free();
	}

	if($team_members_query==''){echo json_encode(array('todo' => 'next', 'next' => 'get_team_tasks_success', 'arguments' => ''));exit;}

	if($result = mysqli_query($con, "SELECT * FROM tasks WHERE " . rtrim($team_members_query, 'OR ') . " AND timestamp_deleted='' AND status='Pending' ORDER BY timestamp_created ASC LIMIT 100")){
		while ($row = mysqli_fetch_assoc($result)){
			unset($row['work_progress_comments']);
			unset($row['timestamp_deleted']);
			$tasks[] = $row;
		}
		$result->free();
	}

	echo json_encode(array('todo' => 'next', 'next' => 'get_team_tasks_success', 'arguments' => $tasks ));
	
	mysqli_close($con);
	exit;
}



































































else if($todo == 'sync_settings'){
	$settings = $json['settings'];
	if(mysqli_query($con, "UPDATE users SET settings='$settings' WHERE session_".$device."='$passcode'")){
		echo json_encode(array('todo' => 'nothing'));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
	mysqli_close($con);
	exit;
}

// Get warrior details
else if($todo == 'get_warrior'){

	$id = $json['id'];

	$user_chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id='$id' LIMIT 1"));

	if(!$user_chk){
		echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => 'We couldn\'t find this warrior.', 'arguments' => '')); mysqli_close($con); exit;
	} else {

		$active_devices = '';
		if($user_chk['session_browser']!=''||$device=='browser'){$active_devices.='Browser: '.($user_chk['session_browser_count'] == 0 ? 1 . ' Login|' : $user_chk['session_browser_count'] . ' Logins|');}
		if($user_chk['session_android']!=''||$device=='android'){$active_devices.='Android: '.($user_chk['session_android_count'] == 0 ? 1 . ' Login|' : $user_chk['session_android_count'] . ' Logins|' );}
		if($user_chk['session_ios']!=''||$device=='ios'){$active_devices.='iPhone: '.($user_chk['session_ios_count'] == 0 ? 1 . ' Login|' : $user_chk['session_ios_count'] . ' Logins|' );}
		
		$warrior = array('id' => $user_chk['id'], 'san' => $user_chk['san'], 'name' => $user_chk['name'], 'gender' => $user_chk['gender'], 'designation' => $user_chk['designation'], 'team' => $user_chk['team'], 'workstation' => $user_chk['workstation'], 'email' => $user_chk['email'], 'gmail' => $user_chk['gmail'], 'phone' => $user_chk['phone'], 'access_level' => $user_chk['access_level'], 'access_modules' => $user_chk['access_modules'], 'about_me' => $user_chk['about_me'], 'my_golden_rule' => $user_chk['my_golden_rule'], 'active_devices' => rtrim($active_devices, '|'));

		$tasks = array();

		if($result = mysqli_query($con, "SELECT * FROM tasks WHERE assigned_to_email='".$user_chk['email']."' AND timestamp_deleted='' AND timestamp_last_opened='' ORDER BY timestamp_created ASC")){
			while ($row = mysqli_fetch_assoc($result)){
				$tasks[] = $row;
			}
			$result->free();
		}
 
		$notifications = array();
		
		$team = explode('>', $user_chk['team']);

		if($result = mysqli_query($con, "SELECT id, timestamp_created, creator, title, notification FROM notifications WHERE (recipients LIKE '%".$user_chk['email']."%' OR recipients LIKE '%".trim($team[2])."%') AND (details NOT LIKE '%".$user_chk['email']."%') ORDER BY timestamp_created DESC")){
			while ($row = mysqli_fetch_assoc($result)){
				$row['state']='Unread';
				$notifications[] = $row;
			}
			$result->free();
		}

			$arguments = array('warrior' => $warrior, 'tasks' => $tasks, 'notifications' => $notifications);
			
			echo json_encode(array('todo' => 'next', 'next' => 'get_warrior__success', 'arguments' => $arguments));
			
			mysqli_close($con);
			exit;
	}
}






//fix with later, shift after auth script
else if($todo == 'update_site_audit_assistant_audited_data'){

	$audited_data = $json['audited_data'];
	$date_remediation_completed = '';
	if($json['is_remediation_completed']=='1'){$date_remediation_completed=date('Y-m-d');}

	$bcc_project_id = $json['bcc_project_id']; if($bcc_project_id!=''){$bcc_project_id=$bcc_project_id.', ';}

	$update_query = "UPDATE site_audit_assistant SET `[step]audit` = '" . $json['audit_steps_completed'] . "', `[step]remediation` = '" . $json['remediation_steps_completed'] . "', `[date]audit_completed` = '" . date('Y-m-d') . "', `[time]audit_completed` = '" . date("Y-m-d h:i:s A") . "', `[date]remediation_completed` = '" . $date_remediation_completed . "', `[bcc]project_id` = '".$bcc_project_id."', ";
	
	$defect_or_no_defect = '';
	$workable = '';
	$non_workable = '';
	$workable_or_non_workable_or_both = '';
	$remediation_wip = '';
	$remediation_fixed = '';

	foreach($audited_data as $key=>$val){

		if($defect_or_no_defect=='' && substr($val, 0, 2) == '2~'){$defect_or_no_defect='Defect';}

		if( ($workable=='' || $workable=='NA') && substr($val, 0, 2) == '2~'){$val_explode = explode('~', $val);if($val_explode[1]=='NA'){$workable='NA';}else{$workable='Workable';}}
		if( ($non_workable=='' || $non_workable=='NA') && substr($val, 0, 2) == '2~'){$val_explode = explode('~', $val);if($val_explode[2]=='NA'){$non_workable='NA';}else{$non_workable='Non Workable';}}

		//if( ($remediation_wip=='' || $remediation_wip=='NA') && substr($val, 0, 2) == '2~'){$val_explode = explode('~', $val);if($val_explode[3]=='NA'){$remediation_wip='NA';}else{$remediation_wip='WIP';}}
		//if( ($remediation_fixed=='' || $remediation_fixed=='NA') && substr($val, 0, 2) == '2~'){$val_explode = explode('~', $val);if($val_explode[4]=='NA'){$remediation_fixed='NA';}else{$remediation_wip='Fixed';}}

		$update_query .= "`[chk]" . $key . "` = '" . $val . "', ";
	}
	
	if($defect_or_no_defect==''){$defect_or_no_defect='No Defect';}

	if($workable!=''||$non_workable!=''){
		if($workable=='Workable' && $non_workable=='Non Workable'){$workable_or_non_workable_or_both='Both';}
		else if($workable=='Workable' && $non_workable=='NA'){$workable_or_non_workable_or_both='Workable';}
		else if($workable=='NA' && $non_workable=='Non Workable'){$workable_or_non_workable_or_both='Non Workable';}
	}

	$update_query .= " `[status]defect_or_no_defect` = '".$defect_or_no_defect."', `[status]workable_or_non_workable_or_both` = '".$workable_or_non_workable_or_both."' WHERE id = " . $json['id'];
	$update_query = str_replace(', WHERE id', ' WHERE id', $update_query);

	if(mysqli_query($con, $update_query)){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => ''));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
	exit;
}






//delete the following old api query
else if($todo == 'update_site_audit_assistant_wip_data'){
	$wip_update_query = "UPDATE site_audit_assistant SET `[step]audit` = '" . $json['step'] . "' WHERE id = '". $json['id'] ."'";

	if(mysqli_query($con, $wip_update_query)){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => 'ssss'));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
	exit;
}

else if($todo == 'update_site_audit_assistant_wip_audit'){
		
	$wip_update_query_part = "";
	
	$check_wip = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM site_audit_assistant WHERE `id` = '". $json['id'] . "' AND `[api]product_details` = '' "));
	if($check_wip['count']==1){$wip_update_query_part = ', `[time]audit_started` = "' . date('Y-m-d h:i:s A') . '", `[api]product_details` = ' . "'" . str_replace("'", "\'", $json['product_details']) . "'";}

	//echo json_encode(json_decode($json['product_details'], true));exit;
	//echo $wip_update_query_part;exit;

	$wip_update_query = 'UPDATE site_audit_assistant SET `[step]audit` = "' . $json['step'] . '"' . $wip_update_query_part . ' WHERE id = "' . $json['id'] . '"';

	//echo $wip_update_query;exit;

	if(mysqli_query($con, $wip_update_query)){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => ''));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
	exit;
}

else if($todo == 'update_site_audit_assistant_wip_remediation'){
	$wip_update_query = "UPDATE site_audit_assistant SET `[step]remediation` = '" . $json['step'] . "' WHERE id = '". $json['id'] ."'";

	if(mysqli_query($con, $wip_update_query)){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => ''));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
	exit;
}


else if($todo == 'get_site_audit_assistant_audited_data'){
	
	$id = $json['id'];

	$audited_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM site_audit_assistant WHERE id='$id' LIMIT 1"));
	if(!$audited_data){echo json_encode(array('todo' => 'next', 'next' => 'get_site_audit_assistant_audited_data_failure', 'arguments' => ''));exit;}

	echo json_encode(array('todo' => 'next', 'next' => 'get_site_audit_assistant_audited_data_success', 'arguments' => array($audited_data) ));

	exit;

}


if($todo == 'sync_notifications'){
	
	$sync_notifications = explode('|', $json['notifications']);
	
	if($sync_notifications[0]!=''){
		if(mysqli_query($con, "UPDATE notifications SET timestamp_last_opened = '".$timestamp."' WHERE id = '" . str_replace(",", "' OR id = '", $sync_notifications[0]) . "'")){} else {echo json_encode(array('todo' => 'retry'));exit;}
	}
	if($sync_notifications[1]!=''){
		if(mysqli_query($con, "UPDATE notifications SET timestamp_deleted = '".$timestamp."' WHERE id = '" . str_replace(",", "' OR id = '", $sync_notifications[1]) . "'")){} else {echo json_encode(array('todo' => 'retry'));exit;}
	}

	$notifications = '';

	if($result = mysqli_query($con, "SELECT * FROM notifications WHERE to_email='".$email."' AND timestamp_deleted='' AND timestamp_last_opened='' ORDER BY timestamp_created ASC")){
		while ($row = mysqli_fetch_assoc($result)){
			$notifications .= $row['id'] . '|' . $row['timestamp_created'] . '|' . $row['from_name'] . '|' . $row['subject'] . '|' . $row['message'] . '|0~';
		}
		$result->free();
	}

	echo json_encode(array('todo' => 'next', 'next' => 'sync_notifications_success', 'arguments' => $notifications));

}



























else if($todo == 'update_site_audit_assistant_settings'){
	
	$site_audit_assistant_settings = $json['site_audit_assistant_settings'];
	
	if(mysqli_query($con, "UPDATE users SET site_audit_assistant_settings='$site_audit_assistant_settings' WHERE session_".$device."='$session'")){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => ''));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
}













else if($todo == 'update_dashboard_filters'){

	$dashboard_filters = explode('@', $json['dashboard_filters_and_views']);
	$which_dashboard = 'dashboard_filters_and_views_' . $dashboard_filters[0];
	$new_dashboard_filters = $dashboard_filters[1];

	if(mysqli_query($con, "UPDATE users SET $which_dashboard='$new_dashboard_filters' WHERE session_".$device."='$session'")){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => ''));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}

}















else if($todo == 'read_notification'){
	
	$id = $json['id'];
	$timestamp_last_opened = $timestamp;

	if(mysqli_query($con, "UPDATE notifications SET timestamp_last_opened='$timestamp_last_opened', number_of_opens = number_of_opens + 1 WHERE id='$id'")){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => ''));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
}









else if($todo == 'delete_notification'){
		
	$id = $json['id'];
	$timestamp_deleted = $timestamp;

	if(mysqli_query($con, "UPDATE notifications SET timestamp_deleted='$timestamp_deleted' WHERE id='$id'")){
		echo json_encode(array('todo' => 'next', 'next' => 'do_nothing', 'arguments' => ''));
	} else {
		echo json_encode(array('todo' => 'retry'));
	}
}





else if($todo == 'get_site_audit_new_allotment_and_backlog'){

	$site_audit_new_allotment = array();
	$site_audit_backlog = array();
	$today = date('Y-m-d');

	if($result = mysqli_query($con, "SELECT * FROM site_audit_assistant WHERE `[date]allotted`='$today' AND `[id]allotted_to`='$name' ORDER BY `[id]division` ASC")){
		while ($row = mysqli_fetch_assoc($result)){
			$status = '0'; if($row['[date]audit_completed']=='' && $row['[step]audit'] > 0){$status='1';}else if($row['[date]audit_completed']!=''){$status='2';}else{$status='0';}
			$fs_or_nfs = 'Data unavailable';if( $row['[type]factoryship_or_non_factoryship_item'] == '1' ){ $fs_or_nfs = 'Non factory ship'; }else if( $row['[type]factoryship_or_non_factoryship_item'] == '0' ){ $fs_or_nfs = 'Factory ship'; }
			$site_audit_new_allotment[] = $row['id'].'|#'.$row['[id]division'].'|'.$row['[id]pp'].'|'.$row['[id]lot'].'|'.$status.'|'.htmlentities(utf8_encode($row['[name]pp']),ENT_NOQUOTES).'|'.$row['[date]allotted'].'|'.$fs_or_nfs;
		}
		$result->free();
	}
	if($result = mysqli_query($con, "SELECT * FROM site_audit_assistant WHERE `[date]allotted` < DATE_FORMAT(NOW(),'$today') AND `[id]allotted_to`='$name' AND (`[date]audit_completed` = '' OR `[date]audit_completed` = '$today') ORDER BY `[id]division` ASC")){
		while ($row = mysqli_fetch_assoc($result)){
			$status = '0'; if($row['[date]audit_completed']=='' && $row['[step]audit'] > 0){$status='1';}else if($row['[date]audit_completed']!=''){$status='2';}else{$status='0';}
			$fs_or_nfs = 'Data unavailable';if( $row['[type]factoryship_or_non_factoryship_item'] == '1' ){ $fs_or_nfs = 'Non factory ship'; }else if( $row['[type]factoryship_or_non_factoryship_item'] == '0' ){ $fs_or_nfs = 'Factory ship'; }
			$site_audit_backlog[] = $row['id'].'|#'.$row['[id]division'].'|'.$row['[id]pp'].'|'.$row['[id]lot'].'|'.$status.'|'.htmlentities(utf8_encode($row['[name]pp']),ENT_NOQUOTES).'|'.$row['[date]allotted'].'|'.$fs_or_nfs;
		}
		$result->free();
	}
 
	echo json_encode(array('todo' => 'next', 'next' => 'save_site_audit_new_allotment_and_backlog_numbers', 'arguments' => array('site_audit_new_allotment' => $site_audit_new_allotment, 'site_audit_backlog' => $site_audit_backlog )));
	
}

























else{echo json_encode(array('todo' => 'alert', 'title' => 'Sorry!', 'message' => 'We couldn\'t recognise your request. Contact PLUS support team to fix this issue.'));}
?>
