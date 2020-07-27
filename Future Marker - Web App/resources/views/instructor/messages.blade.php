@extends('layouts.instructorNavbar')

@section('content')

<!DOCTYPE html>
<html>

<head>
	<title>Chat</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
		integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
	</script>
	<link href="{{ asset('CSS/message.css') }}" rel="stylesheet">

</head>

<body>
	<div class="container-fluid h-100">
		<div class="row justify-content-center h-100">
			<div class="col-md-4 col-xl-3 chat">
				<div class="card mb-sm-7 mb-md-0 contacts_card">
					<div class="card-header">
						<form method="POST" action="{{ route('instructor.message.search') }}" id="search_form"
							enctype="multipart/form-data">
							<div class="input-group">
								@csrf
								<input type="text" placeholder="Search..." name="search" id="search"
									class="form-control search">
								<div class="input-group-prepend">
									<span class="input-group-text search_btn"><i
											onclick="document.getElementById('search_form').submit()"
											class="fas fa-search"></i></span>
								</div>
							</div>
						</form>

					</div>
					<div class="card-body contacts_body">
						<ul class="contacts">
							@if($active)
							<li class="active">
								<div class="d-flex bd-highlight">
									<div class="img_cont">
										<img src="{{asset($active['image'])}}" class="rounded-circle user_img">
									</div>
									<div class="user_info">
										<span>{{$active['name']}}</span>
									</div>
								</div>
							</li>
							@endif
							@foreach($contacts as $contact)
							@if($contact['id'] != $active['id'] )
							<a href="{{ route('instructor.message.show',$contact['id'])}}">
								<li>
									<div class="d-flex bd-highlight">
										<div class="img_cont">
											<img src="{{asset($contact['image'])}}" class="rounded-circle user_img">
										</div>
										<div class="user_info">
											<span>{{$contact['name']}}</span>
										</div>
									</div>

								</li>
							</a>
							@endif
							@endforeach



						</ul>
					</div>
					<div class="card-footer">
						<button class="btn btn_mess btn-lg btn-block" data-toggle="modal" data-target="#new_message">+
							new message</button>
					</div>
					<div class="modal fade" id="new_message" tabindex="-1" role="dialog"
						aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header border-bottom-0">
									<h5 class="modal-title" id="exampleModalLabel">New Message</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form method="POST" action="{{ route('instructor.message.newMessage') }}"
									enctype="multipart/form-data">
									<div class="modal-body text-center">
										@csrf
										<div class="form-group">
											<input type="text" class="form-control" name="email" id="email"
												placeholder="Send to ( Email )" required>
										</div>
										<div class="form-group">
											<textarea class="form-control" name="content" id="content"
												placeholder="content" required></textarea>
										</div>

										<div class="form-group">
											<label for="uploadedfiles">Choose file</label>
											<input type="file" id="uploadedfiles" name="uploadedfiles[]"
												class="text-center center-block file-upload" style="margin-left: 40px;"
												multiple>
										</div>
									</div>
									<div class="modal-footer border-top-0 d-flex justify-content-center">
										<button type="submit" class="btn btn-outline-secondary ">Send</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-xl-6 chat">
				<div class="card">
					<div class="card-header msg_head">
						<div class="d-flex bd-highlight">
							<div class="img_cont">
								@if($active)
								<img src="{{asset($active['image'])}}" class="rounded-circle user_img">
								@endif
							</div>
							<div class="user_info">
								<span>{{$active['name']}}</span>
							</div>

						</div>

					</div>
					<div class="card-body msg_card_body">
						@if($messages)
						@foreach($messages as $message)
						@if($message['fromUser']['id'] == $active['id'])
						<div class="d-flex justify-content-start mb-4">
							<div class="img_cont_msg">
								<img src="{{asset($message['fromUser']['image'])}}" class="rounded-circle user_img_msg">
							</div>
							<div class="msg_cotainer">
								{{$message['message_content']}}
								@foreach($message['attachmentFiles'] as $key => $value)
								<div class="alert alert-info">
									<a href="{{ $value }}" download><strong>{{ $key }}</strong></a>
								</div>
								@endforeach
								<span class="msg_time">{{$message['created_at']}}</span>
							</div>
						</div>
						@else
						<div class="d-flex justify-content-end mb-4">
							<div class="msg_cotainer_send">{{$message['message_content']}}
								@foreach($message['attachmentFiles'] as $key => $value)
								<div class="alert alert-info">
									<a href="{{ $value }}" download><strong>{{ $key }}</strong></a>
								</div>
								@endforeach
								<span class="msg_time_send">{{$message['created_at']}}</span>
							</div>
							<div class="img_cont_msg">
								<img src="{{asset($message['toUser']['image'])}}" class="rounded-circle user_img_msg">
							</div>
						</div>
						@endif
						@endforeach
						@endif

					</div>
					<div class="card-footer">
						<form method="POST" action="{{ route('instructor.message.sendMessage',$active['id'] ?? '' ) }}"
							id="send_form" enctype="multipart/form-data">
							@csrf
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i
											onclick="document.getElementById('sendFiles').click()"
											class="fas fa-paperclip"></i></span>
									<input type="file" style="display: none" id="sendFiles" name="sendFiles[]" />
								</div>
								<textarea name="content" id="content" class="form-control type_msg"
									placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									@if($active)
									<span class="input-group-text send_btn"><i
											onclick="document.getElementById('send_form').submit()"
											class="fas fa-location-arrow"></i></span>
									@else
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
									@endif
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

@endsection