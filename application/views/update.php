<?php include('header.php'); ?>
<div class="container">

<?php if(isset($record)){ ?>

		<?php echo form_open('home/update/'.$record->id,['class'=>'form-horizontal']); ?>

	  <fieldset>
	  	<div class="container">
		    
		   		<div class="row">
		   			<div class="col-lg-6">
		   				 <div class="form-group">
						      <label for="InputEmail1" class="col-lg-2 control-label">Name</label>
						      <div class="col-lg-10">
						     	<?php echo form_input(['name'=>'name','class'=>'form-control','placeholder'=>'customer Name','value'=>set_value('name',$record->name)]);?>

						     </div>
				    	</div>
		   			</div>
		   			<div class="col-lg-6">
		   				 <?php echo form_error('name'); ?>
		   			</div>
		   		</div>




		   		<div class="row">
		   			<div class="col-lg-6">
		   				 <div class="form-group">
						      <label for="InputEmail1" class="col-lg-2 control-label">Image</label>
						      <div class="col-lg-10">

						     	<?php echo form_upload(['name'=>'image','class'=>'form-control','placeholder'=>'image','value'=>set_value('image')]);
						      			   				
						     	?> 

						     </div>
						   


				    	</div>
		   			</div>
		   			<div class="col-lg-6">	
		   				<?php echo  $record->image;?>
				<img height="80px" width="80px" src="<?php echo base_url().'upload/'.$record->image;?>">																					     	

						 
		   			</div>
		   		</div>
				   

				<div class="row">
		   			<div class="col-lg-6">
		   				 <div class="form-group">
						      <label for="InputEmail1" class="col-lg-2 control-label">Mobile</label>
						      <div class="col-lg-10">
						     	<?php echo form_input(['name'=>'mobile','class'=>'form-control','placeholder'=>'mobile','value'=>set_value('mobile',$record->mobile)]);?>

						     </div>
				    	</div>
		   			</div>
		   			<div class="col-lg-6">
		   				 <?php echo form_error('mobile'); ?>
		   			</div>
		   		</div>

				<div class="row">
		   			<div class="col-lg-6">
		   				 <div class="form-group">
						      <label for="InputEmail1" class="col-lg-2 control-label">Gender</label>
						      <div class="col-lg-10">
						     	<?php
						     	echo form_dropdown('gender',['male'=>'Male','female'=>'Female']);

						     	 ?>

						     </div>
				    	</div>
		   			</div>
		   			<div class="col-lg-6">
		   				 
		   			</div>
		   		</div>


				<div class="row">
		   			<div class="col-lg-6">
		   				 <div class="form-group">
						      <label for="InputEmail1" class="col-lg-4 control-label">Skills:</label>
						      <div class="col-lg-8">
								   	<?php 
						      		echo form_label('حاسب ألى ', 'Skills');
						      		$data = array(
										    'name'        => 'Skills',
										    'id'          => 'Skills',
										    'value'       => 'حاسب ألى  ',
										    'checked'     => TRUE,
										    'style'       => 'margin:10px',
										    );
						      		echo form_checkbox($data);
						      		echo form_label('أكثر من لغة', 'Skills');
						      		$d = array(
										    'name'        => 'Skills',
										    'id'          => 'Skills',
										    'value'       => 'أكثر من لغة',
										    'checked'     => FALSE,
										    'style'       => 'margin:10px',
										    );
									echo form_checkbox($d);


						      	?>

						     </div>
				    	</div>
		   			</div>
		   			<div class="col-lg-6">
		   				 
		   			</div>
		   		</div>




		   			<div class="row">
		   			<div class="col-lg-6">
		   				 <div class="form-group">
						      <label for="InputEmail1" class="col-lg-2 control-label">CV:</label>
						      <div class="col-lg-10">
						     	<?php echo form_upload(['name'=>'CV','class'=>'form-control','value'=>set_value('CV')]);?>

 		
						     </div>
				    	</div>
		   			</div>
		   			<div class="col-lg-6">
		   				  <?php echo $record->CV;?>
		   				  <a href="<?php echo base_url().'home/download/'.$record->id; ?>" class="dwn">Download</a>
		   				  <a href="<?php echo base_url().'home/view/'.$record->id; ?>" target="_blank" class="dwn">View</a>

		   				  <object data="<?php echo base_url().'home/view/'.$record->id;?>" type="application/pdf" width="300" height="200" alter="notsuprted">
							</object>




		   			</div>
		   		</div>



						<div class="row">
		   			<div class="col-lg-6">
		   				 <div class="form-group">
						      <label for="InputEmail1" class="col-lg-2 control-label">Notes</label>
						      <div class="col-lg-10">
						     	<?php echo form_textarea(['name'=>'Notes','class'=>'form-control','placeholder'=>'Notes','value'=>set_value('Notes',$record->Notes)]);?>

						     </div>
				    	</div>
		   			</div>
		   			<div class="col-lg-6">
		   				 <?php echo form_error('Notes'); ?>
		   			</div>
		   		</div>



		       
		    <div class="form-group">
		    	<div class="col-lg-10" col-lg-offset-2>
		    	  <?php echo form_submit(['value'=>'Submit','class'=>'btn btn-primary']); ?>
		    		<?php echo form_reset(['value'=>'Reset','class'=>'btn btn-default']); ?>

		    	</div>
		    </div>

		</div>
	  </fieldset>
	<?php echo form_close(); ?>
</div>

<?php }else{

	return redirect('home/index');





} ?>


<?php include('footer.php'); ?>