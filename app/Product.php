<?php

namespace App;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int quantity
 * @property int id
 * @property string description
 * @property int unit_price
 */
class Product extends Model implements Buyable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'barcode', 'unit_price', 'quantity', 'company_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'company_id'
    ];

    /**
     * Return true if the stock quantity for the product is less
     * than 25 units.
     *
     * @return boolean true if the product should be reordered,
     * false otherwise.
     */
    public function needsReorder()
    {
        return $this->quantity < 25;
    }

    /**
     * Return the product if it exists, false otherwise.
     *
     * @param int $product_id
     *
     * @return Product|false the product if it exists, false otherwise.
     */
    public static function get(int $product_id)
    {
        return self::where('id', $product_id)->first();
    }

    /**
     * Check if the product is available in the desired quantity.
     *
     * @param int $quantity
     *
     * @return bool true if the product is available (the product exists
     *              and the quantity requested is greater or equal to the quantity in stock),
     *              false otherwise.
     */
    public function isQuantityAvailable(int $quantity)
    {
        $db_product = self::get($this->id);
        if (!$db_product) {
            return false;
        }

        return $quantity <= $db_product->quantity;
    }

    private function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this->save();
    }

    /**
     * Remove the desired quantity from this product.
     *
     * @param int $quantity the quantity to remove from the stock.
     *
     * @return bool true if the quantity was removed, false otherwise.
     */
    public function removeFromStock(int $quantity)
    {
        if ($quantity > $this->quantity) {
            return false;
        }

        return $this->setQuantity($this->quantity - $quantity);
    }

    /**
     * Eloquent relationship to Manufacturer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->description;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->unit_price;
    }
}
