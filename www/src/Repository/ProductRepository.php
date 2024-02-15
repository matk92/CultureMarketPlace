<?php

namespace App\Repository;

use App\Core\Repository;
use App\Models\Category;

class ProductRepository extends Repository
{

    public function getAll(int $limit = null, int $offset = null, string $return = "object"): array
    {
        $sql = "SELECT p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived, COALESCE(AVG(r.rating), 0) AS rating, c.name AS categoryname, c.id AS categoryid, c.unit AS categoryunit
        FROM $this->tableName p
        LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_review r ON p.id = r.productid 
        LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_category c ON p.categoryid = c.id 
        WHERE p.archived = false ";

        $sql .= "GROUP BY p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived, c.name, c.id, c.unit";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        return $this->fetch($sql);
    }

    public function getAllByCategory(int $category, int $limit = null, int $offset = null): array
    {
        $sql = "SELECT p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived, COALESCE(AVG(r.rating), 0) AS rating
            FROM $this->tableName p
            LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_review r ON p.id = r.productid 
            WHERE p.categoryid = :categoryid AND p.archived = false ";

        $sql .= "GROUP BY p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        return $this->fetch($sql, [":categoryid" => $category]);
    }

    public function delete(int $id): bool
    {
        $sql = "UPDATE $this->tableName SET archived = true WHERE id = :id";
        $execute = [":id" => $id];

        return $this->execute($sql, $execute);
    }

    public function getSalesStats(): array
    {
        $sql = "SELECT 
                    p.name AS product, 
                    SUM(os.quantity) AS sales
                FROM " . $_ENV["BDD_PREFIX"] . "_order_slot os
                LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_product p ON os.productId = p.id
                GROUP BY 
                    p.name
                ORDER BY 
                    sales DESC
                LIMIT 6;";

        return $this->fetch($sql, null, \PDO::FETCH_ASSOC);
    }

    public function getSalesByMonthStats(): array
    {
        $sql = "SELECT 
                    DATE_TRUNC('month', o.inserted) AS month_date, 
                    TO_CHAR(o.inserted, 'Month') AS month,
                    SUM(os.quantity) AS sales
                FROM 
                    " . $_ENV["BDD_PREFIX"] . "_order o
                LEFT JOIN 
                    " . $_ENV["BDD_PREFIX"] . "_order_slot os ON o.id = os.orderId
                WHERE 
                    o.inserted <= NOW() - INTERVAL '6 months'
                GROUP BY 
                    month,
                    month_date
                ORDER BY 
                    month_date ASC;";

        return $this->fetch($sql, null, \PDO::FETCH_ASSOC);
    }

    public function getSalesByCategoryStats(): array
    {
        $sql = "SELECT 
                    c.name AS category, 
                    SUM(os.quantity) AS sales
                FROM 
                    rbnm_order_slot os
                LEFT JOIN 
                    rbnm_product p ON os.productId = p.id
                LEFT JOIN 
                    rbnm_category c ON p.categoryId = c.id
                GROUP BY 
                    category
                ORDER BY 
                    sales DESC;";

        return $this->fetch($sql, null, \PDO::FETCH_ASSOC);
    }
}
