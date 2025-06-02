<?php



define('SITE_ROOT', realpath(dirname(dirname(__FILE__))));

class Upload
{
    public function upload_image(array $file, $error_redirect_page)
    {
        $errors = [];
        $target_dir = "img_uploads/";
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        if (empty($file["tmp_name"])) {
            header("Location:".$error_redirect_page."?error=file_empty");
            die();
        }
        //Checa se a imagem é uma imagem falsa
        if (isset($_POST["submit"]) && !empty($file["tmp_name"])) {
            $check = getimagesize($file["tmp_name"]);
            if ($check == false) {
                header("Location:".$error_redirect_page."?error=not_an_image");
                die();
            }
        }


        if (file_exists(SITE_ROOT . "/" . $target_file)) {
            header("Location:".$error_redirect_page."?error=file_already_exists");
            die();
        }


        if ($file["size"] > 500000) {
            header("Location:".$error_redirect_page."?error=file_too_big");
            die();
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            header("Location:".$error_redirect_page."?error=type_file_not_supported");
            die();
        }

        
       

        if (move_uploaded_file($file["tmp_name"],  SITE_ROOT . "/" . $target_file)) {
            return $target_file;
        } else {
            header("Location:".$error_redirect_page."?error=unexpected_error");
            return false;
        }
    }

    public function delete_image(string $file)
    {
        if (file_exists(SITE_ROOT ."/".$file)) {
            unlink(SITE_ROOT ."/".$file);
        } else {
            return "Essa imagem não existe";
        }
    }
}
