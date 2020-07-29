 
 $(document).ready(function(){
    
    //setting close and open
	 
	 $(document).on('click','.setting', function(){
		
		$('.messenger-setting').toggle();
	
	 });
	 
	 //change profile image
	 
	 $(document).on('click','#profile-image', function(){
		
		$('#user-image').trigger('click');
	
	 });
	  
    $(document).on('change','#user-image', function(){
		
		var file = document.getElementById('user-image').files[0];
		
		var formData = new FormData();
		
		formData.append('upload_profile', file);
		
		$.ajax({
			
			url:'action_messenger.php',
			
			method:'post',
			
			data:formData,
			
			contentType:false,
			
			cache:false,
			
			processData:false,
			
			success: function(data){
				
				fetch_profile_image();
			}
			
		});
		
	});
	
	//fetch profile image
	
	fetch_profile_image();
	
	function fetch_profile_image(){
		 
		 var action = 'fetch_profile_image';
		 
		 $.ajax({
			
			url:'action_messenger.php',
			
			method:'post',
			
			data:{action_profile_image:action},
			
			success: function(data){
				
				$('.messenger-nav-top-image').html(data);
			}
			
		});
	 }
	 
	 
	 //fetch chat users
	
	fetch_chat_users();
	
	function fetch_chat_users(){
		 
		 var action = 'fetch_chat_users';
		 
		 $.ajax({
			
			url:'action_messenger.php',
			
			method:'post',
			
			data:{action_chat_users:action},
			
			success: function(data){
				
				$('.messenger-user-container').html(data);
			}
			
		});
	 }
	 
	 //fetch chat users profile and chat box
	 
	 fetch_chat_users_profile();
	
	function fetch_chat_users_profile(chatId){
		 
		 var action = 'fetch_chat_users_profile';
		 
		 $.ajax({
			
			url:'action_messenger.php',
			
			method:'post',
			
			data:{fetch_chat_users_profile:action, chat_user_Id:chatId },
			
			success: function(data){
				
				$('.messenger-right').html(data);
				
			}
			
		});
	 }
	 
	 //users chat profile click
	 
	 $(document).on('click','.messenger-user-container-inside', function(){
		
		var chatUserId = $(this).attr('id');
		  
		fetch_chat_users_profile(chatUserId);
	
	 });
	 
	 //message chat 
	  
	  var chatEmojis = [];
	 
	 $(document).on('keyup','#chat-type', function(){
		
		var chatType = $(this).val(); 
				
		  if(chatType.length > 0){
			  
			  $('.messenger-chat-send-image').show();
			  
			  $('.messenger-chat-like-image').hide();
			
		   var output = chatType.match(/([\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2694-\u2697]|\uD83E[\uDD10-\uDD5D])/g, ",");
         
		   var result = output.join('');

			   chatEmojis = result;	
		   
		
			 
		  }else{
			  
			  $('.messenger-chat-send-image').hide();
			  
			  $('.messenger-chat-like-image').show();
			 
               chatEmojis = [];
	 			 
		  }
	
	 });
	 
	  //chat send users
	  
	 $(document).on('click','.messenger-chat-send-image', function(){
		
		var chatReceiveId = $(this).attr('id');
		
        var chatMessage = $('#chat-type').val();
			
		   if(chatEmojis == chatMessage){
			  
             var type = 'emoji';
			 
             send_chat_message(chatReceiveId, chatMessage, type);
			 
		   }else{
			   
			 var type = 'text';
			 
             send_chat_message(chatReceiveId, chatMessage, type);
			 
		   }  
	
	 });
	 
	 
	 function send_chat_message(chatReceiveId, chatMessage, type){
		 
		 var action = 'fetch_chat_send';
		 
		 $.ajax({
			
			url:'action_messenger.php',
			
			method:'post',
			
			data:{action_chat_send:action, chat_message:chatMessage, receiver_id:chatReceiveId, chat_type:type },
			
			success: function(data){
				
				fetch_chat_users_profile(chatReceiveId);
				
				$('#chat-type').val('');
				
				fetch_chat_users();
				
				chatEmojis = [];
			}
			
		});
	 }
	 
	 // send chat image  
	 
	 $(document).on('click','.chat-file', function(){
		
		$('#chat-image').trigger('click');
	
	 });
	 
	 $(document).on('change','#chat-image', function(){
		 
		 var chatReceiveId = $(this).data('id');
		
		var file = document.getElementById('chat-image').files[0];
		
		var formData = new FormData();
		
		formData.append('chat_image', file);
		
		formData.append('receiver_id', chatReceiveId);
		
		$.ajax({
			
			url:'action_messenger.php',
			
			method:'post',
			
			data:formData,
			
			contentType:false,
			
			cache:false,
			
			processData:false,
			
			success: function(data){
				
				fetch_chat_users_profile(chatReceiveId);
				
				$('#chat-image').val('');
				
				fetch_chat_users();
			}
			
		});
		
	});
	
	// search users   
	
	$(document).on('keyup','#search-users', function(){
		
		var searchUsers = $(this).val();
		  
		  if(searchUsers != ''){
			  
			  $('.messenger-user-search-container').show();
			  
			  $('.messenger-user-container').hide();
			  
			  fetch_search_users(searchUsers);
			 
		  }else{
			  
			  $('.messenger-user-search-container').hide();
			  
			  $('.messenger-user-container').show();
			  
		  }
	
	 });
	 
	 function fetch_search_users(searchUsers){
		 
		 var action = 'fetch_search_users';
		 
		 $.ajax({
			
			url:'action_messenger.php',
			
			method:'post',
			
			data:{action_search_users:action, search_users:searchUsers},
			
			success: function(data){
				
				$('.messenger-user-search-container').html(data);
			}
			
		});
	 }
	 
	 // search users profile click
	 
	 $(document).on('click','.messenger-user-search-container-inside', function(){
		
		var chatUserId = $(this).attr('id');
		  
		fetch_chat_users_profile(chatUserId);
	
	 });
	 
	 // emoji chat click
	 
	 $(document).on('click','#emoji', function(){
		
		$('.messenger-chat-emoji-container').toggle();
	
	 });
	 
	 $(document).on('click','.emoji-span', function(){
		
		var chatMessage = $('#chat-type').val();
		
		var chatEmoji = $(this).attr('id');
		
		  chatEmojis += chatEmoji;
	 
		var chatEmojiMessage = $('#chat-type').val(chatMessage + chatEmoji);
		
		if(chatEmojiMessage.length > 0){
			  
			  $('.messenger-chat-send-image').show();
			  
			  $('.messenger-chat-like-image').hide();
			
			 
		  }else{
			  
			  $('.messenger-chat-send-image').hide();
			  
			  $('.messenger-chat-like-image').show();
			  
		  }
		  
	 });
	 
	 //setting action
	 
	 $(document).on('click','.setting-arrow', function(){
	
	    $(this).toggleClass('flip');
		
		$('.messenger-action-more').toggle();
		
	 });
	 
	 
 });
 
 function preview(){
	 
	//$('#profile-image').attr('src',URL.createObjectURL(event.target.files[0])); 
	 
 }
 
 