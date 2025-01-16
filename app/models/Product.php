<?php
require_once "../../core/Database.php";
class Product
{
    private int $productId;
    private string $productName;
    private string $price;
    private string $description;
    private string $imagePath;

    public function __construct(int $product_id, string $product_name, string $description,float $price, string $img_path){
        $this->productId = $product_id;
        $this->productName = $product_name;
        $this->description = $description;
        $this->price = $price;
        $this->imagePath = $img_path;
    }

    static public function getProductById($id): Product | null
    {
        $product_row = run_select_query("SELECT * FROM products WHERE id = '$id'");

        if ($product_row->num_rows > 0) {
            $product_data = $product_row->fetch_assoc();

            return new Product(
                $product_data['product_id'],
                $product_data['product_name'],
                $product_data['description'],
                $product_data['price'],
                $product_data['img_path']
            );
        }
        return null;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

}