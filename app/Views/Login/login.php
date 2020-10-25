<!DOCTYPE html>
<html>
<head>
<title>Codeigniter 4 User Form With Validation Example</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
</head>
<body>
<div class="container">
<br>
<?= \Config\Services::validation()->listErrors(); ?>
<span class="d-none alert alert-success mb-3" id="res_message"></span>
<div class="row">
<div class="col-md-9">
<form action="login/auth_login" name="user_login" id="user_login" method="post" accept-charset="utf-8">

	<?= csrf_field() ?>

<div class="form-group">
<label for="formGroupExampleInput">Email ID</label>
<input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Please enter name">
</div> 
<div class="form-group">
<label for="password">Password</label>
<input type="password" name="password" class="form-control" id="password" placeholder="Please enter email id">
</div>   
<div class="form-group">
<button type="submit" id="send_form" class="btn btn-success">Submit</button>
<a href="/register" > Register here </a>
</div>
</form>
</div>
</div>




</div>
<script>
if ($("#user_login").length > 0) {
$("#user_login").validate({
rules: {
email: {
required: true,
maxlength: 50,
email: true,
},
password: {
required: true,
minlength: 3,
maxlength: 50,
} 
},
messages: {
email: {
required: "Please enter valid email",
email: "Please enter valid email",
maxlength: "The email name should less than or equal to 50 characters",
}, 
password: {
required: "Please enter valid password",
password: "Please enter valid password",
maxlength: "The email name should more than 3 characters",
}
},
})
}
</script>
</body>
</html>