<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Home extends CI_Controller{

		public function __construct()
 		{
			  parent::__construct();
			  if(!$this->session->userdata('name'))
			  {
			  	            $this->load->helper('file');    

			   redirect('login');


			  }else{
			  		?>
			  	<div class="row" style="padding-left: 970px;">
			  	
				<h4 class="font-weight-bold"> <?php echo "Welcome ". $this->session->userdata('name');?> </h4>
				<div ><?php echo anchor("private_area/logout/",'logout',['class'=>'btn btn-secondary btn-sm']);?>
				</div>
			</div>
			  	<?php 
			  		

			  }


 		}


				//for view data
			public function index(){
			$this->load->model('crud');
			$records=$this->crud->getRecords();
			$this->load->view('create',['records' =>$records]);
		}

		


			//fpr insert data
			public function save(){

			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('mobile', 'mobile', 'required');
			$this->form_validation->set_rules('Notes', 'Notes', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			if ($this->form_validation->run())
			{	$data=$this->input->post();
				$file=$this->upload('image');
				$data['image']=$file;

				$filscv=$this->uploadcv('CV');
				$data['CV']=$filscv;


				$this->load->model('crud');
				$records=$this->crud->saveRecord($data);
				if($records){

					$this->session->set_flashdata('response','Record saved successfully');
				}else{
					$this->session->set_flashdata('response','Record failed to save');
					}
					return redirect('home/index');
			}
			else
			{
				$this->load->view('create');
			}



		}

				///for delete

			public function delete($record_id){

			$this->load->model('crud');
			if ($this->crud->deleteRecord( $record_id)) {
				$this->session->set_flashdata('response','Record Deleted successfully');

			}else{
			   $this->session->set_flashdata('response','Record failed to Delete');

			}
				return redirect('home/index');
		}


	public function edit($record_id){
			$this->load->model('crud');
			$record=$this->crud->getAllRecords($record_id);
			$this->load->view('update',['record'=>$record]);


		}

		public function update($record_id){
				$this->form_validation->set_rules('name', 'name', 'required');
				$this->form_validation->set_rules('mobile', 'mobile', 'required');
				$this->form_validation->set_rules('Notes', 'Notes', 'required');
				$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

				if ($this->form_validation->run())
				{	$data=$this->input->post();
					$this->load->model('crud');
					if(empty($data['image'])) {
						unset($data['image']);
						
					}
					if(empty($data['CV'])) {
						unset($data['CV']);
						
					}

					if($this->crud->updateRecord($record_id,$data)){

						$this->session->set_flashdata('response','Record Updated successfully');
					}else{
						$this->session->set_flashdata('response','Record failed to Update');
						}
						return redirect('home/index');

				}
				else
				{
					$this->load->view('update');
				}
		}




/////////////////upload image
 
	public function upload($file)
	{
		
	
		//if($this->input->post('submit')){
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '1000';
		$this->load->library('upload',$config);
		$this->upload->do_upload($file); 
		
		return $this->upload->file_name;
}



/////////////////////////////////////upload vc


 
	public function uploadcv($filscv)
	{
		
	
		$configc['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';

		//$configc['max_size']	= '10000000';
		$this->load->library('upload',$configc);
		$this->upload->do_upload($filscv); 
		return $this->upload->file_name;

		/*echo '<pre>';
		print_r($this->upload) ;
		var_dump($this->upload);
		echo '</pre>';
		die;*/

}


////////////download cv file

	public function download($record_id){

			if (!empty($record_id)) {
				$this->load->helper('download');
				$this->load->model('crud');
				$fileInfo=$this->crud->getAllRecords($record_id);
				 $file = 'upload/'.$fileInfo->CV;
				/*echo '<pre>';
				print_r($fileInfo->CV) ;
				echo '</pre>';
					die;*/

					
				$data = 'Here is some text!';
       // $data = file_get_contents('upload/'.$fileInfo->CV);

				 force_download($file,$data );
				 return redirect('home/index');
 

			}
				
			
			}

			///////////view cv file

			function view($record_id){
				$this->load->model('crud');
				$fileInfo=$this->crud->getAllRecords($record_id);

   			$path ='upload/'.$fileInfo->CV;
   			header('Content-type:application/pdf');
   			header('Content-Description:inline;filename="'.$path.'"');
   			header('Content-Transfer-Encoding:binary');
   			header('Accept-range:bytes');
   			readfile($path);
			
					

        }
	

		

	}





 ?>