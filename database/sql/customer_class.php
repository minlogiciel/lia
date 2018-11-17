<?php
class customer_class  {

	var $table_name   	= "CUSTOMER_V20";
	
	var $PID      		= "PID";
	var $CUSTOMERIP     = "CUSTOMERIP";
	var $PRODUITS       = "PRODUITS";
	var $CREATETIME     = "CREATETIME";
	var $LASTMODIF      = "LASTMODIF";

	var $connection		= '';

	function connect() {
		if (!$this->connection)
			$this->connection = new sql_class();
		return $this->connection;
	}

	function close() {
		if ($this->connection) {
			$this->connection->close();
			$this->connection = '';
		}
	}

	/* get customer id */
	function getCustomerID($customer_ip) {
		$pid = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->table_name, $this->CUSTOMERIP,  $customer_ip);
		if ($elem) {
			$pid = $elem[$this->PID];
		}
		$this->close();
		return $pid;
	}

	/* add customer buy produit */
	function addBuyProduit($customer_ip, $pcode, $price, $promo, $color, $size, $num) {
		$customer_id = $this->getCustomerID($customer_ip);
		$buy_class = new buy_produit_class;
		$pid = $buy_class->addProduit($customer_id, $customer_ip, $pcode, $price, $promo, $color, $size, $num);
		
		$shopping_cart 	= new shopping_cart;
		$c_id = $shopping_cart->addToCart($customer_ip, $pid);
		if (($customer_id == 0) && ($c_id > 0) ) {
			$buy_class->updateCustomerID($c_id, $customer_ip, $pcode, $price, $promo, $color, $size, $num);
		}
	}
		/* add customer buy produit */
	function addCustomerBuyProduit($customer_ip, $pcode, $price, $promo, $color, $size, $num) {
		$customer_id = $this->getCustomerID($customer_ip);
		$buy_class = new buy_produit_class;
		$pid = $buy_class->addProduit($customer_id, $customer_ip, $pcode, $price, $promo, $color, $size, $num);
		
		$shopping_cart 	= new shopping_cart;
		$c_id = $shopping_cart->addToCart($customer_ip, $pid);
		if (($customer_id == 0) && ($c_id > 0) ) {
			$buy_class->updateCustomerID($c_id, $customer_ip, $pcode, $price, $promo, $color, $size, $num);
		}
	}
	
	/* produit total */
	function getCustomerBuyProduitTotal($customer_ip) {
		$price = 0.0;
		$customer_id = $this->getCustomerID($customer_ip);
		$shopping_cart 	= new shopping_cart;
		$produits = $shopping_cart->getCustomerBuyProduits($customer_ip);
		if ($produits) {
			$price = 0.0;
			for ($i = 0; $i < count($produits); $i++) {
				$pp = $produits[$i]->getPrice();
				$nn = $produits[$i]->getNumber();
				$price  = $price + $pp * $nn;
			}
		}
		return $price;
	
	}

	/* used for testing */
	function getAllCustomers() {
		$exec = $this->connect();
		$elems = $exec->get_all_elements_array($this->table_name);
		$customers = array();
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$customer = new customer_base();
				$customer->setData($elems[$i]);
				$customers[] = $customer;
			}
		}
		$this->close();
		return $customers;
	}
}
?>
