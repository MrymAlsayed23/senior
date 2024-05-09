<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
		<!-- Font awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="css/message.css">
	</head>
	<body>
		<header class="header">
			<div class="headercontainer">
				<div class="row align-items-center justify-content-between">
					<div class="logo">
					</div>
					<nav class="nav">
					   <ul>
						  <li><a href="#"><i style="font-size:24px" class="fa">&#xf0a2;</i></a></li>
						  <li><a href="#"><i style="font-size:24px" class="fa">&#xf003;</i></a></li>
						  <li><a class="adminicon" href="#"><i style="font-size:24px" class="fa">&#xf2bd;</i> | Admin Name</a></li>
					   </ul>
					</nav>
				</div>
			</div>
		 </header>
		 <h1>Client Message</h1>
		<div class="containerr">
			<main>
				<ul>
					<li class="mainli"><a style="color: #aaaaaa" href="dashbord.php"><i style="font-size:24px" class="fa">&#xf015;</i>   Dashboard</a></li>
					<li class="mainli"><a class="maina" href="businesses.php"><i style="font-size:24px" class="fa">&#xf0c0;</i>  Businesses</a></li>
					<li class="mainli"><a style="color: #454545" class="maina" href="message.php"><i style="font-size:24px" class="fa">&#xf075;</i>  Messages</a></li>
					<li class="mainli"><a class="maina" href="#"><i style="font-size:24px" class="fa">&#xf2d2;</i>  Categories</a></li>
				  </ul><br>
			</main>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
						<li class="active">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Khalid Charif</span>
									<p>Online</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Chaymae Naim</span>
									<p>Left 7 mins ago</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
								<i style="font-size:50px" class="fa">&#xf2be;</i>
								<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Sami Rafi</span>
									<p>Online</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Hassan Agmir</span>
									<p>Left 30 mins ago</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Abdou Chatabi</span>
									<p>Left 50 mins ago</p>
								</div>
							</div>
						</li>
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<i style="font-size:60px" class="fa">&#xf2be;</i>
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>khalid Charif</span>
									<p>1767 Messages</p>
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>
						</div>
						<div class="card-body msg_card_body">
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
								</div>
								<div class="msg_cotainer">
									Hi, how are you samim?
									<span class="msg_time">8:40 AM, Today</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									Hi Khalid i am good tnx how about you?
									<span class="msg_time_send">8:55 AM, Today</span>
								</div>
								<div class="img_cont_msg">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
								</div>
							</div>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
								</div>
								<div class="msg_cotainer">
									I am good too, thank you for your chat template
									<span class="msg_time">9:00 AM, Today</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									You are welcome
									<span class="msg_time_send">9:05 AM, Today</span>
								</div>
								<div class="img_cont_msg">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
								</div>
							</div>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
								</div>
								<div class="msg_cotainer">
									I am looking for your next templates
									<span class="msg_time">9:07 AM, Today</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									Ok, thank you have a good day
									<span class="msg_time_send">9:10 AM, Today</span>
								</div>
								<div class="img_cont_msg">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
								</div>
							</div>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<i style="font-size:50px" class="fa">&#xf2be;</i>
								</div>
								<div class="msg_cotainer">
									Bye, see you
									<span class="msg_time">9:12 AM, Today</span>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/message.js"></script>
	</body>
</html>

