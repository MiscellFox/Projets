<?php 

    class Personnes {

        //Declaration des variables publiques
        public $errorPDO;
        public $errorRequest;
        public $PDOloaded;

        //Declaration des variables privees
        private $pdo;
        private $DSNSqlite;

        public function __construct(string $DSNSqlite)
        {   
            //Recuperation des donnees passees en parametre de classe
            $this->DSNSqlite = $DSNSqlite;
            $this->pdo = new PDO($this->DSNSqlite);
        }
        public function PDOVerification() : bool 
        {
            if (extension_loaded("PDO")){//Tentative de lecture de l'extension PDO
                $this->PDOloaded = true;
            }else {
                $this->PDOloaded = false;
            }
            return $this->PDOloaded;
        }
        public function getData(bool $P) : array //Fonction permetant de recuperer toutes les donnees de la base sous forme objet
        {
            if ($P === true){ //verification de l'existence de l'extension PDO
                try {
                    //Gestion des exceptions
                    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch (PDOException $ErrorPDO){
                    //Recuperation de l'erreur
                    $this->errorPDO = $ErrorPDO->getMessage();
                    exit("$this->errorPDO");
                }    
                try{
                    //Requete prepare de recuperation de l'ensemble des donnees de la base sous forme de Tableau
                    $request = $this->pdo->prepare("SELECT Nom, Prenom, Telephone, Email FROM Personnes");
                    
                    //Execution de la requete preparee
                    $request->execute();

                    //Tansformation des donnees recuperes en objet
                    $personnes = $request->fetchAll(PDO::FETCH_ASSOC);
                }
                catch(PDOException $ErrorRequest){
                    //Recuperation de l'erreur
                    $this->errorRequest = $ErrorRequest->getMessage();
                    exit("$this->errorRequest");
                }
            }else {
                echo "";
            }
            return $personnes;
        }
        
        public function Verification(array $Mydata) : bool
        {
            try {
                //Gestion des exceptions
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $ErrorPDO){
                //Recuperation de l'erreur
                $this->errorPDO = $ErrorPDO->getMessage();
                exit("$this->errorPDO");
            }    
            try{
                //Requete prepare de recuperation de l'ensemble des donnees de la base sous forme de Tableau
                $request = $this->pdo->prepare("SELECT Nom, Prenom, Telephone, Email FROM Personnes where Nom = :nom and Prenom = :prenom and Telephone= :telephone and Email = :email;");

                $identifiants = ['nom', 'prenom', 'telephone', 'email'];

                for ($i = 0; $i < 4; $i++) {
                    $request->bindValue(":{$identifiants[$i]}", $Mydata[ucwords($identifiants[$i])]);
                }

                //Execution de la requete preparee
                $request->execute();

                //Tansformation des donnees recuperes en objet
                $personnes = $request->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $ErrorRequest){
                //Recuperation de l'erreur
                $this->errorRequest = $ErrorRequest->getMessage();
                exit("$this->errorRequest");
            }
            
            if (count($personnes) == 0){
                return false;
            }else {
                return true;
            }
        }

        public function InsertData(array $Array) : bool
        {
            $successInsertData = null;
            if (!empty($Array)){
                try {
                    //Requete preparee permettant d'inserer des donnees dans la base de donnees
                    $request = $this->pdo->prepare("INSERT INTO Personnes (Nom,Prenom,Telephone,Email) VALUES (:nom, :prenom, :telephone, :email)");
                   
                   //Execution de la requete preparee
                    $request->execute([
                        "nom" => ucwords($Array['Nom']),
                        "prenom"=> ucwords($Array['Prenom']),
                        "telephone" => ucwords($Array['Telephone']),
                        "email" => ucwords($Array['Email']),
                    ]);
                    $successInsertData = true;
                }catch(PDOException $e){
                    $successInsertData = false;
                }
            }
            return $successInsertData;
        }
    }

?>