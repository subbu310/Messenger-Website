
<?php

 error_reporting(0);
 
 include('connect.php');
 
 session_start();
 
 if($_FILES['upload_profile']['name'] != ''){
	 
	 $userId = $_SESSION['user_id'];
	 
	 $name = $_FILES['upload_profile']['name'];
	 
	 $tmp_name = $_FILES['upload_profile']['tmp_name'];
	 
	 $target_file = 'ProfileImage/'.$name ;
	 
	 move_uploaded_file($tmp_name, $target_file);
	 
	 $profile_url = "http://localhost/new_messenger/".$target_file;
	 
	 $sql ="UPDATE `user` SET `user_image`='$profile_url' WHERE `user_id`='$userId'";
	 
	 $result = mysqli_query($conn, $sql);
	 
	 if($result){
		 
		 echo 'upload profile image success';
	 }
 }
 
  if($_POST['action_profile_image']){
     
	  $userId = $_SESSION['user_id'];
	 
      $sql ="SELECT * FROM `user` WHERE `user_id`='$userId'";
	 
	 $result = mysqli_query($conn, $sql);
	 
	 while($row = mysqli_fetch_assoc($result)){
		 
		 $userImage = $row['user_image'];
		 
		 if($userImage == null){
			 
			 $profileImage = '<img id="profile-image" src="icon/profile_image.jpg" />';
			 
		 }else{
			 
			 $profileImage = '<img id="profile-image" src="'.$userImage.'" />';
			 
		 }
		 
		 echo '<div class="messenger-nav-image">
   
                   '.$profileImage.'
				   
				  <input type="file" name ="profile_image" id="user-image" onchange="preview();" />
					    
                </div>';
		 
	 }
	 
	
  }
  
   //fetch chat users
  
   if($_POST['action_chat_users']){
     
	  $userId = $_SESSION['user_id'];
	 
      $sql ="SELECT * FROM `user` LEFT JOIN `user_chat` ON
	  
	         user.user_id = user_chat.receiver_id AND user_chat.sender_id = '$userId'

			 WHERE `user_id` !='$userId' GROUP BY user.user_id 
			 
			 ORDER BY user_chat.date DESC";
	 
	  $result = mysqli_query($conn, $sql);
	 
	  while($row = mysqli_fetch_assoc($result)){
		 
		 $userImage = $row['user_image'];
		 
		 $userName = $row['username'];
		 
		 $userId = $row['user_id'];
		 
		 $chatMessage = $row['chat_message'];
		 
		 if($userImage == null){
			 
			 $profileImage = '<img id="profile-image" src="icon/profile_image.jpg" />';
			 
		 }else{
			 
			 $profileImage = '<img id="profile-image" src="'.$userImage.'" />';
			 
		 }
		 
		 echo '<div class="messenger-user-container-inside" id="'.$userId.'">
                
				<div class="messenger-user-icon">
   
                    <div class="messenger-user-image">
   
                         '.$profileImage.'
						 
                    </div>
					   
                </div>
				
				<div class="messenger-user-name">
   
                    <div class="messenger-user-name-inside">
   
                        <a><b>'.$userName.'</b></a>
						
						'.users_last_seen_chat($conn, $userId).'
						
                    </div>
					
                 </div>
				
			</div>';
		 
	 }
	 
	
  }
  
  //users last seen message
  
  function users_last_seen_chat($conn, $receiverId){
	  
	  $senderId = $_SESSION['user_id'];
	 
	  $sql ="SELECT * FROM `user_chat` WHERE 
		         
			(`sender_id`= '$senderId' AND `receiver_id`= '$receiverId') 
					  
			OR (`sender_id`= '$receiverId' AND `receiver_id`= '$senderId') 
			
			ORDER BY user_chat.date DESC LIMIT 1";
	 
	    $result = mysqli_query($conn, $sql);
	 
	     while($row = mysqli_fetch_assoc($result)){
			  
		   $send = $row['sender_id'];
		   
		   $chatMessage = $row['chat_message'];
		   
		   $chatImage = $row['chat_image'];
		 
		   $type = $row['type'];
		   
		   if($type == 'text'){
				 
				 //chat text display
				 
				 if($senderId == $send){
				
			      $output .= '<a>'.$chatMessage.'</a>';
			   
				 }else{
					 
				  $output .= '<a>'.$chatMessage.'</a>';
				   
				 }
				 
		   } else if($type == 'image'){
			   
			   if($senderId == $send){
				
			      $output .= '<a>Photo</a>';
			   
				 }else{
					 
				  $output .= '<a>Photo</a>';
				   
				 }
			
		   }else{
			  
                if($senderId == $send){
				
			      $output .= '<a>'.$chatMessage.'</a>';
			   
				 }else{
					 
				  $output .= '<a>'.$chatMessage.'</a>';
				   
				 }			  
		   }
		   
		 } 
		 
   return $output ;
   
  }
  
    // fetch chat users profile and chat box
  
   if($_POST['fetch_chat_users_profile']){
     
	    
		$chatUserId = $_POST['chat_user_Id'];
		
		if($chatUserId != ''){
			
			echo make_chat_users($conn , $chatUserId);
			
		}else{
			
		  $userId = $_SESSION['user_id'];
	 
          $sql ="SELECT * FROM `user` LEFT JOIN `user_chat` ON
	  
	         user.user_id = user_chat.receiver_id AND user_chat.sender_id = '$userId'

			 WHERE `user_id` !='$userId' GROUP BY user.user_id 
			 
			 ORDER BY user_chat.date DESC  LIMIT 1";
	 
	      $result = mysqli_query($conn, $sql);
	 
	      while($row = mysqli_fetch_assoc($result)){
		 
		       $chatUserId = $row['user_id'];
			 
			echo  make_chat_users($conn , $chatUserId);
			   
		  }
			
		}
		
	    
   }
   
   function make_chat_users($conn , $chatUserId){
	   
	   
	   $output = ''.chat_user_top_nav($conn , $chatUserId).'
	   	
		 <div class="messenger-message-container">
   	
		    <div class="messenger-message-left">
   
                  <div class="messenger-chat-container">
   
                        <div class="messenger-chat-box">
						
						   '.users_chat_display($conn, $chatUserId).'
						   
		                </div>
						
		          </div>
				  
				  <div class="messenger-chat-bottom">
   
                        <div class="messenger-chat-icon">
                           
						    <div class="messenger-chat-icon-image">
   
                               <img src="icon/add.png" />
					   
				            </div> 
							
							<div class="messenger-chat-icon-image">
   
                               <img src="icon/gif.png" />
					   
				            </div> 
							
							<div class="messenger-chat-icon-image">
   
                               <img src="icon/sticker.png" />
					   
				            </div> 
							
							<div class="messenger-chat-icon-image">
   
                               <img class="chat-file" src="icon/file.png" />
							   
							   <input type="file" name="chat_image" id="chat-image" data-id="'.$chatUserId.'"/>
		                    
					   
				            </div> 
                       
		                </div>
						
						<div class="messenger-chat-input">
   
                           <div class="messenger-chat-input-inside">
   
                             <div class="messenger-chat-type">
   
                               <input type="text" name="chat" id="chat-type" placeholder="Type a message.." />
		                    
							</div>
							 
							 <div class="messenger-chat-emoji">
   
                                 <div class="messenger-chat-emoji-image">
   
                                  <img id="emoji" src="icon/smile.png" />
								   
								   <div class="messenger-chat-emoji-container">
                                         
										 <div class="message-emoji-display">
						   
                                               <div class="message-emoji">
						 
	                                                <span class="emoji-span" id="&#128513">&#128513</span>
	 		
	                                            </div>	

                                                <div class="message-emoji">
						 
	                                                 <span class="emoji-span" id="&#128514">&#128514</span>
	                         
	                                             </div>	
   
                                                 <div class="message-emoji">
						 
	                                                  <span class="emoji-span" id="&#128515">&#128515</span>
	                         
	                                               </div>	
   
                                                    <div class="message-emoji">
						 
	                                                    <span class="emoji-span" id="&#128525">&#128525</span>
	                         
	                                                 </div>	

                                                     <div class="message-emoji">
						 
	                                                     <span class="emoji-span" id="&#128541">&#128541</span>
	                         
	                                                 </div>	

                                                     <div class="message-emoji">
	 					 
	                                                      <span class="emoji-span" id="&#128077">&#128077</span>
	                         
	                                                 </div>	

                                                     <div class="message-emoji">
						 
	                                                      <span class="emoji-span" id="&#10084">&#10084</span>
	                         
	                                                 </div>

                                                     <div class="message-emoji">
						 
	                                                       <span class="emoji-span" id="&#127775">&#127775</span>
	                         
	                                                 </div>

                                                     <div class="message-emoji">
						 
	                                                       <span class="emoji-span" id="&#127801">&#127801</span>
	                         
	                                                 </div>

                                                     <div class="message-emoji">
						 
	                                                       <span class="emoji-span" id="&#127822">&#127822</span>
	                         
	                                                 </div>

                                                     <div class="message-emoji">
						 
	                                                   <span class="emoji-span" id="&#127942">&#127942</span>
	                         
	                                                  </div>

                                                     <div class="message-emoji">
						 
	                                                    <span class="emoji-span" id="&#128049">&#128049</span>
	                         
	                                                 </div>

                                                     <div class="message-emoji">
						 
	                                                    <span class="emoji-span" id="&#128276">&#128276</span>
	                         
	                                                 </div>

                                                      <div class="message-emoji">
						 
	                                                      <span class="emoji-span" id="&#128663">&#128663</span>
	                         
	                                                  </div>

                                                      <div class="message-emoji">
						 
	                                                     <span class="emoji-span" id="&#128652">&#128652</span>
	                         
	                                                  </div>

                                                      <div class="message-emoji">
						 
	                                                      <span class="emoji-span" id="&#128525">&#128525</span>
	                         
	                                                  </div>	
							   
                                                  </div> 
                                   
				                   </div> 
									 
				                </div> 
								
		                     </div>
							 
		                   </div>
						   
		                </div>
						
						<div class="messenger-chat-send">
   
                             <div class="messenger-chat-send-image" id="'.$chatUserId.'">
   
                               <img src="icon/send.png" />
					   
				             </div> 
							
							<div class="messenger-chat-like-image">
   
                               <img src="icon/like.png" />
					   
				            </div> 
							
		                </div>
					   
		          </div>
				  
		    </div> 
		   
		    <div class="messenger-message-right">
                   
				   '.chat_user_profile($conn , $chatUserId).'
				   
				   <div class="messenger-setting-action">
   
                            <div class="messenger-action">
   
                              <div class="messenger-action-text">
   
                                  <div class="messenger-action-text-inside">
   
                                     <a>MORE ACTIONS</a>
									 
                                  </div>
								 
                              </div>
							  
							  <div class="messenger-action-image">
                                   
								   <div class="messenger-action-image-inside">
   
                                      <img style="cursor:pointer;" class="setting-arrow" src="icon/arrow_down.png" />
					   
                                   </div>
                               
                              </div>
							  
                            </div>
							
							<div class="messenger-action-more">
   
                               <div class="messenger-action">
   
                                 <div class="messenger-action-text">
   
                                  <div class="messenger-action-text-inside">
   
                                     <a style="color:black; font-size:17px;">Search in Conversation</a>
									 
                                  </div>
								 
                                </div>
							  
							  <div class="messenger-action-image">
                                   
								   <div class="messenger-action-image-inside">
   
                                      <img src="icon/search.png" />
					   
                                   </div>
                               
                              </div>
							  
                            </div>
							
							<div class="messenger-action">
   
                                 <div class="messenger-action-text">
   
                                  <div class="messenger-action-text-inside">
   
                                     <a style="color:black; font-size:17px;">Edit Nicknames</a>
									 
                                  </div>
								 
                                </div>
							  
							  <div class="messenger-action-image">
                                   
								   <div class="messenger-action-image-inside">
   
                                      <img src="icon/edit_name.png" />
					   
                                   </div>
                               
                              </div>
							  
                            </div>
							
							<div class="messenger-action">
   
                                 <div class="messenger-action-text">
   
                                  <div class="messenger-action-text-inside">
   
                                     <a style="color:black; font-size:17px;">Change theme</a>
									 
                                  </div>
								 
                                </div>
							  
							  <div class="messenger-action-image">
                                   
								   <div class="messenger-action-image-inside">
   
                                      <img src="icon/color.png" />
					   
                                   </div>
                               
                              </div>
							  
                            </div>
							
							<div class="messenger-action">
   
                                 <div class="messenger-action-text">
   
                                  <div class="messenger-action-text-inside">
   
                                     <a style="color:black; font-size:17px;">Change Emoji</a>
									 
                                  </div>
								 
                                </div>
							  
							  <div class="messenger-action-image">
                                   
								   <div class="messenger-action-image-inside">
   
                                      <img src="icon/like.png" />
					   
                                   </div>
                               
                              </div>
							  
                            </div>
							
                         </div>
							
                  </div>
				  
				  
		    </div> 
			
			
		 </div>';
	   
	  return  $output;
	   
   }
   
   
   function chat_user_top_nav($conn , $chatUserId){
	   
	   $sql ="SELECT * FROM `user` WHERE `user_id` ='$chatUserId'";
	 
	      $result = mysqli_query($conn, $sql);
	 
	      while($row = mysqli_fetch_assoc($result)){
		 
		       $userImage = $row['user_image'];
		 
		       $userName = $row['username'];
		 
		      if($userImage == null){
			 
			    $profileImage = '<img  src="icon/profile_image.jpg" />';
			 
		     }else{
			 
			    $profileImage = '<img  src="'.$userImage.'" />';
			 
		     }
			 
			 $output .=  '<div class="messenger-right-top-nav">
                
				<div class="messenger-right-top-nav-image">
   
                     <div class="messenger-right-nav-image">
   
                       '.$profileImage.'
					   
                     </div>
				   
                </div>
				
				<div class="messenger-right-top-nav-name">
   
                     <a><b>'.$userName.'</b></a>
					 
                </div>
				
				<div class="messenger-right-top-icon">
                   
                      <div class="messenger-right-icon-image">
   
                          <img src="icon/call.png" />
					   
				      </div> 
					 
                </div>
				
				<div class="messenger-right-top-icon">
                  
				      <div class="messenger-right-icon-image">
   
                          <img src="icon/video_call.png" />
					   
				      </div> 
          
                </div>
				
				<div class="messenger-right-top-icon">
                     
					 <div class="messenger-right-icon-image">
   
                          <img src="icon/information.png" />
					   
				      </div> 
          
                </div>
          
            </div>';
			   
		  }
		  
		  return $output;
   }
   
   
   
   function chat_user_profile($conn , $chatUserId){
	   
	   $sql ="SELECT * FROM `user` WHERE `user_id` ='$chatUserId'";
	 
	      $result = mysqli_query($conn, $sql);
	 
	      while($row = mysqli_fetch_assoc($result)){
		 
		       $userImage = $row['user_image'];
		 
		       $userName = $row['username'];
		 
		      if($userImage == null){
			 
			    $profileImage = '<img  src="icon/profile_image.jpg" />';
			 
		     }else{
			 
			    $profileImage = '<img  src="'.$userImage.'" />';
			 
		     }
			 
			 $output .=  '<div class="messenger-user-profile">
   
                           <div class="messenger-user-profile-image">
   
                             '.$profileImage.'
							 
				           </div> 
					  
					      <div class="messenger-user-profile-name">
   
                           <a><b>'.$userName.'</b></a>
					   
				         </div> 
					  
		               </div> ';
			   
		  }
		  
		  return $output;
   }
   
   
   // insert chat message
   
   if($_POST['action_chat_send']){
     
	  $senderId = $_SESSION['user_id'];
	 
	  $rceiverId = $_POST['receiver_id']; 
	 
	  $chatMessage = $_POST['chat_message'];
	  
	  $chatType = $_POST['chat_type'];
	 
      $sql ="INSERT INTO `user_chat`(`sender_id`, `receiver_id`, `chat_message`,`type`) 
	  
	          VALUES ('$senderId','$rceiverId','$chatMessage' ,'$chatType') ";
	 
	  $result = mysqli_query($conn, $sql);
	 
	  if($result){
		  
		  echo "insert chat success" ;
	  }
   }
   
   
   // usrs chat display
   
   
   function users_chat_display($conn, $receiverId){
	   
	   $senderId = $_SESSION['user_id'];
	 
	   $sql ="SELECT * FROM `user_chat` INNER JOIN `user` ON user.user_id = user_chat.sender_id WHERE 
		         
			   (`sender_id`= '$senderId' AND `receiver_id`= '$receiverId') 
					  
			   OR (`sender_id`= '$receiverId' AND `receiver_id`= '$senderId') ORDER BY user_chat.date";
	 
	    $result = mysqli_query($conn, $sql);
	 
	     while($row = mysqli_fetch_assoc($result)){
			  
		   $send = $row['sender_id'];
		   
		   $chatMessage = $row['chat_message'];
		   
		   $chatImage = $row['chat_image'];
		 
		   $type = $row['type'];
		 
		   $userImage = $row['user_image'];
		 
		      if($userImage == null){
			 
			    $profileImage = '<img  src="icon/profile_image.jpg" />';
			 
		     }else{
			 
			    $profileImage = '<img  src="'.$userImage.'" />';
			 
		     }
			 
			 if($chatImage == null){
			 
			    $chat_image = '<img  src="icon/post_image.jpg" />';
			 
		     }else{
			 
			    $chat_image = '<img  src="'.$chatImage.'" />';
			 
		     }
			 
			 if($type == 'text'){
				 
				 //chat text display
				 
				 if($senderId == $send){
				
			   $output .= '<div class="messenger-chat-box-right">
   
                                <div class="messenger-chat-right">
   
                                     <div class="messenger-chat-right-inside">
   
                                           <div class="messenger-chat-right-text">
   
                                              <div class="chat-right-user-text">
   
                                               <p>'.$chatMessage.'</p>
										
		                                      </div>
										
		                                   </div> 
										   
										   <div class="messenger-chat-right-image">
   
                                             <div class="chat-right-user-image">
   
                                               <img src="icon/check.png" />
										
		                                     </div>
										
		                                  </div>
										
		                             </div>
									
		                        </div>
								
		                   </div>';
	   	
			}else{
				
			   $output .='<div class="messenger-chat-box-left">
   
                               <div class="messenger-chat-left">
   
                                   <div class="messenger-chat-left-inside">
   
                                       <div class="messenger-chat-left-image">
   
                                          <div class="chat-left-user-image">
   
                                              '.$profileImage.'
											  
		                                   </div>
										
		                                </div>
										
										<div class="messenger-chat-left-text">
   
                                           <div class="chat-left-user-text">
   
                                               <p>'.$chatMessage.'</p>
										
		                                   </div>
										
		                                </div>
										
		                           </div>
								   
		                       </div>
							   
		                   </div>';
			     }
				 
			 }else if($type == 'image'){
				 
				 //chat image display
				 
				 if($senderId == $send){
				
			   $output .= '<div class="messenger-chat-box-right">
   
                                <div class="messenger-chat-right">
   
                                     <div class="messenger-chat-right-inside">
   
                                           <div class="messenger-chat-right-text">
   
                                              <div class="chat-right-image-inside">
   
                                                  <div class="chat-right-image">
   
                                                    '.$chat_image.'
													
		                                         </div>
												 
		                                      </div>
										
		                                   </div> 
										   
										   <div class="messenger-chat-right-image">
   
                                             <div class="chat-right-user-image">
   
                                               <img src="icon/check.png" />
										
		                                     </div>
										
		                                  </div>
										
		                             </div>
									
		                        </div>
								
		                   </div>';
	   	
			}else{
				
			   $output .='<div class="messenger-chat-box-left">
   
                               <div class="messenger-chat-left">
   
                                   <div class="messenger-chat-left-inside">
   
                                       <div class="messenger-chat-left-image">
   
                                          <div class="chat-left-user-image">
   
                                              '.$profileImage.'
											  
		                                   </div>
										
		                                </div>
										
										<div class="messenger-chat-left-text">
   
                                           <div class="chat-left-image-inside">
   
                                                  <div class="chat-left-image">
   
                                                    '.$chat_image.'
													
		                                         </div>
												 
		                                    </div>
										
		                                </div>
										
		                           </div>
								   
		                       </div>
							   
		                   </div>';
			       }
			
			 }
			 
			  else{
				 
				 ///chat emoji display
			
				 if($senderId == $send){
				
			   $output .= '<div class="messenger-chat-box-right">
   
                                <div class="messenger-chat-right">
   
                                     <div class="messenger-chat-right-inside">
   
                                           <div class="messenger-chat-right-text">
   
                                              <div class="chat-right-user-emoji">
   
                                               <p>'.$chatMessage.'</p>
										
		                                      </div>
										
		                                   </div> 
										   
										   <div class="messenger-chat-right-image">
   
                                             <div class="chat-right-user-image">
   
                                               <img src="icon/check.png" />
										
		                                     </div>
										
		                                  </div>
										
		                             </div>
									
		                        </div>
								
		                   </div>';
	   	
			}else{
				
			   $output .='<div class="messenger-chat-box-left">
   
                               <div class="messenger-chat-left">
   
                                   <div class="messenger-chat-left-inside">
   
                                       <div class="messenger-chat-left-image">
   
                                          <div class="chat-left-user-image">
   
                                              '.$profileImage.'
											  
		                                   </div>
										
		                                </div>
										
										<div class="messenger-chat-left-text">
   
                                           <div class="chat-left-user-emoji">
   
                                               <p>'.$chatMessage.'</p>
										
		                                   </div>
										
		                                </div>
										
		                           </div>
								   
		                       </div>
							   
		                   </div>';
			     }
				 
			 }
		  
	      }
		  
		 return $output; 
   }
   
   
  // send chat Image

 if($_FILES['chat_image']['name'] != ''){
	 
	 $senderId = $_SESSION['user_id'];
	 
	 $name = $_FILES['chat_image']['name'];
	 
	 $receiverId = $_POST['receiver_id'];
	 
	 $tmp_name = $_FILES['chat_image']['tmp_name'];
	 
	 $target_file = 'chatPost/'.$name ;
	 
	 move_uploaded_file($tmp_name, $target_file);
	 
	 $chatImage_url = "http://localhost/new_messenger/".$target_file;
	 
	 $sql ="INSERT INTO `user_chat`(`sender_id`, `receiver_id`, `chat_image`,`type`) 
	  
	          VALUES ('$senderId','$receiverId','$chatImage_url' ,'image')";
	 
	  $result = mysqli_query($conn, $sql);
	 
	  if($result){
		  
		  echo "insert chat image success" ;
	  }
	
 }	
   
   
 //fetch search users
  
   if($_POST['action_search_users']){
     
	  $userId = $_SESSION['user_id'];
	  
	  $userName = mysqli_real_escape_string($conn, $_POST['search_users']);
	 
      $sql ="SELECT * FROM `user` WHERE `username` LIKE '%".$userName."%' AND `user_id` !='$userId'";
	 
	  $result = mysqli_query($conn, $sql);
	 
	  while($row = mysqli_fetch_assoc($result)){
		 
		 $userImage = $row['user_image'];
		 
		 $userName = $row['username'];
		 
		 $userId = $row['user_id'];
		 
		 if($userImage == null){
			 
			 $profileImage = '<img id="profile-image" src="icon/profile_image.jpg" />';
			 
		 }else{
			 
			 $profileImage = '<img id="profile-image" src="'.$userImage.'" />';
			 
		 }
		 
		 echo '<div class="messenger-user-search-container-inside" id="'.$userId.'">
                
				<div class="messenger-user-search-icon">
   
                    <div class="messenger-user-search-image">
   
                         '.$profileImage.'
						 
                    </div>
					   
                </div>
				
				<div class="messenger-user-search-name">
   
                    <div class="messenger-user-search-name-inside">
   
                        <a><b>'.$userName.'</b></a>
						
                    </div>
					
                 </div>
				
			</div>';
		 
	 }
	 
	
  }  
   
   
   

?>




