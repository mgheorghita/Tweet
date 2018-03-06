<?php
    class Upload{
		
        function image($image, $user)
        {
            
            if($this->uploadErrors($image) != 0){
                if($this->uploadErrors($image) != 4){
                    $response['error'] = $this->error_array[$this->message];
                }
            }else{
                if($this->isImage($image) == False){
                    $response['error'] = 'This file is not an image. <br> Please upload an image as avatar';
                }else{
                    $move = $this->move($image, $user);
                    if($move !== False){
                        $response['success'] = $move;
                    }else{
                        $response['error'] = 'The upload failed. Please try again';
                    }
                }
            }
            if(isset($response)){
                return $response;
            }
        }         


        function move($imagine, $user)
        {
            $this->name = $imagine['name'];
            $path = $_SERVER["DOCUMENT_ROOT"];
            $path = rtrim($path, '/') . '/';
            $this->uploads_dir = $path . 'images/users';
			$extension = '';
			
			switch(mime_content_type($imagine['tmp_name'])){
				case 'image/gif': $extension = '.gif';
				case 'image/jpeg': $extension = '.jpg';
				case 'image/png': $extension = '.png';				
			}
			
			$name = $user.'-'.time().$extension;
			
			
            
            if(move_uploaded_file($imagine['tmp_name'], $this->uploads_dir . "/" . $name)){
                    return 'images/users'. "/" . $name;
            }else{
                    return False ;
            }
        }
		
		
        function uploadErrors($file){
            $this->error = $file['error'];

            $this->error_array = [
                    "0" => 0,
                    "1" => "The file is too big",
                    "2" => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                    "3" => "The uploaded file was only partially uploaded",
                    "4" => "No file was uploaded",
                    "6" => "Missing a temporary folder",
                    "7" => "Failed to write file to disk",
                    "8" => "A PHP extension stopped the file upload"
            ];

            switch($this->error){
                    case 0:
                            $this->message = 0;
                            break;
                    case 1:
                            $this->message = 1;
                            break;
                    case 2:
                            $this->message = 2;
                            break;
                    case 3:
                            $this->message = 3;
                            break;
                    case 4:
                            $this->message = 4;
                            break;
                    case 6:
                            $this->message = 6;
                            break;
                            break;
                    case 7:
                            $this->message = 7;
                            break;
                    case 8:
                            $this->message = 8;
                            break;
            }
            return $this->message;
	}
                
        function isImage($imagine){
            $this->message = $imagine['error'];
            if(isset($imagine['tmp_name'])){
                $this->check = getimagesize($imagine['tmp_name']);

                $this->extension = mime_content_type($imagine['tmp_name']);
                //$this->allowedExtensions = array('image/jpeg', 'image/jpg');

                if($this->check != 0 /*&& in_array($this->extension, $this->allowedExtensions)*/)
                {
                    //echo $this->extension;
                    return True;
                }
                else
                {
                    return False;
                }
            }
        }
    }
?>