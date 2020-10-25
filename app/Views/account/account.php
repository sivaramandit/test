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
<div class="col-md-12">
  Hi...<?php echo $name; ?> <a href="<?php echo base_url('account/edit_profile'); ?>"> Edit </a> / <a href="<?php echo base_url('login/logout'); ?>"> Logout </a>
</div>
<div class="col-md-12">


<form action="<?php echo base_url('account/update_my_favirite'); ?>" name="myfav" id="myfav" method="post" accept-charset="utf-8">

  <?= csrf_field() ?>



<div class="col-md-6">

<div class="form-group">
<label for="formGroupExampleInput">USD</label>

<input type="text" readonly id="source" name="source" class="form-control" value="USD" id="formGroupExampleInput">

</div> 

</div>



<div class="col-md-6">

<div class="form-group">
<label for="formGroupExampleInput">Currency <span style="color:red"> * </span></label>

 <select name="destination" id="destination" class="form-control" onchange="get_convertion()">

 	 <option value=""> </option>

 	 <?php foreach($currencies as $currency){ ?>

 	 	 <option value="<?php echo $currency['currency_code']; ?>"><?php echo $currency['currency_name']; ?></option>

 	 <?php } ?>


 </select>

</div> 

</div>

<div class="col-md-6">

<div class="form-group">
<label for="formGroupExampleInput">Currency Value </label>

<input type="text" readonly id="convertion" class="form-control"  id="formGroupExampleInput">

</div> 

</div>

<div class="form-group">
<button type="submit" id="send_form" class="btn btn-success">Update as My Faviourite</button>

</div>


</form>



</div>

<div class="row">
<div class="col-md-9">

  <table class="table table-bordered">

    <tr>

      <td> S.No</td>
      <td> Source</td>
      <td> Destination</td>
      <td> Convertion Rate</td>

    </tr>

    <?php $no = 1; foreach($userCurrency as $cu){ ?>

    <tr> 
    
    <td> <?php echo $no; ?></td>
    <td> <?php echo $cu['source']; ?></td>
    <td> <?php echo $cu['destination']; ?></td>
    <td> <?php echo $cu['convertion_value']; ?></td>

  </tr>


   <?php $no = $no +1;  } ?>


  </table>


</div>
</div>

</div>
</div>

</body>

<script type="text/javascript">

	function get_convertion(){
		 var source = $("#source").val();
		 var destination = $("#destination").val();


      if(destination != ''){
      	   $.ajax({
          dataType: 'json',
          type: 'POST',
          url: '/account/currency_convertion',
          data: {source : source, destination : destination},
          success: function(data) {
           $("#convertion").val(data.convertion);
             
          } 
      });
      	}else{
      		$("#convertion").val('');
      	}

		

	}
	


</script>
</html>