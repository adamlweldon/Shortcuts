<?php 
	
	/**
	*USER CLASS 
	*/
	class User
	{
		public function insertUser()
		{
			// echo 'this is where you insert a user';
			// printer($this);
			$query = "INSERT INTO users SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `telephone` = :phone, `password` = :password, `created_at` = now()";
			$prepare = array(':firstname' => $this->first_name, ':lastname' => $this->last_name, ':email' => $this->email, ':phone' => $this->telephone, ':password' => $this->password);		
			$results=RECORD::execute($query, $prepare);
			// echo "all done";
			// exit;
		}

	}






?>