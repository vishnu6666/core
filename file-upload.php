++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
SINGLE FILE UPLOAD
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

<form method="POST" action="<?php echo base_url('gastronomy/gastronomy-create')?>" enctype='multipart/form-data'>
	<div class="form-group">
		<label>Image</label>
		<input type="file" autofocus="" name="filedata"  id="filedata" class="form-control"  required>
	</div>
</form>

<?php 
// Controller file 
if ($_FILES['filedata']['name']) {
	$config['upload_path']          = './assets/upload/gastronomy/image/';
	$config['allowed_types']        = '*';
	$config['max_size']             = '*';
	$config['max_width']            = '*';
	$config['max_height']           = '*';
	$config['encrypt_name']         = TRUE;

	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	if ($this->upload->do_upload('filedata'))
	{
		$image =$this->upload->data();
		$image_upload = $image['file_name'];
		echo "success uploaded";
		echo $image_upload; // Get image encripted name
		exit;
	}else{
		$error = array('error' => $this->upload->display_errors()); // Get error 
		$this->session->set_userdata(array('error_msg'=>'image_not_uploaded'));
		redirect(base_url('gastronomy'));
	}
}

?>

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Multiple FILE UPLOAD
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

<form method="POST" action="<?php echo base_url('gastronomy/gastronomy-create')?>" enctype='multipart/form-data'>
	<div class="form-group">
		<label>Image Gallery</label>
		<div class="field" align="left">
			<input type="file" id="files" name="files[]" class="form-control" multiple="" required />
		</div>
	</div>
</form>

<?php 
// Controller file 
$data = [];
$count = count($_FILES['files']['name']);

for($i=0;$i<$count;$i++){
	if(!empty($_FILES['files']['name'][$i])){
		$_FILES['file']['name']     = $_FILES['files']['name'][$i];
		$_FILES['file']['type']     = $_FILES['files']['type'][$i];
		$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
		$_FILES['file']['error']    = $_FILES['files']['error'][$i];
		$_FILES['file']['size']     = $_FILES['files']['size'][$i];

		$config['upload_path']      = './assets/upload/gastronomy/gallery/'; 
		$config['allowed_types']    = '*';
		$config['max_size']         = '*';
		$config['encrypt_name']     = TRUE;
      //$config['file_name']        = $_FILES['files']['name'][$i]; //IF need file name without encription

		$this->load->library('upload',$config); 
		$this->upload->initialize($config);

		if($this->upload->do_upload('file')){
			$uploadData = $this->upload->data();
			$filename = $uploadData['file_name'];
			$data['gallery'][] = $filename;   // Get file encripted name              
		}
	}
}
echo "gallery array";
echo "<pre>";
print_r($data);
exit;

?>