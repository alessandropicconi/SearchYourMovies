<?php 

namespace App;



class User {
/*
    public $name;
    public $color;
  
    // Methods
    function set_name($name) {
      $this->name = $name;
    }

    function get_name() {
      return $this->name;
    }
*/
    
    

    public function doLogin($email,$pass){
        

    include "db/db_conn.php";
        
	// verifica che i campi user_name e password siano stati inviati tramite il metodo POST
	if (isset($_POST['email']) && isset($_POST['password'])) {

	// definisce una funzione per validare l'input
	function valid_input($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	// valida i campi user_name e password
	$email = valid_input($_POST['email']);
	$pass = valid_input($_POST['password']);

	// se user_name o password sono vuoti, reindirizza alla pagina di login con un messaggio di errore
	if (empty($email)) {
		header("Location: /web/pages/signin.php?error=Email is required");
	    exit();
		return false;
	}else if(empty($pass)){
		header("Location: /web/pages/signin.php?error=Password is required");
	    exit();
		return false;
	}else{
		// crittografa la password
        $pass = md5($pass);

		// esegue una query per selezionare l'utente corrispondente 
		//a user_name e password crittografata
		$sql = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
		$result = pg_query($conn, $sql);

		// se viene trovato un solo record, l'utente esiste
		if (pg_num_rows($result) === 1) {
			$row = pg_fetch_assoc($result);

			// se il nome utente e la password corrispondono, 
			//crea le variabili di sessione e reindirizza alla home page
            if ($row['email'] === $email && $row['pass'] === $pass && $row['verification'] == true) {
				//Controlla se l'account è attivo
				if($row['status']==0){
					header("Location: /web/pages/signin.php?error=Account disabled");
					exit();
					return false;	
				} 
            	else{
				$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['id'] = $row['id'];
				$_SESSION['status']=$row['status'];        //aggiunto
				$_SESSION['is_admin']=$row['is_admin'];    //aggiunto
				//Se sei l'admin vai all'admin page altrimanti vai al profilo utente
				if($_SESSION['is_admin']==1) header("Location: /web/pages/admin.php");
				else{header("Location: /profiloutente.php");}
		        exit();
				}
            }else{
				// se il nome utente o la password sono errati, reindirizza alla pagina di login con un messaggio di errore
				header("Location: /web/pages/signin.php?error=Incorrect Email or password");
		        exit();
				return false;
			}

		}else{
			// se non viene trovato alcun record, l'utente non esiste, reindirizza alla pagina di login con un messaggio di errore
			header("Location: /web/pages/signin.php?error=Incorrect Email or password");
	        exit();
			return false;
		}
	}
	
	}else{
	// se i campi user_name e password non sono stati inviati tramite il metodo POST, reindirizza alla home page
	header("Location: index.php");
	exit();
	return false;
	}
   
    }

	// definisce una funzione per validare l'input
	function valid_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	 }



	
    public function doLoginB($email,$pass,$conn){
        

		
			
		// verifica che i campi user_name e password siano stati inviati tramite il metodo POST

	
		
	
		// valida i campi user_name e password
		$email = $this->valid_input($email);
		$pass = $this->valid_input($pass);
	
		// se user_name o password sono vuoti, reindirizza alla pagina di login con un messaggio di errore
		if (empty($email)) {
			header("Location: /web/pages/signin.php?error=Email is required");

			return false;
		}else if(empty($pass)){
			header("Location: /web/pages/signin.php?error=Password is required");

			return false;
		}else{
			// crittografa la password
			$pass = md5($pass);
	
			// esegue una query per selezionare l'utente corrispondente 
			//a user_name e password crittografata
			$sql = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
			$result = pg_query($conn, $sql);
	
			// se viene trovato un solo record, l'utente esiste
			if (pg_num_rows($result) === 1) {
				$row = pg_fetch_assoc($result);
	
				// se il nome utente e la password corrispondono, 
				//crea le variabili di sessione e reindirizza alla home page
				if ($row['email'] === $email && $row['pass'] === $pass && $row['verification'] == true) {
					//Controlla se l'account è attivo
					if($row['status']==0){
						header("Location: /web/pages/signin.php?error=Account disabled");

						return false;	
					} 
					else{
					$_SESSION['user_name'] = $row['user_name'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['status']=$row['status'];        //aggiunto
					$_SESSION['is_admin']=$row['is_admin'];    //aggiunto
					//Se sei l'admin vai all'admin page altrimanti vai al profilo utente
					if($_SESSION['is_admin']==1) header("Location: /web/pages/admin.php");
					else{header("Location: /profiloutente.php");}
					
					return true;
					}
				}else{
					// se il nome utente o la password sono errati, reindirizza alla pagina di login con un messaggio di errore
					header("Location: /web/pages/signin.php?error=Incorrect Email or password");
					return false;
				}
	
			}else{
				// se non viene trovato alcun record, l'utente non esiste, reindirizza alla pagina di login con un messaggio di errore
				header("Location: /web/pages/signin.php?error=Incorrect Email or password");
				return false;
			}
		}
		
		
		// se i campi user_name e password non sono stati inviati tramite il metodo POST, reindirizza alla home page
		header("Location: index.php");
		return false;

	   
		}
	
		

	


}







