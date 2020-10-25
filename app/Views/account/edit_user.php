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
<form action="<?php echo base_url('account/update_user'); ?>" name="user_create" id="user_create" method="post" accept-charset="utf-8" enctype= multipart/form-data >
<div class="form-group">
<label for="formGroupExampleInput">Name <span style="color:red"> * </span></label>
<input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Please enter name" value="<?php echo $user_details['name']; ?>">
</div> 
<div class="form-group">
<label for="email">Email Id <span style="color:red"> * </span> </label>
<input type="text" name="email" class="form-control" id="email" placeholder="Please enter email id"  value="<?php echo $user_details['email']; ?>" >
</div>   

<div class="form-group">
<label for="contact_no">Contact No <span style="color:red"> * </span></label>
<input type="text" name="contact_no" class="form-control" id="contact_no" placeholder="Please enter Contact No" value="<?php echo $user_details['contact_no']; ?>" >
</div>   


<div class="form-group">
<label for="id_proof">ID Proof</label>
<input type="file" name="id_proof" class="form-control" id="id_proof" placeholder="Please enter email id">

<?php if($user_details['file_path'] != ''){ ?>
<a href="http://localhost/cv4/writable/uploads/<?php echo $user_details['file_path']; ?>" target="_blank"> Download Here </a>
<?php } ?>
</div>   


<div class="form-group">
<button type="submit" id="send_form" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>
<script>
if ($("#user_create").length > 0) {
$("#user_create").validate({
rules: {
name: {
required: true,
},
email: {
required: true,
maxlength: 50,
email: true,
},
contact_no: {
required: true,
maxlength: 10,
number: true,
},   
},
messages: {
name: {
required: "Please enter name",
},
email: {
required: "Please enter valid email",
email: "Please enter valid email",
maxlength: "The email name should less than or equal to 50 characters",
}, 
contact_no: {
required: "Please enter valid contact number",
maxlength: "The Contact Number should less than or equal to 10 characters",
}
},
})
}
</script>
</body>
</html>