<?php
//require_once "../../core/Database.php";
class Product
{
    public function __construct(int $product_id, string $product_name, string $description,float $price, string $img_path){
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->description = $description;
        $this->price = $price;
        $this->img_path = $img_path;
    }

//    static public function getProductById($id): Product | null
//    {
//        $product_row = run_select_query("SELECT * FROM products WHERE id = '$id'");
//
//        if ($product_row->num_rows > 0) {
//            $product_data = $product_row->fetch_assoc();
//
//            return new Product(
//                $product_data['product_id'],
//                $product_data['product_name'],
//                $product_data['description'],
//                $product_data['price'],
//                $product_data['img_path']
//            );
//        }
//        return null;
//    }
}