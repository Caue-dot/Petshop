<?php
include_once("../classes/Upload.classes.php");
include_once("../classes/Config_session.class.php");
class ProductContr extends Product
{
    private $name;
    private $description;
    private $price;
    private $img;
    private $redirect_cad_path = "../prod_cad.php";
    private $redirect_list_path = "../prod_list.php";

    public function __construct($name = null, $description =null, $price=null, $img=null)
    {
        $this->name  = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img = $img;
    }


    //Error Handlers
    private function is_input_empty(): bool
    {
        //Checa se os inputs estão vazios
        if (empty($this->name) || empty($this->description) || empty($this->price) || !isset($this->img)) {
            return true;
        } else {
            return false;
        }
    }


    private function is_product_registered()
    {
        if (parent::get_product_by_name($this->name)) {
            return true;
        } else {
            return false;
        }
    }

    private function is_products_empty($products){
        if(!$products){
            return true;
        }else{
            return false;
        }
    }


    //Cadastro

    public function cad_product(){
        $user_id = null;
        if(isset($_SESSION["user_id"])){
            $user_id = $_SESSION["user_id"];
        }
        if($this->is_input_empty()){
            header("Location:".$this->redirect_cad_path."?error=input_empty");
            die();
        }

        if($this->is_product_registered()){
            header("Location:".$this->redirect_cad_path."?error=product_already_registered");
            die();
        }

        $upload = new Upload();
        $img_path = $upload->upload_image($this->img, $this->redirect_cad_path);
        parent::set_product($this->name, $user_id ,$this->description, $this->price, $img_path);

        header("Location:".$this->redirect_cad_path."?cad=success");
        die();
    }  
    
    //Listagem
    
    public function get_products(){
       $products =  parent::get_products();
       if($this->is_products_empty($products)){
            header("Location:".$this->redirect_list_path."?error=empty");
            die();
       }

       $session = new Config_Session();
       $session->init();

       $_SESSION["products"] = $products;
       header("Location:".$this->redirect_list_path."?list=success");
       die();
    }

    public function delete_product($id)
    {
        parent::delete_product($id);
    }
}
