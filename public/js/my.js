$(".menu1").next('ul').toggle();

$(".menu1").click(function(event) {
	$(this).next("ul").toggle(500);
});

//Chức năng submit form đăng nhập qua ajax
$('#loginform').submit(function(e){
	e.preventDefault();
	$.ajax({
		// headers: {
		//   	'X-CSRF-TOKEN': $('#_token').val()
		// },
		url: 'dangnhap',
		datatType : 'json',
		type: 'POST',
		data: {
			'email' : $('#email').val(),
			'password': $('#password').val()
		},
		//cache: false,
		success:function(result) {
			//alert(result['errorcode']+"-"+result['message']);
			if(result['errorcode']==1)
				$('#loginerror').text(result['message']);
			else{
				$('#username').text(result['message']);
				//đóng cửa sổ đăng nhập
				$('#loginModal').modal('hide');
			}
		}
	});
	return false;
});