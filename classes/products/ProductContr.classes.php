<?php
include_once("../classes/Upload.classes.php");
include_once("../classes/Config_session.class.php");
class ProductContr extends Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $img;
    private $quantity;
    private $tag;

    private $redirect_cad_path = "../prod_cad.php";
    private $redirect_list_path = "../prod_list.php";

    public function __construct($id = null, $name = null, $description = null, $price = null, $img = null, $quantity = null, $tag = null)
    {
        $this->name  = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img = $img;
        $this->quantity = $quantity;
        $this->tag = $tag;

        if ($id == null) {
            $this->id = parent::get_id_by_name($this->name);
        } else {
            $this->id = $id;
        }
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
        //Checa se o produto já está cadastrado
        if (parent::get_product_model($this->id)) {
            return true;
        } else {
            return false;
        }
    }

    private function is_products_empty($products)
    {
        //Checa se a table de produtos está vazia
        if (!$products) {
            return true;
        } else {
            return false;
        }
    }


    //Cadastro

    public function cad_product()
    {
        //Insere as informações do produto no banco de dados
        $user_id = null;
        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
        }
        if ($this->is_input_empty()) {
            header("Location:" . $this->redirect_cad_path . "?error=input_empty");
            die();
        }

        if ($this->is_product_registered()) {
            header("Location:" . $this->redirect_cad_path . "?error=product_already_registered");
            die();
        }

        $upload = new Upload();
        $img_path = $upload->upload_image($this->img, $this->redirect_cad_path);
        parent::set_product($this->name, $user_id, $this->description, $this->price, $img_path, $this->quantity, $this->tag);

        
        
    }

    //Listagem

    public function get_all_products($redirect_error_path)
    {
        //Pega todos os produtos do banco de dados
        $products =  parent::get_all_products_model();
        if ($this->is_products_empty($products)) {
            header("Location:" . $redirect_error_path . "?error=empty");
            die();
        }

        $session = new Config_Session();
        $session->init();

        $_SESSION["products"] = $products;
       
       
    }
    
    public function get_product($redirect_error_path)
    {
        //Pega um produto especifico do banco de dados
        $product =  parent::get_product_model($this->id);
        if(!$product){
            header("Location:" . $redirect_error_path . "?error=not_found");
            die();
        }
        return $product;
        die();
    }

    public function search_product($search, $redirect_error_path)
    {
        if (empty($search)) {
            header("Location:" . $redirect_error_path . "?error=empty_search");
            die();
        }

        $products = parent::search_product_model($search);

        if ($this->is_products_empty($products)) {
            header("Location:" . $redirect_error_path . "?error=empty");
            die();
        }

        $session = new Config_Session();
        $session->init();

        $_SESSION["products"] = $products;
       
    }

     public function search_product_by_tag($search, $redirect_error_path)
    {
        if (empty($search)) {
            header("Location:" . $redirect_error_path . "?error=empty_search");
            die();
        }

        $products = parent::search_product_by_tag_model($search);

        if ($this->is_products_empty($products)) {
            header("Location:" . $redirect_error_path . "?error=empty");
            die();
        }

        $session = new Config_Session();
        $session->init();

        $_SESSION["products"] = $products;
    }


    //Edição
    public function delete_product()
    {
        //Deleta um produto do banco de dados
        parent::delete_product_model($this->id);
    }

    public function update_product()
    {
        //Atualiza um produto no banco de dados
        parent::update_product_model($this->id, $this->name, $this->description, $this->price, $this->img, $this->quantity, $this->tag);
    }


}
